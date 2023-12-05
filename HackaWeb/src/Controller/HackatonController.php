<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Hackaton;

class HackatonController extends AbstractController
{
    #[Route('/hackaton', name: 'app_hackaton')]
    public function index(): Response
    {
        return $this->render('hackaton/hackatons.html.twig', [
            'controller_name' => 'HackatonController',
        ]);
    }

    #[Route('/hackaton/{id}', name: 'app_hackaton_detail')]
    public function detail($id, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Hackaton::class);
        $leHackaton = $repository->find($id);
        return $this->render('hackaton/detail.html.twig', [
            'controller_name' => 'HackatonController',
            'unHackaton' => $leHackaton,
        ]);
    }
}
