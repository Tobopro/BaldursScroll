<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\Commentaries;
use App\Form\CommentaryType;
use App\Repository\CharactersRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RacesSpellsRepository;
use App\Repository\CommentariesRepository;
use App\Repository\ClassesSpellsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuildController extends AbstractController
{
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

        $commentary = new Commentaries();
        $form = $this->createForm(CommentaryType::class, $commentary, [
            'action' => $this->generateUrl('app_build_commentary', ['characterId' => $characterId])
        ]);


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
            'form' => $form->createView(),

        ]);
    }

    #[Route('/build/{characterId}/commentary', name: 'app_build_commentary')]
    public function createCommentary(int $characterId, Request $request, EntityManagerInterface $entityManager): Response
    {

        $characters = $entityManager->getRepository(Characters::class)->find($characterId);
        $commentary = new Commentaries();
        $form = $this->createForm(CommentaryType::class, $commentary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentary->setAuthor($this->getUser());
            $commentary->setCreatedAt(new \DateTimeImmutable());
            $commentary->setBuild($characters);
            $entityManager->persist($commentary);
            $entityManager->flush();

            return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
        }

        $this->addFlash('error', 'There was an error with your form');
        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

   
}
