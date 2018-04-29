<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Action;
use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Entity\Image;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    public function createAction(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user=new User();
        $userForm = $this->createForm(UserType::class,$user);

        $userForm->handleRequest($request);

        if($userForm->isSubmitted() && $userForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $file = $userForm['image']->getData();
            if($file!=null){
                // $file stores the uploaded PDF file
    
                $fileName = $user->getUsername().'.'.$file->guessExtension();
    
                $file->move(
                    $this->getParameter('url_image_user'),
                    $fileName
                );
                
                $image = new Image();
                $image->setUrlImage($fileName);
                $image->setUser($user);
                $user->setImage($image);
                
                #Enregistrement en base de donnees
                $em->persist($image);
                
            }
            #Hashage du mot de passe
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setEstAccepte(false);
            $user->setDateCreation(new \DateTime());
            $user->setPoints(50);
            $user->setPorteFeuille(0);
            $user->setRoles("ROLE_USER");

            $em->persist($user);
            $em->flush();

            $this->addFlash("succes","Bienvenue !");
            return $this->redirectToRoute("connect");

        }

        return $this->render('user/s_inscrire.html.twig',[
            "registerForm"=>$userForm->createView()
        ]);
    }


    public function connectAction(Request $request, AuthenticationUtils $authUtils)
    {
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('user/se_connecter.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    public function compteAction()
    {
        //Recuperer la liste des articles de l'utilisateur
        $repoArticle = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repoArticle->findBy(["user"=>$this->getUser()]);

        //Recuperer la liste des demandes de cet utilisateur
        $repoAction = $this->getDoctrine()->getRepository(Action::class);
        $demandes = $repoAction->findDemandes($articles);
      
        return $this->render('user/detail_compte.html.twig', compact("articles","demandes"));
    }

}
