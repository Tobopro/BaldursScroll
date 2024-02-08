<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard')]
    public function index(): Response
    {

         $characters = [
            [
                'id' => 1, 
                'name' => 'Gandalf',
                'level' => 20,
                'picture' => 'https://i.pinimg.com/736x/07/b6/e9/07b6e90eb1eb1eb4bc0da29a58cb0759.jpg',
                'spells' => ['Fireball', 'Lightning Bolt', 'Teleport'],
            ],
            [
                'id' => 2,
                'name' => 'Aragorn',
                'level' => 18,
                'picture' => 'https://i.pinimg.com/564x/ab/52/9a/ab529acdb6f2ebb5a3bcac754d79ec23.jpg',
                'spells' => ['Sword Strike', 'Healing Touch', 'Battle Cry'],
            ],
            [
                'id' => 3,
                'name' => 'Gimli',
                'level' => 19,
                'picture' => 'https://i.pinimg.com/564x/67/17/4f/67174f369ba0059b1c81fea39e3df1ef.jpg',
                'spells' => ['Axe Strike', 'Earthquake', 'Sprint'],
            ],
            [
                'id' => 4,
                'name' => 'Legolas',
                'level' => 21,
                'picture' => 'https://i.pinimg.com/564x/77/c1/eb/77c1eb3de7efd13cdbecfaae7f0542cd.jpg',
                'spells' => ['Arrow Shot', 'Eagle Eye', 'Silent Step'],
            ],
            [
                'id' => 5,
                'name' => 'Frodo',
                'level' => 16,
                'picture' => 'https://i.pinimg.com/564x/67/a5/35/67a535517ae7d28cb5e61697a8ebfa11.jpg',
                'spells' => ['Invisibility', 'Hobbit Feet', 'Ring of Power'],
            ],
            [
                'id' => 6,
                'name' => 'Boromir',
                'level' => 17,
                'picture' => 'https://i.pinimg.com/564x/a1/b2/bd/a1b2bda799030a5a1c849de90ad13c0c.jpg',
                'spells' => ['Sword Mastery', 'Shield Defense', 'Horn of Gondor'],
            ],
            
        ];

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
              'characters' => $characters
        ]);
    }
}
