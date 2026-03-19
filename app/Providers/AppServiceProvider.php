<?php

namespace App\Providers;

use App\Models\Genre;
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
            return $user->id === $review->author_id || $user->role->name === 'moderator';
        });

        Gate::define('delete-review', function (User $user, Review $review) {
            return  $user->id === $review->author_id || $user->role->name === 'moderator';
        });

        Gate::define('update-genre', function (User $user) {
            return $user->role->name === 'moderator';
        });
    }
}
