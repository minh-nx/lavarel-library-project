<?php

namespace App\Http\Requests\Resources;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'unique:books'],
            'author' => ['required', 'string'],
            'publication_year' => ['required', 'integer', 'between:1,2022'],
            'cover_image' => 'present',
            'description' => ['present', 'string'],
            'quantity' => ['required', 'integer', 'between:1,9'],
        ];
    }
}
