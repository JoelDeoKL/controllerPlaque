<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VignetteController extends AbstractController
{
    #[Route('/vignettes', name: 'vignettes')]
    public function vignettes(EntityManagerInterface $entityManager): Response
    {
        $vignettes = $entityManager->getRepository(Detenteur::class)->findAll();

        return $this->render('vignette/detenteur.html.twig', ['vignettes' => $vignettes]);
    }
}
