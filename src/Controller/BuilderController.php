<?php

namespace App\Controller;

use App\Form\BuilderType;
use App\Entity\Characters;
use App\Repository\CharactersRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BuilderController extends AbstractController
{

    #[Route('/builder', name: 'app_builder_create')]
    public function create(EntityManagerInterface $entityManager, Request $request, CharactersRepository $charactersRepository, UserRepository $userRepository): Response
    {
        $character = new Characters();
        // $character = $charactersRepository->find(1);
        // $character->setClassWithSubClass();
        // $character->setRaceWithSubRace();
        // dd($character);

        $form = $this->createForm(BuilderType::class, $character);
        $form->handleRequest($request);
        // dump($form);
     

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($request);
            // dd($form);
            $character->setIdUsers($this->getUser());
            // $character->setIdUsers($userRepository->find(1));
            $entityManager->persist($character);
            $entityManager->flush();

            return $this->redirectToRoute('app_dashboard');
        }


        return $this->render('builder/indeex.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/builder/update/{id}', name: 'app_builder_update')]
    public function update(EntityManagerInterface $entityManager, $id, Request  $request): Response
    {
        $charactersRepository = $entityManager->getRepository(Characters::class);
        $characterResult = $charactersRepository->find($id);

        if (!$characterResult) {
            throw $this->createNotFoundException("La fiche avec l'ID $id n'existe pas.");
        }

        $form = $this->createForm(BuilderType::class, $characterResult, [
            'action' => $this->generateUrl('app_builder_update', ['id' => $id])
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->flush();
            return $this->redirectToRoute('app_dashboard');
        }



        return $this->render('builder/update.html.twig', [
            'form' => $form->createView(),
            'character' => $characterResult,
        ]);
    }

    #[Route('/builder/delete/{id}', name: 'app_builder_delete')]
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
