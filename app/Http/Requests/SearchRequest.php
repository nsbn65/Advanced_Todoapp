<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'keyword' => 'nullable|max:20',
        ];
    }
    public function messages()
    {
        return [
            'keyword.required' => 'タスクを入力してください。',
            'keyword.max' => 'タスクは20文字以内で入力してください。'
        ];
    }
}
