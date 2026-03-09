<?php

namespace App\Providers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('update-review', function (User $user, Review $review) {
            return $user->role->name === 'moderator' || $user->id === $review->author_id;
        });

        Gate::define('delete-review', function (User $user, Review $review) {
            return $user->role->name === 'moderator' || $user->id === $review->author_id;
        });
    }
}
