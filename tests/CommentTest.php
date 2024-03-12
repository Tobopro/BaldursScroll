<?php

namespace App\Tests;
use Faker\Factory;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentTest extends WebTestCase
{
    // public function testRegister(): void{

    //     $faker = Factory::create();
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/register');
    //     $this->assertResponseIsSuccessful();
    //     $fakeMail= $faker->email();
        

    //     $form = $crawler->selectButton('user[save]')->form([
    //         'user[username]' => $faker->userName(),
    //         'user[email]' => $fakeMail,
    //         'user[password][first]'=> '123123123',
    //         'user[password][second]' => '123123123',
    //     ]);
    //     $client->submit($form);
    //     $this->assertResponseRedirects('/login');
    // }

    //  public function testComment(): void{
    //      $client = static::createClient();
    //      $crawler = $client->request('GET', '/login');
    //      $client->submitForm('Sign in', [
    //          'email' => 'friedrich.mills@hotmail.com',
    //          'password' => '123123123',
    //      ]);
    //      $this->assertResponseRedirects();
    //      $client->followRedirect();
    //      $client->request('GET', '/build/3');
    //      $this->assertResponseIsSuccessful();
    //      $client->submitForm('Publish your comment', [
    //          'commentary[text]' => 'This is a test comment',
    //      ]);
    //      $this->assertResponseRedirects('/build/3');
    //      $client->followRedirect();
    //      $this->assertSelectorTextContains('html', 'This is a test comment');


    //  }

    //  public function testLikeBuild(): void{
    //         $client = static::createClient();
    //      $crawler = $client->request('GET', '/login');
    //      $client->submitForm('Sign in', [
    //          'email' => 'friedrich.mills@hotmail.com',
    //          'password' => '123123123',
    //      ]);
    //      $this->assertResponseRedirects();
    //      $client->followRedirect();
    //      $client->request('GET', '/build/3');
    //      $this->assertResponseIsSuccessful();
    //     // $this->assertSelectorTextContains('html', 'No likes yet');
    //     $client->request('GET', '/build/3/liked');
    //     $this->assertResponseRedirects('/build/3');
    //     $client->followRedirect();
    //     $this->assertSelectorTextContains('html', '1 like');

    //  }

    public function testDeleteComment(): void{
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $client->submitForm('Sign in', [
            'email' => 'friedrich.mills@hotmail.com',
            'password' => '123123123',
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $client->request('GET', '/build/3');
        $this->assertResponseIsSuccessful();
        $client->submitForm('Publish your comment', [
              'commentary[text]' => 'This is a test comment',
          ]);
        $this->assertResponseRedirects('/build/3');
        $client->followRedirect();
        $client->request('GET', '/build/3/commentary/18/delete');
        $client->followRedirect();
        $this->assertSelectorTextContains('html', 'No comments yet.');

        

    }
}
