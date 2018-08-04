<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Conversation;
use AppBundle\Entity\Article;
use AppBundle\Entity\Message;
use Doctrine\Tests\DBAL\Types\DateTest;

class ConversationController extends Controller
{
    /**
     * Méthode permettant de créer une instance de conversation entre un utilisateur et le propriétaire d'un vêtement.
     * @param Request $request
     * @param string $slugArticle
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function demarrerAction(Request $request, $slugArticle)
    {
        if(!$slugArticle){
            throw $this->createNotFoundException("L'idée n'existe pas.");
        }
        $article = $this->getDoctrine()->getRepository(Article::class)->findOneBySlug($slugArticle);
        $repo = $this->getDoctrine()->getRepository(Conversation::class);
        
        $conversation = $repo->findOneBy(["article"=>$article,"user"=>$this->getUser()]);
        
        if($conversation === NULL){
           $conversation = new Conversation();
           $conversation->setArticle($article);
           $conversation->setUser($this->getUser());
           
           $em = $this->getDoctrine()->getManager();
           
           $em->persist($conversation);
           $em->flush();
           
        }
        
        return $this->render('conversation/conversation.html.twig', ["conversation"=>$conversation]);
        
    }
    
    /**
     * Méthode permettant d'ajuter un nouveau message.
     * @param Request $request
     * @param Conversation $conversation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function ajouterMessageAction($request,$conversation){
        $texteMessage = $_POST['message'];
        $message = new Message();
        $message->setConversation($conversation);
        $message->setDateTime(new \DateTime());
        $message->setMembre($this->getUser());
        $message->setText($texteMessage);
        $conversation->addMessage($message);
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($message);
        $em->persist($conversation);
        $em->flush();
        
        return $this->redirectToRoute("conversation_demarrer", [
            ""
        ]);
    }
}