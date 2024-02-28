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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $users = $userRepository->createQueryBuilder('u');

        $sortBy = $request->query->get('sort');
        $sortDir = $request->query->get('direction');

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
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/handlecreate', name: 'app_user_handleCreate')]
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

            $this->addFlash('success', 'L\'utilisateur a bien été créé');
            return $this->redirectToRoute('app_user');
        }

        return $this->redirectToRoute('app_user');
    }

    #[Route('/{id<\d*>}/edit', name: 'app_user_edit')]
    public function edit(EntityManagerInterface $entityManager, Request $request, User $user): Response
    {
        $form = $this->createForm(EditUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();



            $this->addFlash('success', 'L\'utilisateur a bien été modifié');
            return $this->redirectToRoute('app_user');
        }

        return $this->render('user/edit.html.twig', [
            'title' => "Modifier un utilisateur",

            'editForm' => $form,

        ]);
    }

    #[Route('/{id<\d*>}/delete', name: 'app_user_delete')]
    public function delete(EntityManagerInterface $entityManager, User $user): Response
    {
        // Récupérer l'utilisateur avec l'id 1
        $userToAttachTo = $entityManager->getRepository(User::class)->find(1);

        // Vérifier si l'utilisateur à attacher existe
        if (!$userToAttachTo) {
            throw $this->createNotFoundException('Utilisateur de remplacement non trouvé avec l\'id 1');
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
        $mailer->send($email);

        $this->addFlash('success', 'un mail de réinitialisation de mot de passe a été envoyé à l\'utilisateur');
        return $this->redirectToRoute('app_user');
    }

    #[Route('/{id<\d*>}/setRoles', name: 'app_user_set_roles')]
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

            $this->addFlash('error', 'le jeton csrf est invalide. Veuillez rafraichir la page et réessayer.');
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

        $this->addFlash('success', 'les role de ' . $user->getEmail() . ' ont bien été modifiés');
        return $this->redirectToRoute('app_user');
    }
}
