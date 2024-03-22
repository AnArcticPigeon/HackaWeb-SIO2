<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use App\Repository\EquipeRepository;
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
            $utilisateur->setMdp(password_hash($utilisateur->getMdp(),   PASSWORD_DEFAULT  ));
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

    #[Route('/choixEquipe/{idHackaton}', name: 'app_choixEquipe')]
    public function choixEquipe($idHackaton, ManagerRegistry $doctrine, EquipeRepository $equipeRepo, HackatonRepository $hackatonRepository): Response
    {
        $lesEquipes = $equipeRepo->findAll();
        dump($idHackaton);
        $leHackaton = $hackatonRepository->find($idHackaton);
        
        return $this->render('equipe/choixEquipe.html.twig', [
            'controller_name' => 'HomeController',
            'equipes' => $lesEquipes,
            'leHackaton' => $leHackaton
        ]);
    }

    #[Route('/rejoindreEquipe/{idHackaton}/{idEquipe}', name: 'app_rejoindreEquipe')]
    public function rejoindreEquipe($idHackaton,$idEquipe, ManagerRegistry $doctrine, EquipeRepository $equipeRepo, HackatonRepository $hackatonRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $utilisateur = $this->getUser();
        $lEquipe = $equipeRepo->find($idEquipe);
        $lEquipe->addLesUtilisateur($utilisateur);

        $leHackaton = $hackatonRepository->find($idHackaton);
        $lEquipe->setLeHackaton($leHackaton);

        $entityManager=$doctrine->getManager();
        $entityManager->persist($lEquipe);
        $entityManager->flush();

        $this->addFlash('success', 'Inscription Enregistré');
        return $this->redirectToRoute('app_hackatons');

    }


}
