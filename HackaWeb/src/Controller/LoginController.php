<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('connection/connection.html.twig', [
            'last_username' => $lastUsername,
            'errors' => $error
        ]);
    }

    #[Route('/deconnexion', name: 'app_logout')]
    public function deconnexion(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request, ManagerRegistry $doctrine): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(InscriptionType::class, $utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid()) {
            $utilisateur->setMdp(password_hash($utilisateur->getMdp(), PASSWORD_DEFAULT));
            $entityManager = $doctrine->getManager();
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
