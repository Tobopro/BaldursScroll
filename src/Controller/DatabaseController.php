<?php
// src/Controller/DatabaseController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Test;

class DatabaseController extends AbstractController
{
    /**
     * @Route("/test-database", name="test_database")
     */
    public function readDatabase(EntityManagerInterface $entityManager): Response
    {
        $testRepository = $entityManager->getRepository(Test::class);
        $tests = $testRepository->findAll();

        // Affichez les données à partir de la base de données (pour le test)
        dump($tests);

        return $this->render('database/test.html.twig', [
            'dataFromDatabase' => $tests,
        ]);
    }
}
