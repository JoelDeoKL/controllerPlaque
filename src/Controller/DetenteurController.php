<?php

namespace App\Controller;

use App\Entity\Detenteur;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\DetenteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Annotation\Route;

class DetenteurController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(): Response
    {
        return $this->render('home/index2.html.twig');
    }

    #[Route('/', name: 'app_home')]
    public function controller(): Response
    {
        return $this->render('home/simple-results.html.twig');
    }

    #[Route('/detenteurs', name: 'detenteurs')]
    public function detenteurs(EntityManagerInterface $entityManager): Response
    {
        $detenteurs = $entityManager->getRepository(Detenteur::class)->findAll();

        return $this->render('detenteur/detenteur.html.twig', ['detenteurs' => $detenteurs]);
    }

    #[Route('/ajouterDetenteur/{id?0}', name: 'ajouterDetenteur')]
    public function ajouterDetenteur(Detenteur $detenteur = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $new = false;
        if(!$detenteur){
            $new = true;
            $detenteur = new Detenteur();
        }

        $form = $this->createForm(DetenteurType::class, $detenteur);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $image = $form->get('photo')->getData();

            if ($image) {

                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                try {
                    $image->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $detenteur->setPhoto($newFilename);
            }


            $manager = $doctrine->getManager();
            $manager->persist($detenteur);

            $manager->flush();

            if($new){
                $message = " a été ajouter avec succès";
            }else{
                $message = " a été editer avec succès";
            }

            $this->addFlash("succes", $detenteur->getNom() . $message);

            return $this->redirectToRoute("detenteurs");
        }else{
            return $this->render('detenteur/addDetenteur.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/detailDetenteur/{id?0}', name: 'detailDetenteur')]
    public function detailDetenteur(ManagerRegistry $doctrine, Detenteur $detenteur = null ): Response
    {
        if(!$detenteur){
            $this->addFlash('error', "Ce détenteur n'existe pas !");
            return $this->redirectToRoute("detenteurs");
        }
        return $this->render('detenteur/detailDetenteur.html.twig', ['detenteur' => $detenteur]);
    }

}
