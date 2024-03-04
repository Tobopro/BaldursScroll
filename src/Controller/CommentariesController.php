<?php

namespace App\Controller;

use App\Entity\Commentaries;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentariesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentariesController extends AbstractController
{
    #[Route('userCommentaries/{userId}/', name: 'app_commentaries_user')]
    public function index(int $userId ,CommentariesRepository $commentariesRepository): Response
    {

        $commentaries = $commentariesRepository->findBy(['Author' => $userId]);
        return $this->render('commentaries/index.html.twig', [
            'controller_name' => 'CommentariesController',
            'commentaries' => $commentaries,
        ]);
    }

    #[Route('commentariesFlaged/', name: 'app_commentary_flaged')]
    public function indexFlaged(CommentariesRepository $commentariesRepository): Response
    {

         $commentariesRegex = $commentariesRepository->findCommentariesByWords(['dumb', 'fuck', 'shit', 'bitch', 'dumbass', 'ass']);



        $commentaries = $commentariesRepository->findBy(['isFlaged' => true]);
        return $this->render('commentaries/flaged.html.twig', [
            'controller_name' => 'CommentariesController',
            'commentaries' => $commentaries,
            'commentariesRegex' => $commentariesRegex
        ]);
    }

    #[Route('commentariesFlaged/unflag/{idCommentary}', name: 'app_commentary_unflaged')]
    public function unflagCommentary(int $idCommentary, EntityManagerInterface $entityManager): Response
    {
    
        $commentary = $entityManager->getRepository(Commentaries::class)->find($idCommentary);
        $commentary->setIsFlaged(false);
        $entityManager->flush();

        return $this->redirectToRoute('app_commentary_flaged');
    }

    #[Route('commentariesFlaged/delete/{idCommentary}', name: 'app_commentary_delete')]
    public function deleteCommentary(int $idCommentary, EntityManagerInterface $entityManager): Response
    {
        $commentary = $entityManager->getRepository(Commentaries::class)->find($idCommentary);
        $entityManager->remove($commentary);
        $entityManager->flush();

        return $this->redirectToRoute('app_commentary_flaged');
    }
    
    
}
