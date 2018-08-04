<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Action;
use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * Méthode permettant a un administrateur de valider un article
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function articleAction($slug)
    {
        if(!$slug){
            throw $this->createNotFoundException("L'article n'existe pas.");
        }
        
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->findOneBySlug($slug);

        $em = $this->getDoctrine()->getManager();

        $article->setEstAccepte(true);

        $em->persist($article);
        $em->flush();
        return $this->redirectToRoute("admin_home");

    }

    /**
     * Méthode permettant à un administrateur d'accepter un utilisateur.
     * @param User $membre
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function membreAction($membre)
    {
        if(!$membre){
            throw $this->createNotFoundException("Le membre n'existe pas.");
        }
        var_dump($membre);
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy(["id"=>$membre]);

        $em = $this->getDoctrine()->getManager();

        $user->setEstAccepte(true);

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute("admin_home");
    }

    /**
     * Méthode pour obtenir les articles et utilisateurs ajoutés et non acceptés.
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        $repoArticle = $this->getDoctrine()->getRepository(Article::class);

        $articles = $repoArticle->findBy(["estAccepte"=>false]);


        $repoUser = $this->getDoctrine()->getRepository(User::class);

        $membres = $repoUser->findBy(["estAccepte"=>false]);

        $repoAction = $this->getDoctrine()->getRepository(Action::class);

        $actions = $repoAction->findBy([]);

        return $this->render('admin/administrer.html.twig', compact("articles",'membres','actions'));
    }
}