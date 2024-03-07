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
    /**
     * This function is used to display all the characters in a paginated way. 
     *
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param CharactersRepository $charactersRepository
     * @param ClassesRepository $classesRepository
     * @param SubClassesRepository $subClassesRepository
     * @param RacesRepository $racesRepository
     * @param SubRacesRepository $subRacesRepository
     * @return Response
     */
    public function index(PaginatorInterface $paginator,
     Request $request,
     CharactersRepository $charactersRepository,
     ClassesRepository $classesRepository,
     SubClassesRepository $subClassesRepository,
     RacesRepository $racesRepository,
     SubRacesRepository $subRacesRepository): Response
    {
        $characters = $charactersRepository->findAllPublicCharacters();

        $allCharacters = $request->query->get('allCharacters');
        if ($allCharacters && $this->isGranted('ROLE_ADMIN')) {
            $characters = $charactersRepository->findAll();
        }
        
        $mostLiked = $request->query->get('mostLiked');
        if ($mostLiked) {
            // Create an array to store the number of likes for each character
            $likesCount = [];
            foreach ($characters as $character) {
                // Calculate the total number of likes for each character
                $totalLikes = $character->getLikes();
                // Store the total number of likes in the array
                $likesCount[$character->getId()] = $totalLikes;
            }

            // Sort the $characters array based on the total number of likes
            usort($characters, function($a, $b) use ($likesCount) {
                return $likesCount[$b->getId()] - $likesCount[$a->getId()];
            });
        } else {
            $characters = array_reverse($characters);
        }
        
        $searchTerm = $request->query->get('search'); 

        if ($searchTerm) {            
               // Get characters based on the search term
            $characters = $charactersRepository->search($searchTerm);
        }

        $classes= $classesRepository->findAll();
        $races= $racesRepository->findAll();

        // Get the value of the class filter from
        $classFilter = $request->query->get('classFilter');
        $raceFilter = $request->query->get('raceFilter');

        if ($classFilter || $raceFilter) {
            //  Initialize the filtering criteria array
            $criteria = [];

            // If the class filter is set, add it to the filtering criteria
            if ($classFilter) {
                $charactersBySubClasses = $subClassesRepository->findByidClass($classFilter);
                $criteria['idSubClasses'] = $charactersBySubClasses;
            }

            // If the race filter is set, add it to the filtering criteria
            if ($raceFilter) {
                $charactersBySubRaces = $subRacesRepository->findByidRace($raceFilter);
                $criteria['idSubRace'] = $charactersBySubRaces;
            }

            // Use the filtering criteria to get the characters
            $characters = $charactersRepository->findBy($criteria);
        }
     
      

        foreach ($characters as $character) {
            $subRaceName = $character->getIdSubRace()->getName();
            $subClassName = $character->getIdSubClasses()->getName();

            $character->subRaceName = $subRaceName;
            $character->subClassName = $subClassName;
        }

        $pagination = $paginator->paginate(
            $characters,
            $request->query->getInt('page', 1), // The current page number
            8 // The number of items per page
        );

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'pagination' => $pagination,
            'classes' => $classes,
            'races' => $races,
            'classFilter' => $classFilter,
            'raceFilter' => $raceFilter,
            
        ]);
    }
}
