<?php

namespace App\Controller;

use App\Entity\Detenteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetenteurController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index2.html.twig');
    }


    #[Route('/detenteurs', name: 'detenteurs')]
    public function detenteurs(EntityManagerInterface $entityManager): Response
    {
        $detenteurs = $entityManager->getRepository(Detenteur::class)->findAll();

        return $this->render('detenteur/detenteur.html.twig', ['detenteurs' => $detenteurs]);
    }


}
