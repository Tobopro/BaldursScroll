<?php

namespace App\Controller;

use App\Form\BuilderType;
use App\Entity\Characters;
use App\Repository\RacesRepository;
use App\Repository\ClassesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuilderController extends AbstractController
{
    #[Route('/builder/info/classes', name: 'app_builder_info_classes')]
    /**
     * This function is used to get all the classes and subclasses from the database
     *
     * @param ClassesRepository $classesRepository
     * @return void
     */
    public function getBuilderInfoClasses(ClassesRepository $classesRepository)
    {
        $result = $classesRepository->findAll();
        $response = [];
        foreach ($result as $class) {
            $newArray = [];
            $newArray["id"] = $class->getId();
            $newArray["name"] = $class->getName();
            $subclasses = $class->getSubClasses();
            $allSubclassesArray = [];
            foreach ($subclasses as $subclass) {
                $subclassArray = [];
                $subclassArray["id"] = $subclass->getId();
                $subclassArray["name"] = $subclass->getName();
                $allSubclassesArray[] = $subclassArray;
            }
            $newArray["subclasses"] = $allSubclassesArray;
            $response[] = $newArray;
        }

        print(json_encode($response));

        exit();
    }
    
    #[Route('/builder/info/races', name: 'app_builder_info_races')]
    /**
     * This function is used to get  all races from the database. It will be called by the front-end when a class has been selected in order to display
     * This function returns a JSON object with information about each race in the game.
     *
     * @param RacesRepository $racesRepository
     * @return void
     */
    public function getBuilderInfoRaces(RacesRepository $racesRepository)
    {
        $result = $racesRepository->findAll();
        $response = [];
        foreach ($result as $races) {
            $newArray = [];
            $newArray["id"] = $races->getId();
            $newArray["name"] = $races->getName();
            $subraces = $races->getSubRaces();
            $allSubracesArray = [];
            foreach ($subraces as $subrace) {
                $subraceArray = [];
                $subraceArray["id"] = $subrace->getId();
                $subraceArray["name"] = $subrace->getName();
                $allSubracesArray[] = $subraceArray;
            }
            $newArray["subraces"] = $allSubracesArray;
            $response[] = $newArray;
        }

        print(json_encode($response));

        exit();
    }


    #[Route('/builder', name: 'app_builder_create')]
    /**
     * This function is used to create a new character.
     *
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $character = new Characters();

        $form = $this->createForm(BuilderType::class, $character, [
            'attr' => ['class' => 'w-75 h-auto',
            "name" => "builder"]
        ]);
        $form->handleRequest($request);
     

        if ($form->isSubmitted() && $form->isValid()) {
            $character->setIdUsers($this->getUser());
            $entityManager->persist($character);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard');
        }


        return $this->render('builder/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/builder/update/{id}', name: 'app_builder_update')]
    #[IsGranted('edit', subject: 'id', message: 'You can only edit your own characters.')]
    /**
     * This function is used to update a character.
     *
     * @param EntityManagerInterface $entityManager
     * @param [type] $id
     * @param Request $request
     * @return Response
     */
    public function update(EntityManagerInterface $entityManager, $id, Request  $request): Response
    {
        $charactersRepository = $entityManager->getRepository(Characters::class);
        $character = $charactersRepository->find($id);
        $character->setClassWithSubClass();
        $character->setRaceWithSubRace();

        if (!$character) {
            throw $this->createNotFoundException("La fiche avec l'ID $id n'existe pas.");
        }

        $form = $this->createForm(BuilderType::class, $character, [
            'attr' => ['class' => 'w-75 h-auto',
            "name" => "builder"]
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_dashboard');
        }



        return $this->render('builder/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/builder/delete/{id}', name: 'app_builder_delete')]
    #[IsGranted('edit', subject: 'id', message: 'You can only edit your own characters.')]
    /**
     * This function is used to delete a character.
     *
     * @param EntityManagerInterface $entityManager
     * @param [type] $id
     * @return Response
     */
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $charactersRepository = $entityManager->getRepository(Characters::class);
        $characterResult = $charactersRepository->find($id);
        $entityManager->remove($characterResult);
        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }


    #[Route('/builder/{id}', name: 'app_Builder_show')]
    public function show(): Response
    {
        return $this->render('builder/show_builder.html.twig', []);
    }
}
