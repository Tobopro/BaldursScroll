<?php

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuilderTest extends WebTestCase
{
    public function testAccess(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Dashboard');

        $crawler = $client->request("GET", "/builder");
        $this->assertResponseRedirects("/login");

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail("adventurer1@example.com");
        $client->loginUser($testUser);

        $url = ["/builder"];

        foreach($url as $u) {
            $crawler = $client->request("GET", $u);
            $this->assertResponseIsSuccessful();
        }
    }
}
