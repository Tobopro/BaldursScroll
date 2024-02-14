<?php

namespace App\DataFixtures;

use App\Entity\Characters;
use App\Entity\SubRaces;
use App\Entity\SubClasses;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CharactersFixture extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // Récupérez toutes les entités associées
        $subRaces = $manager->getRepository(SubRaces::class)->findAll();
        $subClasses = $manager->getRepository(SubClasses::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();

        $bonus1 = ['Strength', 'Dexterity', 'Constitution', 'Intelligence', 'Wisdom', 'Charisma'];
        $bonus2 = ['Strength', 'Dexterity', 'Constitution', 'Intelligence', 'Wisdom', 'Charisma'];

        $character = new Characters();
        $character->setName($this->faker->lastName());
        $character->setStrength(rand(8, 15));
        $character->setDexterity(rand(8, 15));
        $character->setConstitution(rand(8, 15));
        $character->setIntelligence(rand(8, 15));
        $character->setWisdom(rand(8, 15));
        $character->setCharisma(rand(8, 15));
        $character->setAbilityScoreBonus1($bonus1[rand(0, 5)]);
        $character->setAbilityScoreBonus2($bonus2[rand(0, 5)]);

        $randomSubRace = $this->faker->rand($subRaces);
        $randomSubClasses = $this->faker->randomElement($subClasses);
        $randomUser = $this->faker->randomElement($users);

        $character->setIdSubRace($randomSubRace);
        $character->setIdSubClasses($randomSubClasses);
        $character->setIdUsers($randomUser);

        $manager->persist($character);
        $manager->flush();
    }
}
