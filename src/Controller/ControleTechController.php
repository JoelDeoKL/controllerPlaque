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

    #[Route('/editerControleTech/{id?0}', name: 'editerControleTech')]
    public function editerControleTech(Assurance $assurance = null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new = false;
        if(!$assurance){
            $new = true;
            $assurance = new ControleTech();
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
            return $this->render('controleTeh/addAssurance.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

}
