<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class ProfileVoter extends Voter
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public const EDIT = 'edit_profile';
    public const VIEW = 'view_profile';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW]);
            // && $subject instanceof \App\Entity\User; 
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {

        $userProfile = $this->userRepository->find($subject);

        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:

                if (intval($subject)=== $user->getId() || $user->getRoles()[0]==='ROLE_ADMIN') {
                    return true;
                }
                break;

            case self::VIEW:
                if (intval($subject)=== $user->getId()|| $userProfile->isIsPublic()===true || $user->getRoles()[0]==='ROLE_ADMIN') {
                    return true;
                }
                break;
        }

        return false;
    }
}
