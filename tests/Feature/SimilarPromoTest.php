<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SimilarPromoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\RolesSeeder::class);
    }

    public function test_can_get_similar_films()
    {
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);
        Film::factory()->create(['genre_id' => $genre->id]);

        $response = $this->getJson("/api/films/{$film->id}/similar");

        $response->assertStatus(200)
            ->assertJsonCount(1);
    }

    public function test_promo_set_and_get()
    {
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        $response = $this->postJson("/api/promo/{$film->id}");
        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $film->id]);

        $response = $this->getJson('/api/promo');
        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $film->id]);
    }
}
