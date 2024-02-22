<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Entity\Commentaries;
use App\Form\CommentaryType;
use App\Form\ResponseType;
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

        // $formResponse = $this->createForm(ResponseType::class, $commentary, [
        //     'action' => $this->generateUrl('app_build_commentary', ['characterId' => $characterId])
        // ]);

       
        $commentaries = $commentariesRepository->findBy(['Build' => $characterId]);
      

        $raceSpells = $racesSpellsRepository->getAllSpells($character->getIdSubRace()->getId(), $character->getIdLevel()->getLevel());
        $classSpells = $classesSpellsRepository->getAllSpells($character->getIdSubClasses()->getId(), $character->getIdLevel()->getLevel());

        return $this->render('build/index.html.twig', [
            'controller_name' => 'BuildController',
            'character' => $character,
            'raceSpells' => $raceSpells,
            'classSpells' => $classSpells,
            'commentaries' => $commentaries,
            'form' => $form->createView(),
            // 'formResponse' => $formResponse->createView()

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

        // $response = new Commentaries();
        // $formResponse= $this->createForm(ResponseType::class, $commentary);
        // $formResponse->handleRequest($request);

        // if ($formResponse->isSubmitted() && $formResponse->isValid()) {
        //     $response->setAuthor($this->getUser());
        //     $response->setCreatedAt(new \DateTimeImmutable());
        //     $response->setBuild($characters);
        //     $response->setResponse($commentary);
        //     $entityManager->persist($response);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
        // }


        $this->addFlash('error', 'There was an error with your form');
        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

    #[Route('/build/{characterId}/commentary/{commentaryId}/delete', name: 'app_build_commentary_delete')]
    public function deleteCommentary(int $characterId, int $commentaryId, EntityManagerInterface $entityManager): Response
    {
        $commentary = $entityManager->getRepository(Commentaries::class)->find($commentaryId);
        $entityManager->remove($commentary);
        $entityManager->flush();

        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

     #[Route('/build/{characterId}/commentary/{commentaryId}/report', name: 'app_build_commentary_report')]
    public function reportCommentary(int $characterId, int $commentaryId, EntityManagerInterface $entityManager): Response
    {
        $commentary = $entityManager->getRepository(Commentaries::class)->find($commentaryId);
        $commentary->setIsFlaged(true);
        $entityManager->flush();

        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

    #[Route('/build/{characterId}/commentary/{commentaryId}/response', name: 'app_build_commentary_response')]
    public function handleResponse(int $characterId, int $commentaryId, Request $request, EntityManagerInterface $entityManager): Response
    {
        $characters = $entityManager->getRepository(Characters::class)->find($characterId);
        $commentary = $entityManager->getRepository(Commentaries::class)->find($commentaryId);

        // Récupérer les données du formulaire
        $responseText = $request->request->get('response');

        // Création de la nouvelle réponse
        $response = new Commentaries();
        $response->setAuthor($this->getUser());
        $response->setCreatedAt(new \DateTimeImmutable());
        $response->setBuild($characters);
        $response->addIsResponseTo($commentary);
        $response->setText($responseText); // Utilisez le contenu de la réponse

        // Persiste et enregistre la réponse
        $entityManager->persist($response);
        $entityManager->flush();

        $this->addFlash('success', 'Réponse envoyée avec succès.');
        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }
   
}
