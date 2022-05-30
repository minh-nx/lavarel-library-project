<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class BorrowBookRequest extends FormRequest
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
            'borrowed_date' => ['required', 'date', 'after_or_equal:today'],
            'term' => ['required', 'numeric', 'integer', 'min:1', 'max:'. \App\Models\Borrow::BORROW_MAX_DAY],
        ];
    }
}
