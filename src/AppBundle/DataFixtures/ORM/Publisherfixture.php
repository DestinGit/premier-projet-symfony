<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 30/08/2017
 * Time: 15:53
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Publisher;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Publisherfixture extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $publisher = [];

        $publisher[] = new Publisher();
        $publisher[0]->setName('Grasset');
        $this->addReference("publisher_grasset", $publisher[0]);

        $publisher[] = new Publisher();
        $publisher[1]->setName('Hachette');
        $this->addReference("publisher_hachette", $publisher[1]);

        $publisher[] = new Publisher();
        $publisher[2]->setName('PUF');
        $this->addReference("publisher_puf", $publisher[2]);

        $publisher[] = new Publisher();
        $publisher[3]->setName('Flamarion');
        $this->addReference("publisher_flamarion", $publisher[3]);

        $publisher[] = new Publisher();
        $publisher[4]->setName('Tino');
        $this->addReference("publisher_tino", $publisher[4]);

        foreach ($publisher as $item) {
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
        return 2;
    }
}