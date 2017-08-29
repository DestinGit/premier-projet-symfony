<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CalculatorController extends Controller
{
    /**
     * @Route(
     *     "/add/{n1}/{n2}", name="calculator_add_and_misc",
     *     defaults={"n1":1, "n2":2},
     *     requirements={"n1":"\d+", "n2":"\d+"}
     *      )
     */
    public function addAction($n1, $n2)
    {

        $clients = [
            ['nom' => 'Alfred', 'id'=>5, 'email'=>'alfred@client.com', 'sexe'=>'M'],
            ['nom' => 'Yemei', 'id'=>6, 'email'=>'yemei@client.com', 'sexe'=>'M'],
            ['nom' => 'Mopao', 'id'=>7, 'email'=>'mopao@client.com', 'sexe'=>'M'],
            ['nom' => 'Leila', 'id'=>8, 'email'=>'tino@client.com', 'sexe'=>'F']
        ];

        $result = $n1 + $n2;
        return $this->render(':calculator:add.html.twig', [
            'n1' => $n1,
            'n2' => $n2,
            'result' => $result,
            'ctrl' => $this,
            'yesterday' => new \DateTime("today -1 day"),
            'list' => [8,5,9,4,3,6,4],
            'name' => 'mopao',
            'clients' => $clients
            ]);
    }

}
