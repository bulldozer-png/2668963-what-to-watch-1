<?php

namespace App\Interface;

/**
 * Интерфейс для источника даных о фильмах
 *
 * Абстракция репозитория для получения информации о фильмах.
 */
interface MovieRepositoryInterface
{
    /**
     * Поиск фильма по IMDB ID.
     *
     * @param string $imdbId
     * @return array Массив данных о фильме
     */
    public function findByImdbId(string $imdbId): array;
}
