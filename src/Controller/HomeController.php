<?php

namespace App\Controller;

use App\Repository\EtablissementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        $etablissements = $etablissementRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'etablissements' => $etablissements,
        ]);
    }
}
