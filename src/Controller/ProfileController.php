<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use App\Repository\UserRepository;
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
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_profile');
    }


    // Edit ptofile
    #[Route('/profile/{idUser}/edit', name: 'app_profile_edit')]
    // public function edit(int $idUser, UserRepository $userRepository, EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     $user = $userRepository->find($idUser);
    //     if (!$user) {
    //         throw $this->createNotFoundException('User not found');
    //     }

    //     $form = $this->createForm(EditProfileType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $submittedData = $form->getData();
    //         $currentPassword = $submittedData->getPassword();

    //         if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
    //             $this->addFlash('error', 'Current password is incorrect.');
    //             return $this->redirectToRoute('app_profile_edit', ['idUser' => $user->getId()]);
    //         }

    //         // Hash and set new password
    //         $newPassword = $submittedData->getNewPassword();
    //         $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
    //         $user->setPassword($hashedPassword);

    //         $entityManager->flush();

    //         $this->addFlash('success', 'User profile updated successfully.');
    //         return $this->redirectToRoute('app_profile');
    //     }

    //     return $this->render('profile/edit.html.twig', [
    //         'editProfileForm' => $form->createView(),
    //         'idUser' => $user->getId()
    //     ]);
    // }

    #[Route('/profile/{idUser}/edit', name: 'app_profile_edit')]
    public function edit(EntityManagerInterface $entityManager, Request $request, int $idUser, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($idUser);
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
}
