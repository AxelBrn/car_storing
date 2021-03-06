<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    /**
     * @Route("/hello/world", name="hello_world")
     */
    public function index()
    {
        return $this->render('hello_world/hello_world.html.twig', [
            'controller_name' => 'HelloWorldController',
        ]);
    }
}
