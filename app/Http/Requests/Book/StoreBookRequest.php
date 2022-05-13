<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'author' => 'string|required',
            'title' => 'string|required|max:255|min:1',
            'release_date' => 'date|required',
            'description' => 'string|required',
            'isbn' => 'string|required',
            'format' => 'string|required',
            'number_of_pages' => 'integer|required'
        ];
    }
}
