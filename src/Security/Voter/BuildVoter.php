<?php

namespace App\Security\Voter;

use App\Entity\Characters;
use App\Repository\CharactersRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


class BuildVoter extends Voter
{
    public const EDIT = 'edit';
    public const VIEW = 'view';
    public CharactersRepository $charactersRepository;

    // Injectez CharactersRepository dans le constructeur
    public function __construct(CharactersRepository $charactersRepository)
    {
        $this->charactersRepository = $charactersRepository;
    }

    public function findCharachter($id){
        $character = $this->charactersRepository->find($id);
        return $character;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW]);
            // && $subject instanceof Characters;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        // return false;
        $user = $token->getUser();
        if($user){ $userId = $user->getId();}
   
        $idCharacter = $subject;
        $authorId = $this->findCharachter($idCharacter)->getIdUsers()->getId();
        $character = $this->findCharachter($idCharacter);
        // dd($authorId);
        

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
            
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
               if( $userId == $authorId || in_array('ROLE_ADMIN', $user->getRoles()) ){
                   return true; }
                   
                break;

            case self::VIEW:
               
                   if( $character->isIsPublic() || $userId == $authorId || in_array('ROLE_ADMIN', $user->getRoles()) ){
                       return true; }
                 
                break;
        }

        return false;
    }
}
