<?php

namespace App\Controller;

use App\Repository\EtablissementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     */
    #[Route('/admin', name: 'admin')]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        $manager = $this->getUser();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'etablissements' => $etablissementRepository->findAllByManagerId($manager),
        ]);
    }
}