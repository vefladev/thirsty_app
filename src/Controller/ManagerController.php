<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Form\ManagerType;
use App\Repository\ManagerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EtablissementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/manager')]
class ManagerController extends AbstractController
{
    #[Route('/', name: 'manager_index', methods: ['GET'])]
    public function index(ManagerRepository $managerRepository): Response
    {
        return $this->render('manager/index.html.twig', [
            'managers' => $managerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'manager_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $manager = new Manager();
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($manager);
            $entityManager->flush();

            return $this->redirectToRoute('manager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manager/new.html.twig', [
            'manager' => $manager,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'manager_show', methods: ['GET'])]
    public function show(Manager $manager, EtablissementRepository $etablissementRepository): Response
    {
        $etablishments = $etablissementRepository->findAllByManagerId($manager->getId());
        return $this->render('manager/show.html.twig', [
            'manager' => $manager,
            'etablishments' => $etablishments
        ]);
    }

    #[Route('/{id}/edit', name: 'manager_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Manager $manager, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ManagerType::class, $manager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('manager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('manager/edit.html.twig', [
            'manager' => $manager,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'manager_delete', methods: ['POST'])]
    public function delete(Request $request, Manager $manager, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$manager->getId(), $request->request->get('_token'))) {
            $entityManager->remove($manager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('manager_index', [], Response::HTTP_SEE_OTHER);
    }
}
