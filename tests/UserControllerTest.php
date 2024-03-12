<?php

// tests/Controller/UserControllerTest.php
// pour lancer les tests : ./vendor/bin/phpunit

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/user/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'User List');
    }

    public function testShow()
    {
        $client = static::createClient();
        $client->request('GET', '/user/1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'User Details');
    }

    public function testCreate()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/user/');
        $link = $crawler->filter('a:contains("Create User")')->link();
        $client->click($link);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create User');
    }

    public function testEdit()
    {
        $client = static::createClient();
        $client->request('GET', '/user/1/edit');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Edit User');
    }

    public function testDelete()
    {
        $client = static::createClient();
        $client->request('GET', '/user/1/delete');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Delete User');
    }

    public function testHandleCreate()
    {
        $client = static::createClient();
        $client->request('POST', '/user/handleCreate');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create User');
    }

    public function testHandleEdit()
    {
        $client = static::createClient();
        $client->request('POST', '/user/1/handleEdit');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Edit User');
    }

    public function testHandleDelete()
    {
        $client = static::createClient();
        $client->request('POST', '/user/1/handleDelete');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Delete User');
    }



   
}

