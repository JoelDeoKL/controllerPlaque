<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Assurance;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AssuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class AssuranceController extends AbstractController
{
    #[Route('/assurances', name: 'assurances')]
    public function assurances(EntityManagerInterface $entityManager): Response
    {
        $assurances = $entityManager->getRepository(Assurance::class)->findAll();

        return $this->render('assurance/assurance.html.twig', ['assurances' => $assurances]);
    }

    #[Route('/ajouterAssurance/{id?0}', name: 'ajouterAssurance')]
    public function ajouterAssurance(Assurance $assurance = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $new = false;
        if(!$assurance){
            $new = true;
            $assurance = new Assurance();
        }

        $form = $this->createForm(AssuranceType::class, $assurance);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($assurance);

            $manager->flush();

            if($new){
                $message = " a été ajouter avec succès";
            }else{
                $message = " a été editer avec succès";
            }

            $this->addFlash("succes", $assurance->getNumAgreement() . $message);

            return $this->redirectToRoute("assurances");
        }else{
            return $this->render('assurance/addAssurance.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

}
