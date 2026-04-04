<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $author_id
 * @property int $film_id
 * @property Film $film
 * @property User $user
 */
class Review extends Model
{
    /** @template-use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = ['comment', 'author_id', 'film_id', 'rating'];

    /**
     * Get the film that this review belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * Get the user that wrote this review.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
