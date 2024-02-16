<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use Faker\Generator;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    private Generator $faker;
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setUsername('John');
        $user->setIsBanned(0);
        $user->setIsAdmin(1);
        $user->setRoles([]);
        $user->setSignInDate($this->faker->dateTime());
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

        $manager->persist($user);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['users'];
    }
}
