<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/hackatons', name: 'app_hackatons')]
    public function hackatons(): Response
    {
        return $this->render('hackaton/hackatons.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/connection', name: 'app_connection')]
    public function connection(): Response
    {
        return $this->render('connection/connection.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(): Response
    {
        return $this->render('inscription/inscription.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
