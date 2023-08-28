<?php

namespace App\Controller;

use App\Entity\CarteCrise;
use App\Form\CarteCriseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CarteCriseController extends AbstractController
{
    #[Route('/carte_grise', name: 'carteGrises')]
    public function carteGrises(EntityManagerInterface $entityManager): Response
    {
        $carteCrises = $entityManager->getRepository(CarteCrise::class)->findAll();

        return $this->render('carte_crise/carteCrise.html.twig', ['carteCrises' => $carteCrises]);
    }

    #[Route('/editerCarteGrise/{id?0}', name: 'editerCarteGrise')]
    public function editerCarteGrise(CarteCrise $carteCrise = null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new = false;
        if(!$carteCrise){
            $new = true;
            $carteCrise = new CarteCrise();
        }

        $form = $this->createForm(CarteCriseType::class, $carteCrise);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($carteCrise);

            $manager->flush();

            if($new){
                $message = "La carte crise a été ajouter avec succès";
            }else{
                $message = "La carte crise a été editer avec succès";
            }

            $this->addFlash("succes", $message);

            return $this->redirectToRoute("carteGrises");
        }else{
            return $this->render('carte_crise/addCarteCrise.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/detailCarteGrise/{id?0}', name: 'detailCarteGrise')]
    public function detailCarteGrise(ManagerRegistry $doctrine, CarteCrise $carteCrise = null ): Response
    {
        if(!$carteCrise){
            $this->addFlash('error', "Cette carte n'existe pas !");
            return $this->redirectToRoute("carteCrises");
        }
        return $this->render('carte_crise/detailCarteCrise.html.twig', ['carteCrise' => $carteCrise]);
    }

    #[Route('/deleteCarteCrise/{id?0}', name: 'deleteCarteCrise')]
    public function deleteCarteCrise(CarteCrise $carteCrise = null, ManagerRegistry $doctrine, $id): Response
    {

        $repository = $doctrine->getRepository(CarteCrise::class);
        $carteCrise = $repository->find($id);

        $manager = $doctrine->getManager();
        $manager->remove($carteCrise);

        $manager->flush();

        $message = " a été supprimer avec succès";


        $this->addFlash("succes", $carteCrise->getPrenom() . $message);

        return $this->redirectToRoute("carteCrises");

    }
}
