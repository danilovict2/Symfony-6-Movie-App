<?php

namespace App\TMDB;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TMDB
{
    private HttpClientInterface $client;

    /**
     * @var string $prefix The prefix used to specify a resource or category in API requests.
     */
    protected string $prefix = '';

    public function __construct(#[Autowire('%env(MOVIEDB_KEY)%')] string $key, HttpClientInterface $client)
    {
        $this->client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Bearer ' . $key
            ],
            'base_uri' => 'https://api.themoviedb.org'
        ]);
    }

    final public function getPopular(int $page = 1): array
    {
        $response = $this->client->request('GET', '/3/' . $this->prefix . '/popular', [
            'query' => [
                'page' => $page
            ]
        ]);
        return $response->toArray()['results'];
    }

    final public function getDetails(int $id): array
    {
        $response = $this->client->request('GET', '/3/' . $this->prefix . '/' . $id, [
            'query' => [
                'append_to_response' => 'credits,videos,images,external_ids,combined_credits'
            ]
        ]);
        return $response->toArray();
    }

    final public function getTopRated(): array
    {
        $response = $this->client->request('GET', '/3/'. $this->prefix . '/top_rated');
        return $response->toArray()['results'];
    }

    final public function getAllGenres(): array
    {
        $response = $this->client->request('GET', '/3/genre/movie/list');
        return $response->toArray()['genres'];
    }

    final public function getSearchResults(string $searchQuery): array
    {
        $response = $this->client->request('GET', '/3/search/movie', [
            'query' => [
                'query' => $searchQuery
            ]
        ]);
        return $response->toArray()['results'];
    }
}
