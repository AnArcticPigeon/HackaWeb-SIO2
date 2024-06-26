<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Utilisateur;
use App\Form\CreationEquipeType;
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

    #[Route('/mesHackatons', name: 'app_hackatons_utilisateur')]
    public function hackatonsUtilisateur(HackatonRepository $repos): Response
    {

        $listeHackatonInscrit = [];
        $listeHackatonsFavoris = [];

        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            /** @var \App\Entity\User $user */
            $user = $this->getUser();

            $lesEquipes = $user->getLesEquipe();

            foreach($lesEquipes as $equipe) {
                array_push($listeHackatonInscrit, $equipe->getLeHackaton());
            }

            $userFavoris = $user->getFavoris();

            foreach($userFavoris as $favoris) {
                array_push($listeHackatonsFavoris, $favoris->getId());
            }
            dump($listeHackatonInscrit);

        }

        return $this->render('hackaton/hackatonsUtilisateur.html.twig', [
            'controller_name' => 'HomeController',
            'listeHackatons' => $listeHackatonInscrit,
            'listeHackatonsFavoris' => $listeHackatonsFavoris

        ]);
    }

    #[Route('/hackatons', name: 'app_hackatons')]
    public function hackatons(HackatonRepository $repos): Response
    {
        $listeHackatonsFavoris = [];

        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $userFavoris = $user->getFavoris();

            foreach($userFavoris as $favoris) {
                array_push($listeHackatonsFavoris, $favoris->getId());
            }
        }

        $listeHackatons = $repos->findall();

        return $this->render('hackaton/hackatons.html.twig', [
            'controller_name' => 'HomeController',
            'listeHackatons' => $listeHackatons,
            'listeHackatonsFavoris' => $listeHackatonsFavoris,

        ]);
    }

    #[Route('/creation_equipe/{idHackaton}', name: 'app_creation_equipe')]
    public function creation_equipe(int $idHackaton, Request $request, ManagerRegistry $doctrine, HackatonRepository $hackatonRepository): Response
    {
        $hackaton = $hackatonRepository->find($idHackaton);
        $equipe = new Equipe();

        $form = $this->createForm(CreationEquipeType::class, $equipe);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()) {
            $equipe->setLeHackaton($hackaton);
            $equipe->setDateInsc(new \DateTime());
            $equipe->addLesUtilisateur($this->getUser());

            $entityManager = $doctrine->getManager();
            $entityManager->persist($equipe);
            $entityManager->flush();
            $this->addFlash('success', 'Equipe Ajoutée');
            return $this->redirectToRoute('app_hackatons_utilisateur');
        };

        return $this->render('equipe/creationEquipe.html.twig', [
            'controller_name' => 'HomeController',
            'formAddEquipe' => $form -> createView(),
        ]);
    }

    #[Route('/choixEquipe/{idHackaton}', name: 'app_choixEquipe')]
    public function choixEquipe(int $idHackaton, ManagerRegistry $doctrine, EquipeRepository $equipeRepo, HackatonRepository $hackatonRepository): Response
    {
        $leHackaton = $hackatonRepository->find($idHackaton);
        $lesEquipes = $equipeRepo->findAll();

        foreach($lesEquipes as $uneEquipe) {
            if($uneEquipe->getLeHackaton()->getId() != $idHackaton) {
                $key = array_search($uneEquipe, $lesEquipes);
                unset($lesEquipes[$key]);
            }
        }

        return $this->render('equipe/choixEquipe.html.twig', [
            'controller_name' => 'HomeController',
            'equipes' => $lesEquipes,
            'leHackaton' => $leHackaton
        ]);
    }

    #[Route('/rejoindreEquipe/{idHackaton}/{idEquipe}', name: 'app_rejoindreEquipe')]
    public function rejoindreEquipe(int $idHackaton, int $idEquipe, ManagerRegistry $doctrine, EquipeRepository $equipeRepo, HackatonRepository $hackatonRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $utilisateur = $this->getUser();
        $lEquipe = $equipeRepo->find($idEquipe);
        $lEquipe->addLesUtilisateur($utilisateur);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($lEquipe);
        $entityManager->flush();

        $this->addFlash('success', 'Inscription Enregistré');
        return $this->redirectToRoute('app_hackatons');
    }
}
