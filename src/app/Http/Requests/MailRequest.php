<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:100'],
            'body' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名を入力してください',
            'subject.string' => '正しい文字を入力してください',
            'subject.max' => '100文字以内で入力してください',
            'body.required' => '本文を入力してください',
            'body.string' => '正しい文字で入力してください', 
        ];
    }
}
