<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ControleTech;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\ControleTechType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ControleTechController extends AbstractController
{
    #[Route('/controleTech', name: 'controleTech')]
    public function controleTech(EntityManagerInterface $entityManager): Response
    {
        $controleTechs = $entityManager->getRepository(ControleTech::class)->findAll();

        return $this->render('controle_tech/controleTech.html.twig', ['controleTechs' => $controleTechs]);
    }

    #[Route('/editerControleTech/{id?0}', name: 'editerControleTech')]
    public function editerControleTech(ControleTech $controleTech = null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new = false;
        if(!$controleTech){
            $new = true;
            $controleTech = new ControleTech();
        }

        $form = $this->createForm(ControleTechType::class, $controleTech);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $manager = $doctrine->getManager();
            $manager->persist($controleTech);

            $manager->flush();

            if($new){
                $message = "Le control a été ajouter avec succès";
            }else{
                $message = "Me control a été editer avec succès";
            }

            $this->addFlash("succes", $message);

            return $this->redirectToRoute("controleTech");
        }else{
            return $this->render('controle_tech/addControleTech.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/detailControleTech/{id?0}', name: 'detailControleTech')]
    public function detailControleTech(ManagerRegistry $doctrine, ControleTech $controleTech = null ): Response
    {
        if(!$controleTech){
            $this->addFlash('error', "Ce détenteur n'existe pas !");
            return $this->redirectToRoute("detenteurs");
        }
        return $this->render('controle_tech/detailControlTech.html.twig', ['controleTech' => $controleTech]);
    }

    #[Route('/deleteControleTech/{id?0}', name: 'deleteControleTech')]
    public function deleteControleTech(ControleTech $controleTech = null, ManagerRegistry $doctrine, $id): Response
    {

        $repository = $doctrine->getRepository(ControleTech::class);
        $controleTech = $repository->find($id);

        $manager = $doctrine->getManager();
        $manager->remove($controleTech);

        $manager->flush();

        $message = " a été supprimer avec succès";


        $this->addFlash("succes", $controleTech->getPrenom() . $message);

        return $this->redirectToRoute("controleTech");

    }

}
