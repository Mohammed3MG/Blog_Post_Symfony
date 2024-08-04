<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/blog')]
class BlogController extends AbstractController
{

    #[Route('/')]
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', ['foo'=>'bar']);
    }
}
