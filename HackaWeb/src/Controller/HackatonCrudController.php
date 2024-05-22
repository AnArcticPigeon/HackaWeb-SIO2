<?php

namespace App\Controller;

use App\Entity\Hackaton;
use App\Form\HackatonType;
use App\Repository\HackatonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hackaton/crud')]
class HackatonCrudController extends AbstractController
{
    #[Route('/hackatons', name: 'app_hackaton_crud_index', methods: ['GET'])]
    public function index(HackatonRepository $hackatonRepository): Response
    {
        return $this->render('hackaton_crud/index.html.twig', [
            'hackatons' => $hackatonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hackaton_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hackaton = new Hackaton();
        $form = $this->createForm(HackatonType::class, $hackaton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hackaton);
            $entityManager->flush();

            return $this->redirectToRoute('app_hackaton_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hackaton_crud/new.html.twig', [
            'hackaton' => $hackaton,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hackaton_crud_show', methods: ['GET'])]
    public function show(Hackaton $hackaton): Response
    {
        return $this->render('hackaton_crud/show.html.twig', [
            'hackaton' => $hackaton,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hackaton_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hackaton $hackaton, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HackatonType::class, $hackaton);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hackaton_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hackaton_crud/edit.html.twig', [
            'hackaton' => $hackaton,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hackaton_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Hackaton $hackaton, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hackaton->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($hackaton);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hackaton_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
