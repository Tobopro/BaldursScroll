<?php

namespace App\Controller;

use App\Repository\CommentariesRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
}
