<?php

namespace App\Controller;

use App\MovieDB;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    public function __construct(private MovieDB $movieDB)
    {
    }

    #[Route('/actors/page/{page<\d+>}', name: 'actors')]
    public function index(int $page = 1): Response
    {
        $popularActors = $this->movieDB->getPopularActors($page);
        return $this->render('actor/index.html.twig', [
            'popularActors' => $popularActors
        ]);
    }

    #[Route('/actor/{id<\d+>}', name: 'actor_show')]
    public function show(int $id): Response
    {
        $actor = $this->movieDB->getActorDetails($id);
        $actor['facebook_id'] = $actor['external_ids']['facebook_id'] ?? null;
        $actor['instagram_id'] = $actor['external_ids']['instagram_id'] ?? null;
        $actor['twitter_id'] = $actor['external_ids']['twitter_id'] ?? null;
        $actor['known_for'] = $actor['combined_credits']['cast'];

        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
    }
}
