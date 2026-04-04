<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->string('big_image');
            $table->string('small_image');
            $table->string('bg_image');
            $table->string('bg_color');
            $table->foreignId('genre_id')->constrained();
            $table->year('release_year');
            $table->text('description');
            $table->string('director');
            $table->text('cast_list');
            $table->integer('duration_minutes');
            $table->string('video_link');
            $table->string('trailer_link');
            $table->integer('rating');

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
