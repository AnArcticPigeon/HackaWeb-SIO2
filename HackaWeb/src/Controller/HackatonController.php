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
        $estInscrit = false;

        if( $this->isGranted('IS_AUTHENTICATED_FULLY') ) {
            echo("coucou");
            $lesEquipes = $leHackaton->getLesequipe();
            foreach ($lesEquipes as $uneEquipe) {
                dump($uneEquipe->getLesUtilisateur());

                if( $uneEquipe->getLesUtilisateur()->contains($this->getUser()) )  {
                    $estInscrit = true;
                    echo("Utilisateur Trouver dans l'equipe ".$uneEquipe->getNomEquipe()."inscrit au hackaton ".$leHackaton->getId());
                    break;
                }
                $estInscrit = false;
                
            }
        }
        dump("est Inscrit:".$estInscrit);

        return $this->render('hackaton/detail.html.twig', [
            'controller_name' => 'HackatonController',
            'unHackaton' => $leHackaton,
            'estInscrit' => $estInscrit,
        ]);
    }
}
