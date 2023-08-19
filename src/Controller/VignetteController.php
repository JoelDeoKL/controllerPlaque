<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Vignette;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\VignetteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class VignetteController extends AbstractController
{
    #[Route('/vignettes', name: 'vignettes')]
    public function vignettes(EntityManagerInterface $entityManager): Response
    {
        $vignettes = $entityManager->getRepository(Vignette::class)->findAll();

        return $this->render('vignette/vignette.html.twig', ['vignettes' => $vignettes]);
    }

    #[Route('/editerVignette/{id?0}', name: 'editerVignette')]
    public function editerVignette(Vignette $vignette = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $new = false;
        if(!$vignette){
            $new = true;
            $vignette = new Vignette();
        }

        $form = $this->createForm(VignetteType::class, $vignette);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($vignette);

            $manager->flush();

            if($new){
                $message = " a été ajouter avec succès";
            }else{
                $message = " a été editer avec succès";
            }

            $this->addFlash("succes", $vignette->getNumPlaque() . $message);

            return $this->redirectToRoute("vignettes");
        }else{
            return $this->render('vignette/addVignette.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/detailVignette/{id?0}', name: 'detailVignette')]
    public function detailVignette(ManagerRegistry $doctrine, Vignette $vignette = null ): Response
    {
        if(!$vignette){
            $this->addFlash('error', "Cette vignette n'existe pas !");
            return $this->redirectToRoute("vignettes");
        }
        return $this->render('vignette/detailVignette.html.twig', ['vignette' => $vignette]);
    }

    #[Route('/deleteVignette/{id?0}', name: 'deleteVignette')]
    public function deleteVignette(Vignette $vignette = null, ManagerRegistry $doctrine, $id): Response
    {

        $repository = $doctrine->getRepository(Vignette::class);
        $vignette = $repository->find($id);

        $manager = $doctrine->getManager();
        $manager->remove($vignette);

        $manager->flush();

        $message = " a été supprimer avec succès";


        $this->addFlash("succes", $vignette->getPrenom() . $message);

        return $this->redirectToRoute("vignettes");

    }

}
