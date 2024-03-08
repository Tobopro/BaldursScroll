<?php

namespace App\Tests;
use Faker\Factory;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentTest extends WebTestCase
{
    public function testRegister(): void{

        $faker = Factory::create();
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $fakeMail= $faker->email();

        $form = $crawler->selectButton('user[save]')->form([
            'user[username]' => $faker->userName(),
            'user[email]' => $fakeMail,
            'user[password][first]'=> '123123123',
            'user[password][second]' => '123123123',
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/login');
    }

    public function testComment(): void{
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $client->submitForm('Sign in', [
            'email' => 'peichmann@weber.com',
            'password' => '123123123',
        ]);
        $this->assertResponseRedirects('/');
        $client->followRedirect();
        $client->request('GET', '/build/3');
        $this->assertResponseIsSuccessful();
        $client->submitForm('Publish your comment', [
            'commentary[text]' => 'This is a test comment',
        ]);
        $this->assertResponseRedirects('/build/3');
        $client->followRedirect();
        $this->assertSelectorTextContains('html', 'This is a test comment');
        $client->click($client->getCrawler()->filter('a:contains:empty')->link());
    }
            

    // public function testLogin(): void{
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/login');
    //     $form = $crawler->selectButton('Sign in')->form([
    //         'email' => 'admin@symfony.com',
    //         'password' => '123123123',
    //     ]);
    //     $client->submit($form);
    //     $client->followRedirects(true);
    //     $this->assertResponseIsSuccessful();
       
    // }

    // public function testSomething(): void
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/login');
        

    //     $this->assertResponseIsSuccessful();

    // }
}
