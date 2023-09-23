<?php

namespace App\Twig\Components;

use App\TMDB\TMDB;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent()]
final class Card
{
    public array $media;
    public string $url;
    private array $genres = [];

    public function __construct(TMDB $TMDB)
    {
        $this->genres = array_column($TMDB->getAllGenres(), 'name', 'id');
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->media['image'] = $this->media['poster_path'] ? 
            'https://image.tmdb.org/t/p/w500/' . $this->media['poster_path'] : 
            'https://via.placeholder.com/275x412'
        ;

        $this->media['title'] ??= $this->media['name'];
        $this->media['release_date'] ??= $this->media['first_air_date'];
        $this->media['genres'] = implode(', ', array_filter(
            array_map(fn($genreId) => $this->genres[$genreId] ?? null, $this->media['genre_ids']),
            fn($genre) => !is_null($genre)
        ));
    }
}
