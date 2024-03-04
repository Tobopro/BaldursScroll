<?php

namespace App\Controller;

use App\Entity\Characters;
use App\Form\ResponseType;
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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuildController extends AbstractController
{
    #[Route('/build/{characterId}', name: 'app_build')]
    #[IsGranted('view', subject: 'characterId')]
    public function index(
        int $characterId,
        CharactersRepository $charactersRepository,
        RacesSpellsRepository $racesSpellsRepository,
        ClassesSpellsRepository $classesSpellsRepository,
        CommentariesRepository $commentariesRepository
    ): Response {
        $character = $charactersRepository->find($characterId);

        if (!$character) {
            throw $this->createNotFoundException('Character not found');
        }

        $commentary = new Commentaries();
        $form = $this->createForm(CommentaryType::class, $commentary, [
            'action' => $this->generateUrl('app_build_commentary', ['characterId' => $characterId])
        ]);

        $commentaries = $commentariesRepository->createQueryBuilder('c')
            ->where('c.Build = :characterId')
            ->andWhere('c.response IS NULL')
            ->setParameter('characterId', $characterId)
            ->getQuery()
            ->getResult();

        $responses = $commentariesRepository->createQueryBuilder('c')
            ->where('c.Build = :characterId')
            ->andWhere('c.response IS NOT NULL')
            ->setParameter('characterId', $characterId)
            ->getQuery()
            ->getResult();

        $raceSpells = $racesSpellsRepository->getAllSpells($character->getIdSubRace()->getId(), $character->getIdLevel()->getLevel());
        $classSpells = $classesSpellsRepository->getAllSpells($character->getIdSubClasses()->getId(), $character->getIdLevel()->getLevel());

        return $this->render('build/index.html.twig', [
            'controller_name' => 'BuildController',
            'character' => $character,
            'raceSpells' => $raceSpells,
            'classSpells' => $classSpells,
            'commentaries' => $commentaries,
            'form' => $form->createView(),
            'responses' => $responses
        ]);
    }

    #[Route('/build/{characterId}/liked', name: 'app_build_liked')]
    public function liked(int $characterId, EntityManagerInterface $entityManager): Response
    {
        $character = $entityManager->getRepository(Characters::class)->find($characterId);
        $user = $this->getUser();

        if ($character->getLiked()->contains($user)) {
            $character->removeLiked($user);
        } else {
            $character->addLiked($user);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
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
    public function deleteCommentary(int $characterId, int $commentaryId, EntityManagerInterface $entityManager, Request $request): Response
    {

        $responseId = $request->query->get('responseId');
        if ($responseId) {
            $response = $entityManager->getRepository(Commentaries::class)->find($responseId);
            $response->setResponse(null);
            $entityManager->remove($response);
            $entityManager->flush();
            return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
        }
        $commentary = $entityManager->getRepository(Commentaries::class)->find($commentaryId);
        // dd($commentary);
        if ($commentary->getIsResponseTo()) {
            $commentary->removeIsResponseTo($commentary);
        }
        $entityManager->remove($commentary);
        $entityManager->flush();

        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

    #[Route('/build/{characterId}/commentary/{commentaryId}/report', name: 'app_build_commentary_report')]
    public function reportCommentary(int $characterId, int $commentaryId, EntityManagerInterface $entityManager, Request $request): Response
    {

        $responseId = $request->query->get('responseId');
        if ($responseId) {
            $response = $entityManager->getRepository(Commentaries::class)->find($responseId);
            $response->setIsFlaged(true);
            $entityManager->flush();
            return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
        }
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
        $response->setResponse($commentary);
        $response->setText($responseText); // Utilisez le contenu de la réponse

        // Persiste et enregistre la réponse
        $entityManager->persist($response);
        $entityManager->flush();

        $this->addFlash('success', 'Réponse envoyée avec succès.');
        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

    // Report a build
    #[Route('/build/{characterId}/report', name: 'app_build_report')]
    public function flagBuild(int $characterId, EntityManagerInterface $entityManager): Response
    {
        $character = $entityManager->getRepository(Characters::class)->find($characterId);

        if (!$character) {
            throw $this->createNotFoundException('Character not found');
        }

        $character->setIsFlaged(true);
        $entityManager->flush();

        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }

    // Undo the Report of a build
    #[Route('/build/{characterId}/report', name: 'app_build_undo_report')]
    public function unFlagBuild(int $characterId, EntityManagerInterface $entityManager): Response
    {
        $character = $entityManager->getRepository(Characters::class)->find($characterId);

        if (!$character) {
            throw $this->createNotFoundException('Character not found');
        }

        $character->setIsFlaged(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_build', ['characterId' => $characterId]);
    }
}
