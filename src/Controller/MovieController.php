<?php

namespace App\Controller;

use App\TMDB\MovieTMDB;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(private MovieTMDB $movieTMDB)
    {
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $popularMovies = $this->movieTMDB->getPopular();
        $topRatedMovies = $this->movieTMDB->getTopRated();

        return $this->render('movie/index.html.twig', [
            'popularMovies' => $popularMovies,
            'topRatedMovies' => $topRatedMovies,
        ]);
    }

    #[Route('/movie/{id<\d+>}', name: 'movie_show')]
    public function show(int $id): Response
    {
        $movie = $this->movieTMDB->getDetails($id);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
