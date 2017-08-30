<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 30/08/2017
 * Time: 15:57
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Book;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BookFixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $books = [];

        $books[] = $this->getNewBookInstance([
            'title' => 'Les Misérables',
            'price' => 11,
            'published' => new \DateTime('1860-11-14'),
            'publisher' => $this->getReference('publisher_grasset'),
            'authors' => [
                $this->getReference('author_hugo'),
                $this->getReference('author_auster')
            ]
        ]);
        $books[] = $this->getNewBookInstance([
            'title' => 'Game of thrones',
            'price' => 30,
            'published' => new \DateTime('2000-11-14'),
            'publisher' => $this->getReference('publisher_tino'),
            'authors' => [
                $this->getReference('author_balzac')
            ]
        ]);
        $books[] = $this->getNewBookInstance([
            'title' => 'Au bonheur des dâmes',
            'price' => 21,
            'published' => new \DateTime('1880-11-14'),
            'publisher' => $this->getReference('publisher_puf'),
            'authors' => [
                $this->getReference('author_balzac'),
                $this->getReference('author_auster')
            ]
        ]);


        foreach ($books as $book) {
            $manager->persist($book);
        }

        $manager->flush();
    }

    private function getNewBookInstance($data) {
        $book = new Book();
        $book->setTitle($data['title'])
            ->setPrice($data['price'])
            ->setPublishedAt($data['published'])
            ->setPublisher($data['publisher']);

        foreach ($data['authors'] as $author) {
            $book->addAuthor($author);
        }

        return $book;
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 30;
    }
}