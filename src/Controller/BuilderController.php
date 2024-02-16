<?php

namespace App\Controller;

use App\Entity\Classes;
use App\Entity\Races;
use App\Entity\SubClasses;
use App\Entity\SubRaces;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class BuilderController extends AbstractController
{
    #[Route('/builder', name: 'app_Builder')]
    public function index(EntityManagerInterface $entityManager): Response
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

        if (!$raceResult || !$subRaceResult || !$ClassesResult || !$subClassesResult) {
            throw $this->createNotFoundException('not found');
        }
        
        
        return $this->render('builder/index.html.twig', [
            'races'       => $raceResult,
            'subRaces'    => $subRaceResult,
            'classes'     => $ClassesResult,
            'subClasses'  => $subClassesResult
        ]);
    }

    #[Route('/builder/{id}', name: 'app_Builder_show')]
    public function show(): Response
    {
        return $this->render('builder/show_builder.html.twig', []);
    }
}
