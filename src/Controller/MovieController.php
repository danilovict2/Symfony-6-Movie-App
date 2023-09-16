<?php

namespace App\Controller;

use App\MovieDB;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(MovieDB $movieDB): Response
    {
        $popularMovies = $movieDB->getPopularMovies();

        return $this->render('movie/index.html.twig', [
            'popularMovies' => $popularMovies
        ]);
    }

    #[Route('/movie/{id}', name: 'movie_show')]
    public function show(): Response
    {
        return $this->render('movie/show.html.twig');
    }
}
