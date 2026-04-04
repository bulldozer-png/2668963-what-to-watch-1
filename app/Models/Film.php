<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int|null $genre_id
 * @property \Illuminate\Database\Eloquent\Collection<int, Genre> $genres
 * @property \Illuminate\Database\Eloquent\Collection<int, Review> $reviews
 */
class Film extends Model
{
    /** @template-use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $fillable = [
        'imdb_id', 'title', 'description', 'release_year', 'genre_id',
        'director', 'cast_list', 'duration_minutes',
        'video_link', 'trailer_link', 'rating',
        'big_image', 'small_image', 'bg_image', 'bg_color'
    ];

    /**
     * Get the genres associated with the film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_id', 'genre_id');
    }

    /**
     * Get the reviews for the film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
