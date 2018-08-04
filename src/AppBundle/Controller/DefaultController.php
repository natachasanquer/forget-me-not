<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Méthode permettant d'afficher la page d'accueil.
     * Récupère les articles
     * Crée un formulaire de recherche d'article.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction(Request $request)
    {
        $recherche = new Article();

        $registerForm = $this->createForm(RechercheType::class,$recherche);

        $registerForm->handleRequest($request);

        if($registerForm->isSubmitted() && $registerForm->isValid()){

            $repo =$this->getDoctrine()->getRepository(Article::class);
            $articles = $repo->findAvecRecherche($recherche);

            $id = $recherche->getId();

            return $this->render('default/home.html.twig', [
                'articles'=>$articles,
                'form'=>$registerForm->createView()
            ]);

        }

        $repo =$this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findBy(["estAccepte" => '1']);

        return $this->render('default/home.html.twig', [
            'articles'=>$articles,
            'form'=>$registerForm->createView()
        ] );
    }

    public function aboutAction()
    {
        return $this->render('default/about.html.twig', []);
    }


}
