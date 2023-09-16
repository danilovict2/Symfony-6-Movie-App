<?php

namespace App\Controller;

use App\MovieDB;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(private MovieDB $movieDB)
    {
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $popularMovies = $this->movieDB->getPopularMovies();
        $nowPlayingMovies = $this->movieDB->getNowPlaying();

        return $this->render('movie/index.html.twig', [
            'popularMovies' => $popularMovies,
            'nowPlayingMovies' => $nowPlayingMovies,
        ]);
    }

    #[Route('/movie/{id<\d+>}', name: 'movie_show')]
    public function show(int $id): Response
    {
        $movie = $this->movieDB->getMovieDetails($id);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
