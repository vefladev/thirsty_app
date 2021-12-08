<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\InfoEtablissement;
use App\Form\InfoEtablissementType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etablissement/{id_etab}/info')]
class InfoEtablissementController extends AbstractController
{
    #[Route('/new', name: 'info_etablissement_new', methods: ['GET', 'POST'])]
    #[ParamConverter("etablissement", options: ["mapping" => ["id_etab" => "id"]])]
    public function new(
        Etablissement $etablissement,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $infoEtablissement = new InfoEtablissement();
        $form = $this->createForm(InfoEtablissementType::class, $infoEtablissement);
        $form->handleRequest($request);
        // dd($form->getData());
        if ($form->isSubmitted() && $form->isValid()) {
            $infoEtablissement->setEtablissement($etablissement);

            $entityManager->persist($infoEtablissement);
            $entityManager->flush();

            return $this->redirectToRoute('etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('info_etablissement/new.html.twig', [
            'info_etablissement' => $infoEtablissement,
            'form' => $form,
            'etablissement' => $etablissement
        ]);
    }

    #[Route('/{id}', name: 'info_etablissement_show', methods: ['GET'])]
    public function show(InfoEtablissement $infoEtablissement): Response
    {
        return $this->render('info_etablissement/show.html.twig', [
            'info_etablissement' => $infoEtablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'info_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InfoEtablissement $infoEtablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InfoEtablissementType::class, $infoEtablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('info_etablissement/edit.html.twig', [
            'info_etablissement' => $infoEtablissement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'info_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, InfoEtablissement $infoEtablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $infoEtablissement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($infoEtablissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etablissement_index');
    }
}
