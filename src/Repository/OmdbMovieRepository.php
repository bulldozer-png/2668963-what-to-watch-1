<?php

namespace App\Repository;
use App\Interface\MovieRepositoryInterface;

/**
 * OMDB API
 */
class OmdbMovieRepository implements MovieRepositoryInterface
{
    /**
     * @param ClientInterface $httpClient PSR-совместимый HTTP-клиент
     */
    public function __construct(private \Psr\Http\Client\ClientInterface $httpClient)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function findByImdbId(string $imdbId): array
    {
        $response = $this->httpClient->sendRequest($imdbId);

        return json_decode($response->getBody()->getContents(), true);
    }
}
