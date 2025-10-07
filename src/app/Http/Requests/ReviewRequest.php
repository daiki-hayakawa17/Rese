<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rating' => ['required'],
            'comment' => ['string', 'nullable'],
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '5段階で評価してください',
            'comment.string' => '正しい文字で入力してください',
        ];
    }
}
