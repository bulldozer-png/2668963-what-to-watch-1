<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Repositories\OmdbMovieRepository;
use App\Models\Film;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateFilmJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    private string $imdbId;

    public function __construct(string $imdbId)
    {
        $this->imdbId = $imdbId;
    }

    public function handle()
    {
        $repository = app(\App\Interface\MovieRepositoryInterface::class);
        try {
            try {
                $data = $repository->findByImdbId($this->imdbId);
            } catch (\Throwable $e) {
                throw $e;
            }

            $film = Film::updateOrCreate(
                ['imdb_id' => $this->imdbId],
                [
                    'title' => $data['Title'] ?? 'No title',
                    'description' => $data['Plot'] ?? 'No description',
                    'big_image' => is_string($data['Poster'] ?? null) ? $data['Poster'] : 'no_image.jpg',
                    'small_image' => is_string($data['Poster'] ?? null) ? $data['Poster'] : 'no_image.jpg',
                    'bg_image' => is_string($data['Poster'] ?? null) ? $data['Poster'] : 'no_image.jpg',
                    'bg_color' => '#000000',
                    'genre_id' => 1,
                    'release_year' => intval($data['Year'] ?? 0) ?: 1900,
                    'director' => $data['Director'] ?? 'Unknown',
                    'cast_list' => $data['Actors'] ?? 'Unknown',
                    'duration_minutes' => intval(preg_replace('/[^0-9]/', '', $data['Runtime'] ?? '0')) ?: 0,
                    'video_link' => 'no_link',
                    'trailer_link' => 'no_link',
                    'rating' => intval(round(floatval($data['imdbRating'] ?? 0))) ?: 0,
                ]
            );

        } catch (\Throwable $e) {
            throw $e;
        }
    }
}