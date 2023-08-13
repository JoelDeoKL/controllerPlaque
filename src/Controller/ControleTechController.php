<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ControleTech;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AssuranceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ControleTechController extends AbstractController
{
    #[Route('/controleTech', name: 'controleTech')]
    public function controleTech(EntityManagerInterface $entityManager): Response
    {
        $controleTech = $entityManager->getRepository(ControleTech::class)->findAll();

        return $this->render('controleTech/controleTech.html.twig', ['controleTech' => $controleTech]);
    }

    #[Route('/ajouterAssurance/{id?0}', name: 'ajouterAssurance')]
    public function ajouterAssurance(Assurance $assurance = null, ManagerRegistry $doctrine, Request $request): Response
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
