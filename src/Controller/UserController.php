<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\EditUserType;
use App\Form\CreateUserType;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    /**
     * This function is used to display all the users in a paginated way.
     *
     * @param UserRepository $userRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(
        UserRepository $userRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $users = $userRepository->createQueryBuilder('u');

        $sortBy = $request->query->get('sort');
        $sortDir = $request->query->get('direction');

        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedHttpException('Access Denied');
        }

        if ($sortBy && $sortDir) {
            $users->orderBy($sortBy, $sortDir);
        }

        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            3
        );

        $newUser = new User();
        $form = $this->createForm(CreateUserType::class, $newUser, [
            'action' => $this->generateUrl('app_user_handleCreate'),
        ]);

        return $this->render('user/index.html.twig', [
            'users' => $pagination,
            'createForm' => $form
        ]);
    }

    #[Route('/{id<\d*>}', name: 'app_user_show')]
    /**
     * This function is used to display the profile of a user.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/handlecreate', name: 'app_user_handleCreate')]
    /**
     * This function is used to create a new user.
     *
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */
    public function handleCreate(
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        Request $request,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);
        $profilePictureRand = rand(1, 1000);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $user->setSignInDate(new \DateTime());
            $user->setRoles(['ROLE_USER']);
            $user->setIsPublic(true);
            $user->setProfilePicture('https://picsum.photos/seed/' . $profilePictureRand . '/200/300');
            $entityManager->persist($user);
            $entityManager->flush();


            $email = new TemplatedEmail();

            $email->from('contact@mypicture.fr')
                ->to($user->getEmail())
                ->subject('Bienvenue sur le site !')
                ->text('Bienvenue, votre compte a bien été créé')
                ->htmlTemplate('emails/register.html.twig')
                ->context([
                    'name' => $user->getUsername()
                ]);
            try {
                $mailer->send($email);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            $this->addFlash('success', 'The user has been modified successfully');
            return $this->redirectToRoute('app_user');
        }

        return $this->redirectToRoute('app_user');
    }

    #[Route('/{id<\d*>}/edit', name: 'app_user_edit')]
    /**
     * This function is used to edit the profile of a user.
     *
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function edit(EntityManagerInterface $entityManager, Request $request, User $user): Response
    {
        $form = $this->createForm(EditUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();



            $this->addFlash('success', 'The user has been modified successfully');
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/edit.html.twig', [
            'title' => "Modifier un utilisateur",

            'editForm' => $form,

        ]);
    }

    #[Route('/{id<\d*>}/delete', name: 'app_user_delete')]
    /**
     * This function is used to delete a user.
     *
     * @param EntityManagerInterface $entityManager
     * @param User $user
     * @return Response
     */
    public function delete(EntityManagerInterface $entityManager, User $user): Response
    {
        // Récupérer l'utilisateur avec l'id 1
        $userToAttachTo = $entityManager->getRepository(User::class)->find(1);

        // Vérifier si l'utilisateur à attacher existe
        if (!$userToAttachTo) {
            throw $this->createNotFoundException('User remplacement not found with the id 1');
        }

        // Récupérer les relations
        $characters = $user->getCharacters();
        $commentaries = $user->getCommentaries();

        // Attacher les relations à l'utilisateur avec l'id 1
        foreach ($characters as $character) {
            $character->setIdUsers($userToAttachTo);
        }

        foreach ($commentaries as $commentary) {
            $commentary->setAuthor($userToAttachTo);
        }

        // Supprimer l'utilisateur
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_user');
    }

    #[Route('/{id<\d*>}/reset-password', name: 'app_user_reset_pwd')]
    /**
     * This function is used to reset the password of a user.
     *
     * @param User $user
     * @param MailerInterface $mailer
     * @param TranslatorInterface $translator
     * @param ResetPasswordHelperInterface $resetPasswordHelper
     * @return Response
     */
    public function resetPassword(User $user,  MailerInterface $mailer, TranslatorInterface $translator, ResetPasswordHelperInterface $resetPasswordHelper): Response
    {
        try {
            $resetToken = $resetPasswordHelper->generateResetToken($user, 60 * 60 * 48);
        } catch (ResetPasswordExceptionInterface $e) {
            $this->addFlash('error', $e->getReason());


            return $this->redirectToRoute('app_user');
        }

        $email = (new TemplatedEmail())
            ->from(new Address('contact@mypicture.fr', 'Contact MyPicture'))
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->htmlTemplate('reset_password/email.html.twig')
            ->context([
                'resetToken' => $resetToken,
            ]);
        try {
            $mailer->send($email);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // $mailer->send($email);

        $this->addFlash('success', 'An email has been sent to ' . $user->getEmail() . ' with a link to reset your password');
        return $this->redirectToRoute('app_user');
    }

    #[Route('/{id<\d*>}/setRoles', name: 'app_user_set_roles')]
    /**
     * This function is used to set the roles of a user.
     *
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @param [type] $id
     * @param Request $request
     * @return Response
     */
    public function setRole(User $user, EntityManagerInterface $entityManager, $id, Request $request): Response
    {
        //activer le csrf_protection: true dans le fichier framework.yaml
        //et symfony console cache:clear
        //coter twig <input type="hidden" name = '_token' value="{{csrf_token('role-' ~ user.id)}}" >
        $tokenTest = $this->isCsrfTokenValid(
            'role-' . $id,
            $request->request->get('_token')
        );

        // dd($tokenTest);
        if (!$tokenTest) {

            $this->addFlash('error', 'The token is invalid. Please refresh the page and try again.');
            return $this->redirectToRoute('app_user');
            // throw new BadRequestException("le jeton csrf est invalide. Veuillez rafraichir la page et réessayer.");
        }

        $roles = [];
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException('L\'utilisateur n\'existe pas');
        }

        if ($request->request->get("$id-roles-user")) {
            $roles[] = 'ROLE_USER';
        }
        if ($request->request->get("$id-roles-admin")) {
            $roles[] = 'ROLE_ADMIN';
        }
        if ($request->request->get("$id-roles-isBanned")) {
            $roles[] = 'ROLE_IS_BANNED';
        }

        $user->setRoles($roles);

        $entityManager->flush();

        $this->addFlash('success', ' Roles of ' . $user->getEmail() . ' have been modified successfully');
        return $this->redirectToRoute('app_user');
    }


    #[Route('/{userId}/report', name: 'app_user_report')]
    /**
     * This function is used to report a user.
     *
     * @param User $userId
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function reportUser(User $userId, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('The User is not found');
        }

        $user->setIsFlaged(true);

        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }

    // list of all reported user
    #[Route('/BlockedUser', name: 'app_user_flaged')]
    public function indexFlaged(UserRepository $userRepository): Response
    {
        $user = $userRepository->findBy(['isFlaged' => true]);
        return $this->render('user/flaged.html.twig', [
            'users' => $user,
        ]);
    }


    #[Route('/{userId}/unflag', name: 'user_undo_report')]
    /**
     * This function is used to unreport a user.
     *
     * @param User $userId
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function unFlageUser(User $userId, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($userId);

        if (!$user) {
            throw $this->createNotFoundException('The User is not found');
        }

        $user->setIsFlaged(false);

        $entityManager->flush();

        return $this->redirectToRoute('app_dashboard');
    }


    #[Route('/{id<\d*>}/block', name: 'app_user_block')]
    /**
     * This function is used to block a user.
     *
     * @param User $user
     * @param EntityManagerInterface $entityManager
     * @param [type] $id
     * @param Request $request
     * @return Response
     */
    public function blockUser(User $user, EntityManagerInterface $entityManager, $id, Request $request): Response
    {
        // Check if the current user has the required ROLE_ADMIN role
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('You are not authorized to perform this action.');
        }

        $roles = $user->getRoles();
        $roles[] = 'ROLE_IS_BANNED';
        $user->setRoles($roles);
        $entityManager->flush();

        $this->addFlash('success', 'User ' . $user->getEmail() . ' has been blocked successfully');
        return $this->redirectToRoute('app_user');
    }
}
