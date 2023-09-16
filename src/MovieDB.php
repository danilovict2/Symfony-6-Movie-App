<?php 

namespace App;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MovieDB
{
    private HttpClientInterface $client;

    public function __construct(#[Autowire('%env(MOVIEDB_KEY)%')] string $key, HttpClientInterface $client)
    {
        $this->client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Bearer ' . $key
            ],
            'base_uri' => 'https://api.themoviedb.org'
        ]);
    }

    public function getPopularMovies(): array
    {
        $response = $this->client->request('GET', '/3/movie/popular');
        return $response->toArray()['results'];
    }

    public function getAllGenres(): array
    {
        $response = $this->client->request('GET', '/3/genre/movie/list');
        return $response->toArray()['genres'];
    }

    public function getNowPlaying(): array
    {
        $response = $this->client->request('GET', '/3/movie/now_playing');
        return $response->toArray()['results'];
    }
}