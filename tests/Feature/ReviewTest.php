<?php

use App\Models\Film;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Database\Seeders\FilmSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\GenreSeeder::class);
        $this->seed(\Database\Seeders\RolesSeeder::class);
    }

    public function test_can_get_reviews()
    {
        $film = Film::factory()->create();
        $user = User::factory()->create();


        $reviews = \App\Models\Review::factory()->count(3)->create([
            'film_id' => $film->id,
            'author_id' => $user->id,
        ]);

        $response = $this->getJson("/api/comments/{$film->id}");

        $response->assertStatus(200)
        ->assertJsonCount(3)
        ->assertJsonStructure([
            '*' => [
                'id',
                'author_id',
                'film_id',
                'rating',
                'comment',
            ]
        ]);
    }

    public function test_user_can_create_review()
    {
        $user = User::factory()->create();  
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        $data = [
            'film_id' => $film->id,
            'author_id' => $user->id,
            'rating' => 5,
            'comment' => 'Очень крутой фильм!',
        ];

        $response = $this->actingAs($user)
                        ->postJson("/api/comments/$film->id", $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('reviews', [
            'film_id' => $film->id,
            'author_id' => $user->id,
            'rating' => 5,
            'comment' => 'Очень крутой фильм!',
        ]);
    }

    public function test_author_can_update_review()
    {
        $genre = Genre::factory()->create();
        $film = Film::factory()->create(['genre_id' => $genre->id]);

        $user = User::factory()->create(['role_id' => 2]);
        $review = Review::factory()->create([
            'author_id' => $user->id,
            'film_id' => $film->id,
            'rating' => 1,
            'comment' => '123',
        ]);

        $response = $this->actingAs($user)
                        ->patchJson("/api/comments/$review->id", [
                            'rating' => 5,
                            'comment' => 'Исправленный комментарий',
                            'author_id' => $user->id,
                            'film_id' => $film->id,
                        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'rating' => 5,
            'comment' => 'Исправленный комментарий',
            'author_id' => $user->id,
            'film_id' => $film->id,
        ]);
    }
}