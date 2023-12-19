<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HackatonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


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
    public function hackatons(HackatonRepository $repos): Response
    {
        $listeHackatons= $repos->findall();


        return $this->render('hackaton/hackatons.html.twig', [
            'controller_name' => 'HomeController',
            'listeHackatons' => $listeHackatons



        ]);
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, ManagerRegistry $doctrine): Response
    {
        $utilisateur = new Utilisateur();
        $form=$this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()){
            $utilisateur->setMdp(password_hash($request->request->get('mdp'),  PASSWORD_BCRYPT ));
            $entityManager=$doctrine->getManager();
            $entityManager->persist($utilisateur); 
            $entityManager->flush();
            $this->addFlash('success', 'Inscription Enregistré');
            return $this->redirectToRoute('app_login');
        };

        return $this->render('Inscription/inscription.html.twig', [
            'controller_name' => 'HomeController',
            'formAddUtilisateur' => $form -> createView(),
        ]);
    }
}
