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
//        $this->addBook();

        // Récupération de data avec Entity Repository
        $repository = $this->getDoctrine()
            ->getRepository("AppBundle:Book");
        $book = $repository->find(2);

        // Modification
        $book->setTitle("Advanced SQL");

        // Persistance de data avec Entity Manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();


        return $this->render('AppBundle:DoctrinePlayground:new_book.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/book-list", name="book_list")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository("AppBundle:Book");

        $bookList = $repository->findAll();

        return $this->render('AppBundle:DoctrinePlayground:index.html.twig', array(
            'books' => $bookList
        ));
    }

    /**
     * @Route("/book-details/{id}", name="book_details")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction($id) {
        $repository = $this->getDoctrine()->getRepository("AppBundle:Book");

        $book = $repository->find($id);

        return $this->render("AppBundle:DoctrinePlayground:detail.html.twig", ['book' => $book]);
    }
    private function addBook(): void
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
    }

}
