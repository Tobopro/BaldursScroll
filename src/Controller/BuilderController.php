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
    #[Route('/builder', name: 'app_Builder')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        // get all Races from DataBase
        $raceRepository         =       $entityManager->getRepository(Races::class);
        $raceResult             =       $raceRepository->findAll();

        // get all SubRaces from DataBase
        $subRacesRepository     =       $entityManager->getRepository(SubRaces::class);
        $subRaceResult          =       $subRacesRepository->findAll();

        //  get all Classes from DataBase
        $ClassesRepository      =       $entityManager->getRepository(Classes::class);
        $ClassesResult          =       $ClassesRepository->findAll();

        //  get all subClasses from DataBase
        $subClassesRepository   =       $entityManager->getRepository(SubClasses::class);
        $subClassesResult          =    $subClassesRepository->findAll();

        $character = new Characters();

        $form = $this->createForm(BuilderType::class, $character);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($character);
            $entityManager->flush();
            return $this->redirectToRoute('app_Builder_show', ['id' => $character->getId()]);
        }

        if (!$raceResult || !$subRaceResult || !$ClassesResult || !$subClassesResult) {
            throw $this->createNotFoundException('not found');
        }
        
        
        return $this->render('builder/index.html.twig', [
            'races'       => $raceResult,
            'subRaces'    => $subRaceResult,
            'classes'     => $ClassesResult,
            'subClasses'  => $subClassesResult,
            'form'        => $form->createView(),
        ]);
    }

    #[Route('/builder/{id}', name: 'app_Builder_show')]
    public function show(): Response
    {
        return $this->render('builder/show_builder.html.twig', []);
    }
}
