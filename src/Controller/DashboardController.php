<?php

namespace App\Controller;

use App\Repository\CharactersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Characters;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(PaginatorInterface $paginator, Request $request, CharactersRepository $charactersRepository): Response
    {
        $characters = $charactersRepository->findAll();
      
        $characters= array_reverse($characters);

        foreach ($characters as $character) {
            $subRaceName = $character->getIdSubRace()->getName();
            $subClassName = $character->getIdSubClasses()->getName();

            $character->subRaceName = $subRaceName;
            $character->subClassName = $subClassName;
        }

        $pagination = $paginator->paginate(
            $characters,
            $request->query->getInt('page', 1), // Le numéro de la page actuelle
            3 // Nombre d'éléments par page
        );

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'pagination' => $pagination,
            // 'characters' => $characters 
        ]);
    }
}
