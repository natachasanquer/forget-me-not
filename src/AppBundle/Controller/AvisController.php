<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Action;
use AppBundle\Entity\Avis;
use AppBundle\Form\AvisType;
use AppBundle\Entity\User;
use AppBundle\Entity\RetourAction;

class AvisController extends Controller
{

    /**
     * Méthode permettant d'insérer un avis en BDD.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajouterAction(Request $request, Action $action)
    {
        $user = $this->getUser();
        
        $avis = new Avis();
        $retourAction = new RetourAction();
        
        $form = $this->createForm(AvisType::class, $avis);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setAction($action);
            $avis->setDate(new \DateTime());
            // Si l'utilisateur connecté corresond a l'utilisateur de l'action,
            // alors cet utilisateur est l'emprunteur
            if ($user == $action->getUser()) {
                $avis->setRole("emp");
            } // Sinon l'utilisateur est le proprietaire
            else {
                $avis->setRole("proprio");
            }
            
            $retourAction->setAvis($avis);
            $retourAction->setAction($action);
            $retourAction->setUser($action->getArticle()
                ->getUser());
            
            // Enregistreent en BDD
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($avis);
            $em->persist($retourAction);
            
            $em->flush();
            
            return $this->redirectToRoute("home");
        }
        
        return $this->render('avis/ajouter_avis.html.twig', [
            "form" => $form->createView()
        ]);
    }

    public function listeAction(User $user)
    {
        $avis = array();
        $note = 0;
        $compteurNote = 0;
        
        $repoRetour = $this->getDoctrine()->getRepository(RetourAction::class);
        $repoAvis = $this->getDoctrine()->getRepository(Avis::class);
        
        $retoursAction = $repoRetour->findBy([
            "user_id" => $user->getId()
        ]);
        
        foreach ($retoursAction as $retourAction) {
            $avis = $repoAvis->findOneById($retourAction->getAvis()
                ->getId());
            
        }
        
        return $this->render('avis/fiche', compact("avis"));
    }
    
}

