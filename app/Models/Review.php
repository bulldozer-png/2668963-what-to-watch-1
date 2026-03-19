<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = ['comment', 'author_id', 'film_id', 'rating'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
