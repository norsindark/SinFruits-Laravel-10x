<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment' => [
                'nullable',
                'string',
                'max:255',
                Rule::notIn(config('app.forbidden_words')), 
            ],
            'product_id' => 'required|exists:products,id',
            'rating' => 'nullable|integer|between:1,5',
        ];
    }
}
