<?php

namespace App\Controller;

use App\Entity\CarteCrise;
use App\Form\CarteCriseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteCriseController extends AbstractController
{
    #[Route('/carte_crise', name: 'carteCrises')]
    public function carteCrises(EntityManagerInterface $entityManager): Response
    {
        $carteCrises = $entityManager->getRepository(CarteCrise::class)->findAll();

        return $this->render('carteCrise/carteCrise.html.twig', ['carteCrises' => $carteCrises]);
    }

    #[Route('/editerCarteCrise/{id?0}', name: 'editerCarteCrise')]
    public function editerCarteCrise(CarteCrise $carteCrise = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
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

            return $this->redirectToRoute("carteCrises");
        }else{
            return $this->render('carteCrise/addDetenteur.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/detailCarteCrise/{id?0}', name: 'detailCarteCrise')]
    public function detailCarteCrise(ManagerRegistry $doctrine, CarteCrise $carteCrise = null ): Response
    {
        if(!$carteCrise){
            $this->addFlash('error', "Cette carte n'existe pas !");
            return $this->redirectToRoute("carteCrises");
        }
        return $this->render('carteCrise/detailCarteCrise.html.twig', ['carteCrise' => $carteCrise]);
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
