<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ExceptionController extends AbstractController
{
    public function showAccessDenied(AccessDeniedHttpException $exception): Response
    {
        return $this->render(
            'access_denied.html.twig',
            [],
            new Response('', Response::HTTP_FORBIDDEN)
        );
    }
}
