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
            'name' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'タスクを入力してください。',
            'name.max' => 'タスクは20文字以内で入力してください。'
        ];
    }
}
