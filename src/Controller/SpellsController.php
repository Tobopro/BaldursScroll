<?php

namespace App\Controller;

use App\Entity\Spells;
use App\Repository\SpellsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SpellsController extends AbstractController
{
    #[Route('/spells/{id}', name: 'app_spells')]
    /**
     * This function is used to display the details of a spell.
     * Get the spell information through a python script connecting to DnD5e API
     * falls back to the database informations if the API fails
     *
     * @param Spells $spell
     * @param Request $request
     * @param SpellsRepository $spellsRepository
     * @return Response
     */
    public function index(Spells $spell, Request $request): Response
    {
        $transformedName = strtolower(str_replace(" ", "-", $spell->getName()));
        $path = str_replace("src\Controller", "others\get_spell.py" ,__DIR__);
        $command = escapeshellcmd("python ".$path." ".$transformedName);
        $output = shell_exec($command);
        $output = json_decode($output);
        $fallback = false;

        $origin = $request->headers->get("referer");

        if (!$output) {
            $fallback = true;
            $output = $spell;
            if (!$output) {
                return $this->redirectToRoute('app_dashboard');
            }
        }

        return $this->render('spells/index.html.twig', [
            'controller_name' => 'SpellsController',
            "spell" => $spell->getName(),
            "fallback" => $fallback,
            "output" => $output,
            "origin" => $origin,
        ]);
    }
}
