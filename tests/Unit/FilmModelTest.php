<?php

namespace Tests\Unit;

use App\Models\Film;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class FilmModelTest extends TestCase
{
    public function test_film_has_many_reviews()
    {
        $film = new Film();
        $relation = $film->reviews();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('film_id', $relation->getForeignKeyName());
    }
}
