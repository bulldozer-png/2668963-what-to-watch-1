<?php

namespace App\Service;
use App\Interface\MovieRepositoryInterface;

/**
 * Сервис для работы с фильмами
 */
class MovieService
{
    /**
     * Информация о фильме
     */
    private MovieRepositoryInterface $repository;

    /**
     * @param MovieRepositoryInterface $repository
     */
    public function __construct(MovieRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Получение фильма по IMDB ID.
     *
     * @param string $imdbId
     * @return array Массив данных о фильме
     */
    public function getMovieByImdbId(string $imdbId): array
    {
        return $this->repository->findByImdbId($imdbId);
    }
}
