<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    /** @use HasFactory<\Database\Factories\FilmFactory> */
    use HasFactory;

    protected $fillable = [
        'imdb_id', 'title', 'description', 'release_year', 'genre_id',
        'director', 'cast_list', 'duration_minutes',
        'video_link', 'trailer_link', 'rating',
        'big_image', 'small_image', 'bg_image', 'bg_color'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_id', 'genre_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
