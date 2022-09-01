<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveUpdateRequest extends FormRequest
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
            'shop_id' => 'required|integer',
            'date' => 'required|date_format:Y-m-d|after_or_equal:tomorrow|',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer|between:1,20',
        ];
    }

    public function attributes()
    {
        return [
            'date' => '日付',
            'time' => '時間',
            'number' => '人数',
        ];
    }

    public function messages()
    {
        return [
            'reserve_id.required' => '不正な変更が確認されました。',
            'reserve_id.interger' => '不正な変更が確認されました。',
            'shop.required' => '不正な変更が確認されました。',
            'shop.integer' => '不正な変更が確認されました。',
            'date.required' => ':attributeを選択してください。',
            'date.after_or_equal' => '変更は明日以降で可能です。',
            'time.required' => ':attributeを選択してください。',
            'time.date_format' => '指定の項目から選択してください。',
            'number.required' => ':attributeを選択してください。',
            'number.integer' => '指定の項目から選択してください。',
            'number.between' => '人数は1人～20人のみです。指定の項目から選択してください。',
        ];
    }
}
