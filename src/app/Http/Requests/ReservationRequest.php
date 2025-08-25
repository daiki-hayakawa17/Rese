<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'number' => ['required', 'integer', 'between:1,100'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '正しい日付ではありません',
            'date.after_or_equal' => '正しい日付ではありません',
            'time.required' => '時間を入力してください',
            'time.date_format' => '正しい時間ではありません',
            'number.required' => '人数を入力してください',
            'number.integer' => '数字で入力してください',
            'number.between' => '1~100の間で入力してください',
        ];
    }
}
