<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_year' => 'required|integer',
            'genre_id' => 'required|exists:genres,id',
            'big_image' => 'required|string|max:255',
            'small_image' => 'required|string|max:255',
            'bg_image' => 'required|string|max:255',
            'bg_color' => 'required|string|max:7',
            'director' => 'required|string|max:255',
            'cast_list' => 'required|string',
            'duration_minutes' => 'required|integer',
            'video_link' => 'required|string|max:255',
            'trailer_link' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:10',
        ];
    }
}
