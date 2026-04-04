<?php

use Illuminate\Support\Facades\Route;

// use App\Models\Review;

Route::get('/', function () {
    return view('welcome');

    // return response()->json([
    //     'status' => 'ok'
    // ]);
});

Route::get('/login', function () {
    return 'Login page';
})->name('login');


// Route::get('/test', function () {

//     $review = Review::first();
//     $author = $review->user;

//     return [
//         'review_text' => $review->comment,
//         'author_name' => $author->name
//     ];
// });
