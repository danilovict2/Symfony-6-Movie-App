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

    public function getMovieDetails(int $movieId): array
    {
        $response = $this->client->request('GET', "/3/movie/$movieId", [
            'query' => [
                'append_to_response' => 'credits,videos,images'
            ]
        ]);
        return $response->toArray();
    }

    public function getSearchResults(string $searchQuery): array
    {
        $response = $this->client->request('GET', '/3/search/movie', [
            'query' => [
                'query' => $searchQuery
            ]
        ]);
        return $response->toArray()['results'];
    }

    public function getPopularActors(int $page): array
    {
        $response = $this->client->request('GET', '/3/person/popular', [
            'query' => [
                'page' => $page
            ]
        ]);
        return $response->toArray()['results'];
    }

    public function getActorDetails(int $actorId): array
    {
        $response = $this->client->request('GET', "/3/person/$actorId", [
            'query' => [
                'append_to_response' => 'external_ids,combined_credits'
            ]
        ]);
        return $response->toArray();
    }

    public function getPopularTvShows(): array
    {
        $response = $this->client->request('GET', '/3/tv/popular');
        return $response->toArray()['results'];
    }
    
    public function getTopRatedTvShows(): array
    {
        $response = $this->client->request('GET', '/3/tv/top_rated');
        return $response->toArray()['results'];
    }

    public function getTvShowDetails(int $tvShowId): array
    {
        $response = $this->client->request('GET', "/3/tv/$tvShowId", [
            'query' => [
                'append_to_response' => 'credits,videos,images'
            ]
        ]);
        return $response->toArray();
    }
}
