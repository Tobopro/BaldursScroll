<?php

namespace App\Controller;

use App\Repository\CharactersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CharactersController extends AbstractController
{
    #[Route('/builder', name: 'app_Builder')]
    public function index( CharactersRepository $charactersRepository): Response
    {
        $characters = $charactersRepository->findAll();

        foreach ($characters as $character) {
            $subRaceName = $character->getIdSubRace()->getName();
            $subClassName = $character->getIdSubClasses()->getName();
            $users = $character->getIdUsers()->getUsername();

            $character->subRaceName = $subRaceName;
            $character->subClassName = $subClassName;
            $character->users = $users;
        }

        return $this->render('builder/index.html.twig', [
            'characters' => $characters,
        ]);
    }


    
        
    

}
