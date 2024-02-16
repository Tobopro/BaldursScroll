<?php

namespace App\Controller;

use App\Entity\Races;
use App\Entity\Classes;
use App\Entity\SubRaces;
use App\Form\BuilderType;
use App\Entity\Characters;
use App\Entity\SubClasses;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BuilderController extends AbstractController
{
    // #[Route('/builder', name: 'app_Builder')]
    // public function index(EntityManagerInterface $entityManager, Request $request): Response
    // {
   
    //     $raceRepository         =       $entityManager->getRepository(Races::class);
    //     $raceResult             =       $raceRepository->findAll();

    
    //     $subRacesRepository     =       $entityManager->getRepository(SubRaces::class);
    //     $subRaceResult          =       $subRacesRepository->findAll();

   
    //     $ClassesRepository      =       $entityManager->getRepository(Classes::class);
    //     $ClassesResult          =       $ClassesRepository->findAll();

   
    //     $subClassesRepository   =       $entityManager->getRepository(SubClasses::class);
    //     $subClassesResult          =    $subClassesRepository->findAll();

       

    //     if (!$raceResult || !$subRaceResult || !$ClassesResult || !$subClassesResult) {
    //         throw $this->createNotFoundException('not found');
    //     }
        
        
    //     return $this->render('builder/index.html.twig', [
    //         'races'       => $raceResult,
    //         'subRaces'    => $subRaceResult,
    //         'classes'     => $ClassesResult,
    //         'subClasses'  => $subClassesResult,
    //         'form'        => $form->createView(),
    //     ]);
    // }

    #[Route('/builder', name: 'app_builder_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response {
            $character = new Characters();

            $form = $this->createForm(BuilderType::class, $character);
            $form->handleRequest($request);
           
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($character);
                $entityManager->flush();
                
                
                return $this->redirectToRoute('app_builder_create');
            }
            

            return $this->render('builder/index.html.twig', [
                'form' => $form->createView(),
            ]);
        
    }

    
    #[Route('/builder/update/{id}', name: 'app_builder_update')]
    public function update( EntityManagerInterface $entityManager, $id, Request  $request) : Response
     {
        $charactersRepository = $entityManager->getRepository(Characters::class);
        $characterResult = $charactersRepository->find($id);

        if (!$characterResult) {
            throw $this->createNotFoundException("La fiche avec l'ID $id n'existe pas.");
        }
 
        $form = $this->createForm(BuilderType::class, $characterResult);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            
            
                $entityManager->flush();
                return $this->redirectToRoute('app_Builder_show', ['id' => $characterResult->getId()]);
        }

 
       
            return $this->render('builder/index.html.twig', [
                'form' => $form->createView(),
                'character' => $characterResult,
            ]);
     }

    #[Route('/builder/delete/{id}', name: 'app_builder_delete')]
    public function delete( EntityManagerInterface $entityManager, $id): Response
    {
        $charactersRepository = $entityManager->getRepository(Characters::class);
        $characterResult = $charactersRepository->find($id);
        $entityManager->remove($characterResult);
        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }


    #[Route('/builder/{id}', name: 'app_Builder_show')]
    public function show(): Response
    {
        return $this->render('builder/show_builder.html.twig', []);
    }

}
