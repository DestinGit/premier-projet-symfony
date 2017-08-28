<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CalculatorController extends Controller
{
    /**
     * @Route(
     *     "/add/{n1}/{n2}",
     *     defaults={"n1":1, "n2":2},
     *     requirements={"n1":"\d+", "n2":"\d+"}
     *      )
     */
    public function addAction($n1, $n2)
    {
        $result = $n1 + $n2;
        return $this->render(':calculator:add.html.twig', [
            'n1' => $n1,
            'n2' => $n2,
            'result' => $result
            ]);
    }

}
