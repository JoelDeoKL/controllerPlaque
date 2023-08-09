<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControleTechController extends AbstractController
{
    #[Route('/controle/tech', name: 'app_controle_tech')]
    public function index(): Response
    {
        return $this->render('controle_tech/index.html.twig', [
            'controller_name' => 'ControleTechController',
        ]);
    }
}
