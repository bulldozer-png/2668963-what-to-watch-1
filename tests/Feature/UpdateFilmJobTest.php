<?php

namespace Tests\Feature;

use App\Jobs\UpdateFilmJob;
use App\Models\Film;
use App\Models\Genre;
use App\Interface\MovieRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateFilmJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_film_job_creates_film_in_database()
    {
        $genre = Genre::factory()->create(['id' => 1]);
        
        $mockMovieData = [
            'Title' => 'Test Film',
            'Plot' => 'Test Description',
            'Poster' => 'https://example.com/poster.jpg',
            'Year' => '2025',
            'Director' => 'Test Director',
            'Actors' => 'Actor 1, Actor 2',
            'Runtime' => '120 min',
            'imdbRating' => '8.4',
        ];
        
        $imdbId = 'tt12042730';
        
        $this->mock(MovieRepositoryInterface::class, function (MockInterface $mock) use ($mockMovieData, $imdbId) {
            $mock->shouldReceive('findByImdbId')
                ->with($imdbId)
                ->once()
                ->andReturn($mockMovieData);
        });
        
        $job = new UpdateFilmJob($imdbId);
        $job->handle();
        
        $this->assertDatabaseHas('films', [
            'imdb_id' => $imdbId,
            'title' => 'Test Film',
            'description' => 'Test Description',
            'release_year' => '2025',
            'director' => 'Test Director',
            'rating' => 8,
        ]);
        
        $film = Film::where('imdb_id', $imdbId)->first();
        $this->assertNotNull($film);
        $this->assertEquals('https://example.com/poster.jpg', $film->big_image);
    }

    public function test_update_film_job_updates_existing_film()
    {
        $genre = Genre::factory()->create(['id' => 1]);
        
        $imdbId = 'tt12042730';
        
        $film = Film::factory()->create([
            'imdb_id' => $imdbId,
            'title' => 'Old Title',
            'genre_id' => 1,
        ]);
        
        $mockMovieData = [
            'Title' => 'Updated Title',
            'Plot' => 'Updated Description',
            'Poster' => 'https://example.com/new-poster.jpg',
            'Year' => '2024',
            'Director' => 'New Director',
            'Actors' => 'New Actor',
            'Runtime' => '130 min',
            'imdbRating' => '7.6',
        ];
        
        $this->mock(MovieRepositoryInterface::class, function (MockInterface $mock) use ($mockMovieData, $imdbId) {
            $mock->shouldReceive('findByImdbId')
                ->with($imdbId)
                ->once()
                ->andReturn($mockMovieData);
        });
        
        $job = new UpdateFilmJob($imdbId);
        $job->handle();
        
        $this->assertDatabaseHas('films', [
            'imdb_id' => $imdbId,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'release_year' => '2024',
            'director' => 'New Director',
            'rating' => 8,
        ]);
        
        $this->assertEquals(1, Film::where('imdb_id', $imdbId)->count());
    }

    public function test_update_film_job_handles_missing_data()
    {
        Genre::factory()->create(['id' => 1]);
        
        $imdbId = 'tt12042730';
        
        $mockMovieData = [
            'Title' => 'Test Film',
            'Year' => '2000',
        ];
        
        $this->mock(MovieRepositoryInterface::class, function (MockInterface $mock) use ($mockMovieData, $imdbId) {
            $mock->shouldReceive('findByImdbId')
                ->with($imdbId)
                ->once()
                ->andReturn($mockMovieData);
        });
        
        $job = new UpdateFilmJob($imdbId);
        $job->handle();
        
        $this->assertDatabaseHas('films', [
            'imdb_id' => $imdbId,
            'title' => 'Test Film',
            'description' => 'No description',
            'big_image' => 'no_image.jpg',
            'release_year' => '2000',
            'director' => 'Unknown',
            'rating' => 0,
        ]);
    }

    public function test_update_film_job_dispatched_to_queue()
    {
        Queue::fake();
        
        $imdbId = 'tt12042730';
        
        UpdateFilmJob::dispatch($imdbId);
        
        Queue::assertPushed(UpdateFilmJob::class);
    }
}