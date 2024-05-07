<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Hackaton;
use App\Repository\HackatonRepository;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HackatonController extends AbstractController
{
    /**
     * Affiche le détail d'un hackaton
     * @param $id
     * @param HackatonRepository $hackatonRepository
     * @return Response
     */
    #[Route('/hackaton/{id}', name: 'app_hackaton_detail')]
    public function detail(int $id, ManagerRegistry $doctrine, HackatonRepository $hackatonRepository): Response
    {
        $repository = $doctrine->getRepository(Hackaton::class);
        $leHackaton = $repository->find($id);
        $estInscrit = false;


        $dateLimiteHackaton = $hackatonRepository->getDateLimite($id);
        $dateLimiteHackaton = new DateTime($dateLimiteHackaton['DateLimite']);

        $nbInscrit = $hackatonRepository->getNbInscrit($id);
        $nbInscrit = $nbInscrit['nbInscrit'];

        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $lesEquipes = $leHackaton->getLesequipe();
            foreach ($lesEquipes as $uneEquipe) {
                dump($uneEquipe->getLesUtilisateur());

                if($uneEquipe->getLesUtilisateur()->contains($this->getUser())) {
                    $estInscrit = true;
                    break;
                }
                $estInscrit = false;

            }
        }

        return $this->render('hackaton/detail.html.twig', [
            'controller_name' => 'HackatonController',
            'unHackaton' => $leHackaton,
            'estInscrit' => $estInscrit,
            'dateLimite' => $dateLimiteHackaton,
            'dateActuelle' => new DateTime(date('y-m-d')),
            'nbInscrit' => $nbInscrit,
        ]);
    }

    /**
     * Ajout ou suppression d'un hackathon dans la collection les favoris de l'utilisateur
     * @param $id
     * @param ManagerRegistry $doctrine
     * @return JsonResponse
     */
    #[Route('/hackaton/{id}/favori', name: 'app_hackathon_favori')]
    public function hackathon_favori(int $id, ManagerRegistry $doctrine)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $repository = $doctrine->getRepository(Hackaton::class);

        if (!$repository->find($id)) {
            throw $this->createNotFoundException('Hackathon Introuvable');
        }

        $leHackaton = $repository->find($id);

        if(!$user->getFavoris()->contains($leHackaton)) {
            $user->addFavori($leHackaton);
            $data = [
                'id' => $id,
                'message' => 'Hackathon ajouté aux favoris',
                'isFavorite' => true
            ];
        } else {
            $user->removeFavori($leHackaton);
            $data = [
                'id' => $id,
                'message' => 'Hackathon enlever des favoris',
                'isFavorite' => false
            ];
        }

        $entityManager = $doctrine->getManager();
        $entityManager->persist($leHackaton);
        $entityManager->flush();

        return new JsonResponse($data);
    }

}
