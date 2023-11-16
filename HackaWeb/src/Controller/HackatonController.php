<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HackatonController extends AbstractController
{
    #[Route('/hackaton', name: 'app_hackaton')]
    public function index(): Response
    {
        return $this->render('hackaton/index.html.twig', [
            'controller_name' => 'HackatonController',
        ]);
    }
}
