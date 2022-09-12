<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRegisterRequest extends FormRequest
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
            'shop_id' => 'required|integer',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'detail' => 'required|string|max:1000',
            'shop_image' => 'max:10240|mimes:jpg,jpeg,png,gif',
        ];
    }

    public function attributes()
    {
        return [
            'area_id' => '地域名',
            'genre_id' => 'ジャンル名',
            'detail' => '店舗紹介文',
            'shop_image' => '画像',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => '不正な変更が確認されました。',
            'shop_id.integer' => '不正な変更が確認されました。',
            'area_id.required' => ':attributeは選択必須です。',
            'area_id.integer' => 'Areaを選択肢から選んでください。',
            'genre_id.required' => ':attributeは選択必須です',
            'genre_id.integer' => 'Genreを選択肢から選んでください。',
            'detail.required' => ':attributeは入力必須です。',
            'detail.string' => '文字でご入力をしてください。',
            'detail.max' => '500文字以内でご入力してください。',
            'shop_image.max' => ':attributeの容量は「10MB」まで可能です。',
            'shop_image.mimes' => ':attributeは「jpb,jpeg,png,gif」のみ可能です。',
        ];
    }
}
