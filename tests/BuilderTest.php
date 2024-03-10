<?php

namespace App\Tests;

use App\Entity\Characters;
use App\Repository\CharactersRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuilderTest extends WebTestCase
{
    public function testAccess(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful("Cannot access the home page.");
        $this->assertSelectorTextContains('h1', 'Dashboard');

        $crawler = $client->request("GET", "/builder");
        $this->assertResponseRedirects("/login", null, "Can access builder as non connected user.");

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail("adventurer1@example.com");
        $client->loginUser($testUser);

        $crawler = $client->request("GET", "/builder");
        $this->assertResponseIsSuccessful("Got denied access to builder.");
    }

    public function testCreateCharacter(): Characters
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail("adventurer1@example.com");
        $client->loginUser($testUser);

        $crawler = $client->request("GET", "/builder");
        $this->assertResponseIsSuccessful("Got denied access to builder.");

        $rand = random_int(1, 999999999);

        $client->submitForm("builder_save", [
            "builder[idClasses]" => 1,
            "builder[idSubClasses]" => 2,
            "builder[idRaces]" => 9,
            "builder[idSubRace]" => 20,
            "builder[strength]" => 15,
            "builder[dexterity]" => 12,
            "builder[constitution]" => 15,
            "builder[intelligence]" => 8,
            "builder[wisdom]" => 9,
            "builder[charisma]" => 12,
            "builder[abilityScoreBonus1]" => "STR",
            "builder[abilityScoreBonus2]" => "CON",
            "builder[name]" => "ZugZug".$rand,
        ]);
        
        $characterRepository = static::getContainer()->get(CharactersRepository::class);
        $character = $characterRepository->findOneByName("ZugZug".$rand);
        $this->assertNotNull($character, "No character found.");

        $this->assertSame("ZugZug".$rand, $character->getName(), "Not the expected name.");
        // Subclass/Subrace
        $this->assertSame(2, $character->getIdSubClasses()->getId(), "Not the expected subclass.");
        $this->assertSame(20, $character->getIdSubRace()->getId(), "Not the expected subrace.");
        // Stats
        $this->assertSame(15, $character->getStrength(), "Not the expected strength.");
        $this->assertSame(12, $character->getDexterity(), "Not the expected dexterity.");
        $this->assertSame(15, $character->getConstitution(), "Not the expected constitution.");
        $this->assertSame(8, $character->getIntelligence(), "Not the expected intelligence.");
        $this->assertSame(9, $character->getWisdom(), "Not the expected charisma.");
        $this->assertSame(12, $character->getCharisma(), "Not the expected subclass.");
        // Ability Score Bonuses
        $this->assertSame("STR", $character->getAbilityScoreBonus1(), "Not the expected ability score bouns 1.");
        $this->assertSame("CON", $character->getAbilityScoreBonus2(), "Not the expected ability score bonus 2.");
        // Level
        $this->assertSame(1, $character->getIdLevel()->getId(), "Not the expected ability score bonus 2.");
        
        $this->assertResponseRedirects("/", null, "Not redirected to home page.");

        return $character;
    }

    /**
     * @depends testCreateCharacter
     */
    public function testModifyCharacter($character) : Characters
    {
        $client = static::createClient();
        
        $crawler = $client->request("GET", "/builder/update/".$character->getId());
        $this->assertResponseRedirects("/login", null, "Can access build update as non connected user.");

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail("adventurer1@example.com");
        $client->loginUser($testUser);
        
        $crawler = $client->request("GET", "/builder/update/".$character->getId());
        $this->assertResponseIsSuccessful("Got denied access to build update.");

        $client->submitForm("builder_save", [
            "builder[idClasses]" => 12,
            "builder[idSubClasses]" => 45,
            "builder[idRaces]" => 5,
            "builder[idSubRace]" => 9,
            "builder[strength]" => 10,
            "builder[dexterity]" => 8,
            "builder[constitution]" => 10,
            "builder[intelligence]" => 15,
            "builder[wisdom]" => 15,
            "builder[charisma]" => 13,
            "builder[abilityScoreBonus1]" => "INT",
            "builder[abilityScoreBonus2]" => "WIS",
            "builder[idLevel]" => 3,
            "builder[name]" => "New".$character->getName(),
        ]);

        $oldName = $character->getName();
        
        $characterRepository = static::getContainer()->get(CharactersRepository::class);
        $character = $characterRepository->findOneByName("New".$character->getName());
        $this->assertNotNull($character, "No character found.");

        $this->assertSame("New".$oldName, $character->getName(), "Not the expected name.");
        // Subclass/Subrace
        $this->assertSame(45, $character->getIdSubClasses()->getId(), "Not the expected subclass.");
        $this->assertSame(9, $character->getIdSubRace()->getId(), "Not the expected subrace.");
        // Stats
        $this->assertSame(10, $character->getStrength(), "Not the expected strength.");
        $this->assertSame(8, $character->getDexterity(), "Not the expected dexterity.");
        $this->assertSame(10, $character->getConstitution(), "Not the expected constitution.");
        $this->assertSame(15, $character->getIntelligence(), "Not the expected intelligence.");
        $this->assertSame(15, $character->getWisdom(), "Not the expected charisma.");
        $this->assertSame(13, $character->getCharisma(), "Not the expected subclass.");
        // Ability Score Bonuses
        $this->assertSame("INT", $character->getAbilityScoreBonus1(), "Not the expected ability score bouns 1.");
        $this->assertSame("WIS", $character->getAbilityScoreBonus2(), "Not the expected ability score bonus 2.");
        $this->assertSame(3, $character->getIdLevel()->getId(), "Not the expected ability score bonus 2.");
        
        $this->assertResponseRedirects("/", null, "Not redirected to home page.");

        return $character;
    }

    /**
     * @depends testModifyCharacter
     */
    public function testDeleteCharacter($character) : void
    {
        $client = static::createClient();
        $characterRepository = static::getContainer()->get(CharactersRepository::class);

        $crawler = $client->request("GET", "/builder/delete/".$character->getId());
        $newCharacter = $characterRepository->findOneByName($character->getName());
        $this->assertNotNull($newCharacter, "Can delete build as non connected user.");


        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail("adventurer1@example.com");
        $client->loginUser($testUser);
        
        $crawler = $client->request("GET", "/builder/delete/".$character->getId());
        $newCharacter = $characterRepository->findOneByName($character->getName());
        $this->assertNull($newCharacter, "Cannot delete his own build.");
        
        $this->assertResponseRedirects("/", null, "Not redirected to home page.");
    }
}
