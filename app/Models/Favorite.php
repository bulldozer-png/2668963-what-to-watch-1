<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $film_id
 * @property int $user_id
 * @property Film $film
 * @property User $user
 */
class Favorite extends Model
{
    /** @template-use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;

    protected $fillable = ['film_id', 'user_id'];

    /**
     * Get the film that this favorite belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * Get the user that this favorite belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
