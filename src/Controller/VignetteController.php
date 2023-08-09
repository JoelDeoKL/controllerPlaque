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

    #[Route('/ajouterVignette/{id?0}', name: 'ajouterVignette')]
    public function ajouterVignette(Vignette $vignette = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
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

}
