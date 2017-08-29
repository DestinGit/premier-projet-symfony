<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrinePlaygroundControllerTest extends WebTestCase
{
    public function testNewbook()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/new-book');
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/book-list');
    }

}
