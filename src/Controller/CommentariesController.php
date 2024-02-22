<?php

namespace App\Controller;

use App\Entity\Commentaries;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentariesController extends AbstractController
{
    // #[Route('/commentaries', name: 'app_commentaries')]
    // public function create(EntityManagerInterface $entityManager, Request $request): Response
    // {
    //     $commentary = new Commentaries();

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $commentary->setIdUsers($this->getUser());
    //         $entityManager->persist($character);
    //         $entityManager->flush();



    //         return $this->redirectToRoute('app_dashboard');
    //     }


    //     return $this->render('builder/index.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }
}
