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
        $nowPlayingMovies = $movieDB->getNowPlaying();
        
        // array_column is used to convert $movieDB->getAllGenres() to form id => name for later convenience
        $genres = array_column($movieDB->getAllGenres(), 'name', 'id');

        return $this->render('movie/index.html.twig', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
            'genres' => $genres
        ]);
    }

    #[Route('/movie/{id}', name: 'movie_show')]
    public function show(): Response
    {
        return $this->render('movie/show.html.twig');
    }
}
