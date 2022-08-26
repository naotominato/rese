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
            'reserve_id' => 'required|integer',
            'evaluation' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:120',
            
        ];
    }

    public function attributes()
    {
        return [
            'reserve_id' => '予約情報',
            'evaluation' => '５段階評価',
            'comment' => 'コメント',
        ];
    }

    public function messages()
    {
        return [
            'reserve_id.required' => '不正な変更が確認されました。',
            'reserve_id.integer' => '不正な変更が確認されました。',
            'evaluation.required' => ':attributeは選択必須です。',
            'evaluation.integer' => ':attributeの星の数から選んでください。',
            'evaluation.between' => '1~5の:attributeからご選択ください。',
            'comment.required' => ':attributeは入力必須です。',
            'comment.string' => '文字でご入力ください。',
            'comment.max' => '最大120文字でご入力ください。',
        ];
    }
}