<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\RolesSeeder::class);
    }

    public function test_user_can_add_and_remove_favorite()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        Sanctum::actingAs($user);

        $response = $this->postJson("/api/films/{$film->id}/favorite");
        $response->assertStatus(201)
            ->assertJsonPath('film_id', (string) $film->id);

        $this->assertDatabaseHas('favorites', ['user_id' => $user->id, 'film_id' => $film->id]);

        $response = $this->deleteJson("/api/films/{$film->id}/favorite");
        $response->assertStatus(204);

        $this->assertDatabaseMissing('favorites', ['user_id' => $user->id, 'film_id' => $film->id]);
    }

    public function test_user_can_get_favorites()
    {
        $user = User::factory()->create(['role_id' => 1]);
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        \App\Models\Favorite::create(['user_id' => $user->id, 'film_id' => $film->id]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/favorite');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment(['film_id' => $film->id]);
    }
}
