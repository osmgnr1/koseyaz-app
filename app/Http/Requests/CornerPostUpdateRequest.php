<?php

namespace App\Http\Requests;

use App\Rules\BodyWordsRule;
use App\Rules\TitleRule;
use Illuminate\Foundation\Http\FormRequest;

class CornerPostUpdateRequest extends FormRequest
{
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
            'id' => ['required', 'numeric'],
            'title' => ['required', 'string', "regex:/^[\pL\s\-']+$/u", new TitleRule],
            'body' => ['required', new BodyWordsRule],
            'category_id' => ['required', 'numeric'],
            'tags' => ['required', 'array', 'between:2,5'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Başlık alanı gereklidir',
            'title.regex' => 'Başlık alanı sadece harf içermelidir',
            'body.required' => 'Metin alanı gereklidir',
            'category_id.required' => 'Kategori alanı gereklidir',
            'tags.required' => 'Etiket alanı gereklidir',
            'tags.between' => 'Etiketler 2 ve 5 arasında seçilmelidir',
        ];
    }


}
