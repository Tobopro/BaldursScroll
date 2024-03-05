<?php

namespace App\Controller;

use App\Repository\SpellsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SpellsController extends AbstractController
{
    #[Route('/spells/{name}', name: 'app_spells')]
    public function index(string $name, Request $request, SpellsRepository $spellsRepository): Response
    {
        $transformedName = strtolower(str_replace(" ", "-", $name));
        $command = escapeshellcmd("python C:\Users\sacri\Documents\Git_folder\spellbook-cli\get_spell.py " . $transformedName);
        $output = shell_exec($command);
        $output = json_decode($output);
        $fallback = false;

        $origin = $request->headers->get("referer");

        if (!$output) {
            $fallback = true;
            $output = $spellsRepository->findOneBy(["name" => $name]);
            if (!$output) {
                return $this->redirectToRoute('app_dashboard');
            }
        }

        return $this->render('spells/index.html.twig', [
            'controller_name' => 'SpellsController',
            "spell" => $name,
            "fallback" => $fallback,
            "output" => $output,
            "origin" => $origin,
        ]);
    }
}
