<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route(
     *        "/hello/{name}/{age}", name="hello",
     *        defaults={"name": "World", "age": 0},
     *        requirements={"age":"\d{1,3}", "name":"\D+"}
     *      )
     * @return Response
     */
    public function helloAction(Request $request, $name, $age) {
        $key = $request->get('key');

        if ($key == '123') {
//            $response = new Response("<h1>hello $name, vous avez $age ans</h1>");
            $response = $this->render("default/hello.html.twig", [
                'name' => $name,
                'age' => $age
            ]);
        } else {
            $response = new Response('Accès interdit');
            $response->setStatusCode(403);
        }

        return $response;
    }

    /**
     * @Route(
     *     "/api/user"
     * )
     * @return JsonResponse
     */
    public function ajaxuserAction() {
        $user = [
            'userName' => 'Tino',
            'email' => 'mopao@yemai.com',
            'roles' => ['USER', 'ADMIN', 'MOPAO'],
            'id' => 123
        ];

        $response = JsonResponse($user);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        return new $response;
    }
}
