<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ExceptionController extends AbstractController
{
    public function showAccessDenied(HttpExceptionInterface $exception): Response
    {
        $statusCode = $exception->getStatusCode();

        if ($statusCode === 404) {
            $template = 'error/404.html.twig';
        } elseif ($statusCode === 403) {
            $template = 'error/403.html.twig';
        }

        return $this->render($template, [
            'status_code' => $statusCode,
            'status_text' => Response::$statusTexts[$statusCode] ?? 'Unknown Error',
        ]);
    }
}
