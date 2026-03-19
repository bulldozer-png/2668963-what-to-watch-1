<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Database\Seeders\FilmSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\GenreSeeder::class);
        $this->seed(\Database\Seeders\RolesSeeder::class);
    }

    public function test_can_get_films()
    {
        $this->seed(FilmSeeder::class);
        
        $response = $this->getJson('/api/films');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'title',
                         'description',
                         'release_year'
                     ]
                 ]);
    }

    public function test_can_get_single_film()
    {
        $genre = \App\Models\Genre::first();

        $film = Film::factory()->create([
            'genre_id' => $genre->id,
        ]);

        $response = $this->getJson("/api/films/$film->id");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'id',
                    'title',
                    'description',
                    'release_year'
                ]);
    }


    public function test_user_cannot_create_film()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $genre = Genre::factory()->create();
        $data = [
            'title' => 'Matrix',
            'description' => 'Neo story',
            'release_year' => 1999,
            'genre_id' => $genre->id,
        ];

        $response = $this->actingAs($user)->postJson('/api/films', $data);
        $response->assertStatus(403);
    }

    public function test_user_cannot_update_film()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        $response = $this->actingAs($user)
            ->patchJson("/api/films/$film->id", [
                'title' => 'Updated title'
            ]);

        $response->assertStatus(403);
    }


    public function test_moderator_can_create_film()
    {
        $user = User::factory()->create(['role_id' => 2]);
        $genre = Genre::factory()->create();
        $data = [
            'title' => 'Matrix',
            'description' => 'Neo story',
            'release_year' => 1999,
            'genre_id' => $genre->id,
            'big_image' => 'https://picsum.photos/800/600',
            'small_image' => 'https://picsum.photos/200/150',
            'bg_image' => 'https://picsum.photos/1920/1080',
            'bg_color' => '#ff0000',
            'director' => 'Lana Wachowski',
            'cast_list' => 'Keanu Reeves, Laurence Fishburne',
            'duration_minutes' => 136,
            'video_link' => 'https://example.com/video.mp4',
            'trailer_link' => 'https://example.com/trailer.mp4',
            'rating' => 9,
        ];

        $response = $this->actingAs($user)->postJson('/api/films', $data);
        $response->assertStatus(201);
    }

    public function test_moderator_can_update_film()
    {
        $user = User::factory()->create(['role_id' => 2]);
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        $response = $this->actingAs($user)
            ->patchJson("/api/films/$film->id", [
                'title' => 'Updated title'
            ]);

        $response->assertStatus(200);

    }
}