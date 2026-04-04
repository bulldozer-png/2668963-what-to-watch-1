<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'big_image' => fake()->imageUrl(),
            'small_image' => fake()->imageUrl(),
            'bg_image' => fake()->imageUrl(),
            'bg_color' => fake()->hexColor(),
            'genre_id' => Genre::factory(),
            'director' => fake()->name(),
            'cast_list' => fake()->text(),
            'duration_minutes' => fake()->numberBetween(120, 180),
            'video_link' => fake()->url(),
            'trailer_link' => fake()->url(),
            'rating' => fake()->numberBetween(1, 5),

            'description' => fake()->paragraph(),
            'release_year' => fake()->numberBetween(1990, 2024),
        ];
    }
}
