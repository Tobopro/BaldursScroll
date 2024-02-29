<?php

namespace App\Controller;

use App\Form\EditProfileType;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Repository\CharactersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile/{idUser}', name: 'app_profile')]
    public function show(int $idUser, UserRepository $userRepository, CharactersRepository $charactersRepository): Response
    {

        $user = $userRepository->find($idUser);
        $user = $userRepository->find($idUser);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }
        $userCharacters = $charactersRepository->findBy(['idUsers' => $idUser]);
        $numberOfCharacters = count($userCharacters);
        $numberOfComments = count($user->getCommentaries());



        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user' => $user,
            'userCharacters' => $userCharacters,
            'numberOfCharacters' => $numberOfCharacters,
            'numberOfComments' => $numberOfComments
        ]);
    }

    // delete profile
    #[Route('profile/{id<\d*>}/delete', name: 'app_profile_delete')]
    public function delete(EntityManagerInterface $entityManager, User $user): Response
    {
        $userPublic = $entityManager->getRepository(User::class)->find(1);

        if (!$userPublic) {
            throw $this->createNotFoundException("Utilisateur de remplacement non trouvé avec l\'id 1");
        }

        $characters = $user->getCharacters();
        $commentaries = $user->getCommentaries();

        foreach ($characters as $character) {
            $character->setIdUsers($userPublic);
        }

        foreach ($commentaries as $commentary) {
            $commentary->setAuthor($userPublic);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }


    #[Route('/profile/{idUser}/edit', name: 'app_profile_edit')]
    public function edit(EntityManagerInterface $entityManager, Request $request, int $idUser, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $userRepository->find($idUser);
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if current password is provided
            $currentPassword = $form->get('currentPassword')->getData();
            if ($currentPassword !== null) {
                // Validate current password
                if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                    $this->addFlash('error', 'Current password is incorrect.');
                    return $this->redirectToRoute('app_profile_edit', ['idUser' => $user->getId()]);
                }
            }

            // Update password if provided
            $newPassword = $form->get('plainPassword')->getData();
            if ($newPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            return $this->redirectToRoute('app_profile', ['idUser' => $user->getId()]);
        }

        return $this->render('profile/edit.html.twig', [
            'title' => "Modifier un utilisateur",
            'editProfileForm' => $form,
        ]);
    }

    // #[Route('/profile/{idUser}/edit', name: 'app_profile_edit')]
    // public function edit(EntityManagerInterface $entityManager, Request $request, int $idUser, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     $user = $userRepository->find($idUser);
    //     $form = $this->createForm(EditProfileType::class, $user);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // Check if current password is provided
    //         $currentPassword = $form->get('currentPassword')->getData();
    //         if ($currentPassword !== null) {
    //             // Validate current password
    //             if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
    //                 $this->addFlash('error', 'Current password is incorrect.');
    //                 return $this->redirectToRoute('app_profile_edit', ['idUser' => $user->getId()]);
    //             }
    //         }

    //         // Update password if provided
    //         $newPassword = $form->get('plainPassword')->getData();
    //         if ($newPassword) {
    //             $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
    //             $user->setPassword($hashedPassword);
    //         }

    //         $entityManager->persist($user);
    //         $entityManager->flush();

    //         $this->addFlash('success', 'L\'utilisateur a bien été modifié');
    //         return $this->redirectToRoute('app_profile', ['idUser' => $user->getId()]);
    //     }

    //     return $this->render('profile/edit.html.twig', [
    //         'title' => "Modifier un utilisateur",
    //         'editProfileForm' => $form,
    //     ]);
    // }
}
