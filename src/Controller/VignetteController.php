<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VignetteController extends AbstractController
{
    #[Route('/vignette', name: 'app_vignette')]
    public function index(): Response
    {
        return $this->render('vignette/index.html.twig', [
            'controller_name' => 'VignetteController',
        ]);
    }
}
