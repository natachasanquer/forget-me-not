<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Avis;
use AppBundle\Entity\Image;
use AppBundle\Entity\RetourAction;
use AppBundle\Form\ArticleEditType;
use AppBundle\Form\ArticleType;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * Méthode permettant d'insérer un article en BDD.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $user = $this->getUser();
        
        $article = new Article();
        $articleForm = $this->createForm(ArticleType::class,$article);

        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() && $articleForm->isValid()){
            $user->addPoints($article->getType()->getPoints()/2);
            
            // $file stores the uploaded PDF file
            $file = $articleForm['image']->getData();

            $fileName = $article->getTitre().'.'.$file->guessExtension();

            $image = new Image();
            $image->setArticle($article);
            $image->setUrlImage($fileName);

           // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('url_image_article'),
                $fileName
            );

            $article->addImage($image);

            $article->setDateCreation(new \DateTime());
            $article->setUser($user);
            $article->setEstAccepte(true);
            $article->setEstArchive(false);

            $slugify = new Slugify();
            $slug=$slugify->slugify($article->getTitre().$article->getId());
            $article->setSlug($slug);

            #Enregistrement en base de donnees
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->persist($article);
            $em->persist($user);
            $em->flush();

            $this->addFlash("success","Article ajouté !");
            return $this->redirectToRoute("user_details");

        }

        return $this->render('article/ajouter_article.html.twig',[
            "articleForm"=>$articleForm->createView()
        ]);

    }

    /**
     * Méthode permettant de récupérer un article en BDD.
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction($slug)
    {
        if(!$slug){
            throw $this->createNotFoundException("L'idée n'existe pas.");
        }

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->findOneBySlug($slug);
        
        $avis = array();
        $note = 0;
        $compteurNote = 0;
        $user = $article->getUser();
        
        $repoRetour = $this->getDoctrine()->getRepository(RetourAction::class);
        $repoAvis = $this->getDoctrine()->getRepository(Avis::class);
        
        $retoursAction = $repoRetour->findBy([
            "user_id" => $user->getId()
        ]);
        
        foreach ($retoursAction as $retourAction) {
            $avis = $repoAvis->findOneById($retourAction->getAvis()
                ->getId());
            $note += $avis->getNote();
            $compteurNote ++;
            
        }
        
        $note = $note/$compteurNote;
        

        return $this->render('article/detail_article.html.twig', compact("article","note"));
    }

    public function modifierAction(Request $request, $slug){

        if(!$slug){
            throw $this->createNotFoundException("L'action n'existe pas.");
        }

        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->findOneBySlug($slug);


        $articleForm = $this->createForm(ArticleEditType::class,$article);

        $articleForm->handleRequest($request);

        if($articleForm->isSubmitted() && $articleForm->isValid()){

            $article->setEstAccepte(false);

            #Enregistrement en base de donnees
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $id = $article->getId();

            $this->addFlash("success","Article modifié !");
            return $this->redirectToRoute("article_detail",compact("slug"));

        }

        return $this->render('article/modifier_article.html.twig',[
            "articleForm"=>$articleForm->createView()
        ]);

    }
}
