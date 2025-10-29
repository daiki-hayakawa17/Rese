<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'area_id' => ['required'],
            'genre_id' => ['required'],
            'name' => ['required', 'string'],
            'shop__image' => ['required', 'mimes:png,jpg'],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'area_id.required' => '店舗エリアを選択してください',
            'genre_id.required' => 'ジャンルを選択してください',
            'name.required' => '店舗名を入力してください',
            'name.string' => '正しい文字で入力してください',
            'shop__image.required' => '店舗画像を登録してください',
            'shop__image.mimes' => '店舗画像は「.png」または「.jpg」形式でアップロードしてください',
            'description.required' => '店舗概要を入力してください',
            'description.string' => '正しい文字で入力してください',
            'description.max' => '255文字以内で入力してください',
        ];
    }
}
