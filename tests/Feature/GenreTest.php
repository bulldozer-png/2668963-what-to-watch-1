<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class GenreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\RolesSeeder::class);
    }

    public function test_can_get_genres()
    {
        Genre::factory()->count(3)->create();

        $response = $this->getJson('/api/genres');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'genre_name'
                ]
            ]);
    }

    public function test_guest_cannot_update_genre()
    {
        $genre = Genre::factory()->create();

        $response = $this->patchJson("/api/genres/$genre->id", [
            'genre_name' => 'Drama'
        ]);

        $response->assertStatus(401);
    }

    public function test_user_cannot_update_genre()
    {
        $genre = Genre::factory()->create();

        $user = User::factory()->create([
            'role_id' => 1
        ]);

        Sanctum::actingAs($user);

        $response = $this->patchJson("/api/genres/$genre->id", [
            'genre_name' => 'Drama'
        ]);

        $response->assertStatus(403);
    }

    public function test_moderator_can_update_genre()
    {
        $genre = Genre::factory()->create();

        $moderator = User::factory()->create([
            'role_id' => 2
        ]);

        Sanctum::actingAs($moderator);

        $response = $this->patchJson("/api/genres/$genre->id", [
            'genre_name' => 'Drama'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('genres', [
            'id' => $genre->id,
            'genre_name' => 'Drama'
        ]);
    }

    public function test_moderator_can_create_genre()
    {
        $moderator = User::factory()->create(['role_id' => 2]);
        Sanctum::actingAs($moderator);

        $response = $this->postJson('/api/genres', [
            'genre_name' => 'Thriller',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['genre_name' => 'Thriller']);

        $this->assertDatabaseHas('genres', ['genre_name' => 'Thriller']);
    }

    public function test_can_show_genre()
    {
        $genre = Genre::factory()->create(['genre_name' => 'Action']);

        $response = $this->getJson("/api/genres/$genre->id");

        $response->assertStatus(200)
            ->assertJsonFragment(['genre_name' => 'Action']);
    }

    public function test_moderator_can_delete_genre()
    {
        $genre = Genre::factory()->create();
        $moderator = User::factory()->create(['role_id' => 2]);
        Sanctum::actingAs($moderator);

        $response = $this->deleteJson("/api/genres/$genre->id");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('genres', ['id' => $genre->id]);
    }
}
