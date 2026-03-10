<?php

namespace Tests\Unit;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class ReviewModelTest extends TestCase
{
    public function test_review_belongs_to_user()
    {
        $review = new Review();
        $relation = $review->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('author_id', $relation->getForeignKeyName());

    }

    public function test_review_belongs_to_film()
    {
        $review = new Review();
        $relation = $review->film();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('film_id', $relation->getForeignKeyName());
    }
}
