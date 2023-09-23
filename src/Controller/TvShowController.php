<?php

namespace App\Controller;

use App\TMDB\TvShowTMDB;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TvShowController extends AbstractController
{
    public function __construct(private TvShowTMDB $tvShowTMDB)
    {
    }

    #[Route('/tv-shows', name: 'tv_shows')]
    public function index(): Response
    {
        $popularTvShows = $this->tvShowTMDB->getPopular();
        $topRatedTvShows = $this->tvShowTMDB->getTopRated();

        return $this->render('tv_show/index.html.twig', [
            'popularTvShows' => $popularTvShows,
            'topRatedTvShows' => $topRatedTvShows
        ]);
    }

    #[Route('/tv-show/{id<\d+>}', name: 'tv_show')]
    public function show(int $id): Response
    {
        $tvShow = $this->tvShowTMDB->getDetails($id);
    
        return $this->render('tv_show/show.html.twig', [
            'tvShow' => $tvShow
        ]);
    }
}
