<?php

namespace App\Http\Requests;

use App\Rules\NoForbiddenWords;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', new NoForbiddenWords()],
            'body' => ['required', new NoForbiddenWords()],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須です',
            'title.string' => 'タイトルは文字列で入力してください',
            'title.max' => 'タイトルは255文字以内で入力してください',
            'body.required' => '内容は必須です',
        ];
    }
}
