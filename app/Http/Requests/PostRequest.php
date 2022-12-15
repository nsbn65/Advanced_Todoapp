<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'content' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'タスクを入力してください。',
            'content.max' => 'タスクは20文字以内で入力してください。'
        ];
    }
}
