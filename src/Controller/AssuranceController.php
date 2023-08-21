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

    #[Route('/editerAssurance/{id?0}', name: 'editerAssurance')]
    public function editerAssurance(Assurance $assurance = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
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

    #[Route('/detailAssurance/{id?0}', name: 'detailAssurance')]
    public function detailAssurancce(ManagerRegistry $doctrine, Assurance $assurance = null ): Response
    {
        if(!$assurance){
            $this->addFlash('error', "L'assurance n'existe pas !");
            return $this->redirectToRoute("assurances");
        }
        return $this->render('assurance/detailAssurance.html.twig', ['assurance' => $assurance]);
    }

    #[Route('/deleteAssurance/{id?0}', name: 'deleteAssurance')]
    public function deleteAssurance(Assurance $assurance = null, ManagerRegistry $doctrine, $id): Response
    {

        $repository = $doctrine->getRepository(Assurance::class);
        $assurance = $repository->find($id);

        $manager = $doctrine->getManager();
        $manager->remove($assurance);

        $manager->flush();

        $message = "L'assurance a été supprimer avec succès";

        $this->addFlash("succes", $message);

        return $this->redirectToRoute("assurances");

    }

}
