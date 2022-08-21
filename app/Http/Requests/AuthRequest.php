<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => 'required|email|string|max:191',
            'password' => 'required|min:8|max:191',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => ':attributeをご入力ください。',
            'email.email' => ':attributeの形式でご入力ください。',
            'email.string' => ':attributeは正しい文字でご入力ください。',
            'email.max' => ':attributeは191文字以下でご入力ください。',
            'password.required' => ':attributeは入力必須です。',
            'password.min' => ':attributeは8文字以上でご入力ください。',
            'password.max' => ':attributeは191文字以内でご入力ください。',
        ];
    }
}
