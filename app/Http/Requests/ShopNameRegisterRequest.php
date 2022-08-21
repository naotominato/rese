<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopNameRegisterRequest extends FormRequest
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
            'id' => 'required|integer',
            'shop_name' => 'required|string|max:191',
        ];
    }

    public function attributes()
    {
        return [
            'shop_name' => '店舗名',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '不正な変更が確認されました。',
            'id.integer' => '不正な変更が確認されました。',
            'shop_name.required' => '登録するには、:attributeを設定してください。',
            'shop_name.string' => '文字入力をしてください。',
            'shop_name.max' => '191文字まで入力が可能です。',
        ];
    }
}
