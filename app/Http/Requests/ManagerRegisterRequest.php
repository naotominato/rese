<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRegisterRequest extends FormRequest
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
            'manager_name' => 'required|string|max:191',
            'email' => 'required|email|unique:managers,email|string|max:191',
            'password' => 'required|min:8|max:191',
        ];
    }

    public function attributes()
    {
        return [
            'shop_id' => '店舗',
            'manager_name' => '氏名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => ':attributeをご選択ください。',
            'shop_id.integer' => ':attributeをご選択ください。',
            'manager_name.required' => ':attributeをご入力ください。',
            'manager_name.string' => ':attributeは文字でご入力ください。',
            'manager_name.max' => ':attributeは191文字以下でご入力ください。',
            'email.required' => ':attributeをご入力ください。',
            'email.email' => ':attributeの形式でご入力ください。',
            'email.unique' => 'こちらの:attributeは既に登録されています。',
            'email.string' => ':attributeは正しい文字でご入力ください。',
            'email.max' => ':attributeは191文字以下でご入力ください。',
            'password.required' => ':attributeをご入力ください。',
            'password.min' => ':attributeは8文字以上でご入力ください。',
            'password.max' => ':attributeは191文字以内でご入力ください。',
        ];
    }
}
