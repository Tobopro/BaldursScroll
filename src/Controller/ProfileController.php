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
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class ProfileController extends AbstractController
{
    #[Route('/profile/{idUser}', name: 'app_profile')]
    // #[IsGranted('view_profile', subject: 'idUser', message: 'You cannot view this profile.')]
    public function show(
        int $idUser,
        UserRepository $userRepository,
        CharactersRepository $charactersRepository
    ): Response {

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
    #[IsGranted('edit_profile', subject: 'idUser', message: 'You cannot delete this profile.')]
    public function delete(EntityManagerInterface $entityManager, User $user): Response
    {
        $userPublic = $entityManager->getRepository(User::class)->find(1);

        if (!$userPublic) {
            throw $this->createNotFoundException("User not found");
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
    #[IsGranted('edit_profile', subject: 'idUser', message: 'You cannot edit this profile.')]
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

            $this->addFlash('success', 'The user has been updated successfully.');
            return $this->redirectToRoute('app_profile', ['idUser' => $user->getId()]);
        }

        return $this->render('profile/edit.html.twig', [
            'title' => "Modifier un utilisateur",
            'editProfileForm' => $form,
        ]);
    }


    #[Route('/profile/{idUser}/upload-profile-picture', name: 'upload_profile_picture')]
    #[IsGranted('edit_profile', subject: 'idUser', message: 'You cannot change the picture for this profile.')]
    public function uploadProfilePicture(Request $request, int $idUser, EntityManagerInterface $entityManager): Response
    {
        // Find the user by id
        $user = $entityManager->getRepository(User::class)->find($idUser);

        if ($request->isMethod('POST')) {
            $uploadedFile = $request->files->get('profilePicture');

            if ($uploadedFile) {
                $newFilename = 'profile_pic_' . md5(uniqid()) . '.' . $uploadedFile->getClientOriginalExtension();

                $uploadsDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads/profile_pictures';
                $uploadedFile->move($uploadsDirectory, $newFilename);

                $oldFilename = $user->getProfilePicture();
                if ($oldFilename) {
                    $oldFilePath = $uploadsDirectory . '/' . basename($oldFilename);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $user->setProfilePicture('/uploads/profile_pictures/' . $newFilename);

                $entityManager->flush();

                return $this->redirectToRoute('app_profile', ['idUser' => $idUser]);
            } else {
                $this->addFlash('error', 'No file uploaded.');
                return $this->redirectToRoute('app_profile', ['idUser' => $idUser]);
            }
        }

        return $this->render('profile/upload_profile_picture.html.twig');
    }

    #[Route('/profile/{idUser}/delete-profile-picture', name: 'delete_profile_picture')]
    #[IsGranted('edit_profile', subject: 'idUser', message: 'You cannot delete the profile picture of this profile.')]
    public function deleteProfilePicture(int $idUser, EntityManagerInterface $entityManager): Response
    {
        // Find the user by id
        $user = $entityManager->getRepository(User::class)->find($idUser);
        $profilePictureRand = rand(1, 1000);

        // Delete the old profile picture if it exists
        $oldFilename = $user->getProfilePicture();
        if ($oldFilename) {
            $uploadsDirectory = $this->getParameter('kernel.project_dir') . '/public/uploads/profile_pictures';
            $oldFilePath = $uploadsDirectory . '/' . basename($oldFilename);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            // Update the user's profile picture field
            $user->setProfilePicture('https://picsum.photos/seed/' . $profilePictureRand . '/200/300');
            // Save the changes to the database
            $entityManager->flush();
        }

        // Redirect to the profile page
        return $this->redirectToRoute('app_profile', ['idUser' => $idUser]);
    }
}
