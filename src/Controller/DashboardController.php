<?php

namespace App\Controller;

use App\Repository\CharactersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Characters;
use App\Repository\ClassesRepository;
use App\Repository\RacesRepository;
use App\Repository\SubClassesRepository;
use App\Repository\SubRacesRepository;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(PaginatorInterface $paginator,
     Request $request,
     CharactersRepository $charactersRepository,
     ClassesRepository $classesRepository,
     SubClassesRepository $subClassesRepository,
     RacesRepository $racesRepository,
     SubRacesRepository $subRacesRepository): Response
    {
        $characters = $charactersRepository->findAll();
      
        $characters= array_reverse($characters);

        
        $searchTerm = $request->query->get('search'); 

        if ($searchTerm) {            
               // Récupérez les personnages en fonction du terme de recherche
            $characters = $charactersRepository->search($searchTerm);
        }

        $classes= $classesRepository->findAll();
        $races= $racesRepository->findAll();

        // Récupérer la valeur du filtre de classe depuis la requête GET
        $classFilter = $request->query->get('classFilter');
        if ($classFilter) {
            $charactersBySubClasses = $subClassesRepository->findByidClass($classFilter);
            $characters = $charactersRepository->findBy(['idSubClasses' => $charactersBySubClasses]);
           
        }

        // Récupérer la valeur du filtre de classe depuis la requête GET
        $raceFilter = $request->query->get('raceFilter');
        if ($raceFilter) {
            $charactersBySubRaces = $subRacesRepository->findByidRace($raceFilter);
            $characters = $charactersRepository->findBy(['idSubRace' => $charactersBySubRaces]);
           
        }
     
      

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
            'classes' => $classes,
            'races' => $races,
            // 'characters' => $characters 
        ]);
    }
}
