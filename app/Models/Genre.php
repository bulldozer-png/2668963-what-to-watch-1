<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Illuminate\Database\Eloquent\Collection<int, Film> $films
 */
class Genre extends Model
{
    /** @template-use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\GenreFactory> */
    use HasFactory;

    protected $fillable = ['genre_name'];

    /**
     * Get the films associated with the genre.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_genre', 'genre_id', 'film_id');
    }
}
