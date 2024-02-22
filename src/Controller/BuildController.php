<?php

namespace App\Controller;

use App\Repository\CharactersRepository;
use App\Repository\ClassesSpellsRepository;
use App\Repository\CommentariesRepository;
use App\Repository\RacesSpellsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuildController extends AbstractController
{
    // #[Route('/build', name: 'app_build')]
    // public function index(CharactersRepository $charactersRepository): Response
    // {
    //     $characters = $charactersRepository->findAll();

    //     foreach ($characters as $character) {
    //         $subRaceName = $character->getIdSubRace()->getName();
    //         $subClassName = $character->getIdSubClasses()->getName();
    //         $users = $character->getIdUsers()->getUsername();

    //         $character->subRaceName = $subRaceName;
    //         $character->subClassName = $subClassName;
    //         $character->users = $users;
    //     }

    //     return $this->render('build/index.html.twig', [
    //         'controller_name' => 'BuildController',
    //         'characters' => $characters,
    //     ]);
    // }

    #[Route('/build/{characterId}', name: 'app_build')]
    public function index(int $characterId, 
    CharactersRepository $charactersRepository,
    RacesSpellsRepository $racesSpellsRepository,
    ClassesSpellsRepository $classesSpellsRepository,
    CommentariesRepository $commentariesRepository): Response
    {
        $character = $charactersRepository->find($characterId);

        if (!$character) {
            throw $this->createNotFoundException('Character not found');
        }
        // Récupérer les sorts associés à la race du personnage
        // $raceId = $character->getIdSubRace()->getId();
        // $spellsForRace = $racesSpellsRepository->findSpellsByRace($raceId);


        $commentaries = [
            'commentary1' => 'This is a commentary',
            'commentary2' => 'This is another commentary',
        ];
        // if ($this->getUser()) {
        //     $commentaries = $commentariesRepository->findBy(['idBuild' => $characterId]);
        // } else {
        //     $commentaries = [];
        // }

        $raceSpells = $racesSpellsRepository->getAllSpells($character->getIdSubRace()->getId(), $character->getIdLevel()->getLevel());
        $classSpells = $classesSpellsRepository->getAllSpells($character->getIdSubClasses()->getId(), $character->getIdLevel()->getLevel());

        return $this->render('build/index.html.twig', [
            'controller_name' => 'BuildController',
            'character' => $character,
            'raceSpells' => $raceSpells,
            'classSpells' => $classSpells,
            'commentaries' => $commentaries,

        ]);
    }

   
}
