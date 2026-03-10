<?php

namespace Database\Factories;

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
            'big_image' => fake()->sentence(),
            'small_image' => fake()->sentence(),
            'bg_image' => fake()->sentence(),
            'bg_color' => fake()->sentence(),
            'genre_id' => fake()->numberBetween(1, 3),
            'director' => fake()->sentence(),
            'cast_list' => fake()->text(),
            'duration_minutes' => fake()->numberBetween(120, 180),
            'video_link' => fake()->sentence(),
            'trailer_link' => fake()->sentence(),
            'rating' => fake()->numberBetween(1, 5),
            
            'description' => fake()->text(),
            'release_year' => fake()->numberBetween(1990, 2024),
        ];
    }
}
