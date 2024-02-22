<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentariesController extends AbstractController
{
    #[Route('/commentaries', name: 'submit_commentary')]
    public function index(): Response
    {
        return $this->render('commentaries/index.html.twig', [
            'controller_name' => 'CommentariesController',
        ]);
    }
}
