<?php

namespace App\Repositories;
use App\Interface\MovieRepositoryInterface;
use GuzzleHttp\Psr7\Request;

/**
 * OMDB API
 */
class OmdbMovieRepository implements MovieRepositoryInterface
{
    /**
     * @param \Psr\Http\Client\ClientInterface $httpClient PSR-совместимый HTTP-клиент
     */
    public function __construct(private \Psr\Http\Client\ClientInterface $httpClient)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function findByImdbId(string $imdbId): array
    {
        $url = "http://www.omdbapi.com/?i={$imdbId}&apikey=" . config('services.omdb.api_key', 'your_api_key');
        $request = new Request('GET', $url);
        $response = $this->httpClient->sendRequest($request);

        $body = $response->getBody()->getContents();

        return json_decode($body, true);
    }
}