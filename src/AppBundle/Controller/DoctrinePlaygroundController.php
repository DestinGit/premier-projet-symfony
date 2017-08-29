<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DoctrinePlaygroundController extends Controller
{
    /**
     * @Route("/new-book")
     */
    public function newBookAction()
    {
        // Création d'une entité book
        $book = new Book();
        $book->setTitle("SQL for smarties")
             ->setAuthor('Joe Celko')
            ->setPrice(54.8)
            ->setPublishedAt(new \DateTime("2000-01-25"));

        // Récupération d'une instance du gestionnaire d'entité
        $em = $this->getDoctrine()->getManager();

        // Persistance de l'entité
        $em->persist($book);

        //  Validation de la transaction
        $em->flush();

        return $this->render('AppBundle:DoctrinePlayground:new_book.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/book-list")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:DoctrinePlayground:index.html.twig', array(
            // ...
        ));
    }

}
