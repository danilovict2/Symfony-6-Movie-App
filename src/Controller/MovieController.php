<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig');
    }

    #[Route('/movie', name: 'movie_show')]
    public function show(): Response
    {
        return $this->render('movie/show.html.twig');
    }
}
