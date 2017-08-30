<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixture extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $author = [];

        $author[] = new Author();
        $author[0]->setName("Hugo")
            ->setFirstName("Victor")
            ->setBirthDate(new \DateTime("1802-10-14"));
        $this->addReference("author_hugo", $author[0]);

        $author[] = new Author();
        $author[1]->setName("Auster")
            ->setFirstName("Paul")
            ->setBirthDate(new \DateTime("1812-09-14"));
        $this->addReference("author_auster", $author[1]);

        $author[] = new Author();
        $author[2]->setName("De Balzac")
            ->setFirstName("Honoré")
            ->setBirthDate(new \DateTime("1807-11-14"));
        $this->addReference("author_balzac", $author[2]);

        foreach ($author as $item) {
            $manager->persist($item);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}