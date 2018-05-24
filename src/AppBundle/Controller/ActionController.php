<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Action;
use AppBundle\Entity\Article;
use AppBundle\Entity\TypeAction;
use Cocur\Slugify\Slugify;
use AppBundle\Form\EtatLieuType;
use AppBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    public function locationAction(Request $request, $slug)
    {
        if(!$slug){
            throw $this->createNotFoundException("L'idée n'existe pas.");
        }

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->findOneBySlug($slug);

        $action = new Action();
        $action->setDateDebut(new \DateTime());
        $action->setDateFin(new \DateTime());
        $form = $this->createForm(LocationType::class,$action);

        $form->handleRequest($request);

        $slugify = new Slugify();
        $slug=$slugify->slugify($article->getTitre() . $action->getDateDebut()->format('Y-m-d'));
        $action->setSlug($slug);

        if($form->isSubmitted() && $form->isValid()){


            $action->setUser($this->getUser());
            $action->setArticle($article);
            $action->setEstValide(false);
            $action->setDateDemande(new \DateTime());
            $action->setEstRefuse(false);
            $action->setEtat('attente');

            $type = $this->getDoctrine()->getRepository(TypeAction::class)->findOneBy(["libelle" => "Location"]);

            $action->setType($type);

            #Enregistrement en base de donnees
            $em = $this->getDoctrine()->getManager();
            $em->persist($action);
            $em->flush();

            $this->addFlash("succes","Demande envoyée !");

            return $this->redirectToRoute("home");
        }

        return $this->render('action/action_location.html.twig',[
            "form"=>$form->createView()
        ]);

    }

    public function commencementAction(Request $request,$slug){
        if(!$slug){
            throw $this->createNotFoundException("L'action n'existe pas.");
        }
        
        $action= $this->getDoctrine()->getRepository(Action::class)->findOneBySlug($slug);
        
        $form = $this->createForm(EtatLieuType::class,$action);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $action->setEtat('en cours');
            #Enregistrement en base de donnees
            $em = $this->getDoctrine()->getManager();
            $em->persist($action);
            $em->flush();
            
            $this->addFlash("succes","Demande envoyée !");
            
            return $this->redirectToRoute("home");
        }
        
        return $this->render('action/action_commencer.html.twig',[
            'slug'=>$slug,
            'form'=>$form->createView(),
        ]);
    }
    
    public function achatAction($slug)
    {

        if(!$slug){
            throw $this->createNotFoundException("L'action n'existe pas.");
        }

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->findOneBySlug($slug);

        $action = new Action();

        $action->setUser($this->getUser());
        $action->setArticle($article);
        $action->setEstValide(false);
        $action->setDateDebut(new \DateTime());
        $action->setDateDemande(new \DateTime());
        $action->setEstRefuse(false);
        $action->setEtat('achat');

        $type = $this->getDoctrine()->getRepository(TypeAction::class)->findOneBy(["libelle" => "Achat"]);

        $action->setType($type);

        $slugify = new Slugify();
        $slug=$slugify->slugify($article->getTitre().$action->getDateDebut()->format('Y-m-d'));
        $action->setSlug($slug);
        $action->setCommentaire("Achat");

        #Enregistrement en base de donnees
        $em = $this->getDoctrine()->getManager();
        $em->persist($action);
        $em->flush();

        $this->addFlash("success","Demande envoyée !");

        return $this->render('action/action_achat.html.twig',compact("action"));
    }

    public function validationAction($slug, $etat){
        if(!$slug){
            throw $this->createNotFoundException("L'action n'existe pas.");
        }

        $repo = $this->getDoctrine()->getRepository(Action::class);
        $action = $repo->findOneBySlug($slug);

        if($etat=='attente'){
            return $this->render('action/action_validation.html.twig', compact('action'));

        }
        elseif ($etat=='valide') {
            $action->setEstValide(true);
            $action->setEtat('attente');
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($action);
            $em->flush();

            $this->addFlash("success","Demande acceptée !");
            return $this->redirectToRoute("user_details");
        }
        else {
            $action->setEstRefuse(true);
            $action->setEtat('refuse');

            $em = $this->getDoctrine()->getManager();
            $em->persist($action);
            $em->flush();

            $this->addFlash("succes","Demande refusée !");
            return $this->redirectToRoute("user_details");

        }


    }

}