<?php

namespace App\Tests;

use App\Entity\Characters;
use Faker\Factory;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends WebTestCase
{

    private function assertLogin($client, $email, $password): void
    {
        $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();

        $client->submitForm('Se Connecter', [
            'email' => $email,
            'password' => $password
        ]);

        // here add a redirection after login
        $this->assertResponseRedirects();
    }

    public function testLogin(): void
    {
        $client = static::createClient();
        $this->assertLogin($client, 'test@test.fr', 'password');
    }

    public function testRegister(): void
    {

        // use faker data
        $faker = Factory::create();

        // create a client
        $client = static::createClient();
        $client->request('GET', '/register');

        $email = $faker->email();
        $password = $faker->password();

        $this->assertResponseIsSuccessful();

        $client->submitForm('Submit', [
            'user[username]' => $faker->userName(),
            'user[email]' => $email,
            'user[password][first]' => $password,
            'user[password][second]' => $password
        ]);

        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail($email);

        $this->assertNotNull($user);
        $this->assertResponseRedirects('/login');

        // perform login after registration
        $this->assertLogin($client, $email, $password);
    }

    public function testReportUser(): void
    {
        $userId = 8;
        $client = static::createClient();
        $client->request('GET', '/user/' . $userId . '/report');

        if ($client->getResponse()->isRedirect()) {
            $client->followRedirect();
        }

        $this->assertResponseIsSuccessful();
    }

    public function testShowAdminPage(): void
    {
        $client = static::createClient();

        $client->request('GET', '/user/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Admin page');
    }
}
