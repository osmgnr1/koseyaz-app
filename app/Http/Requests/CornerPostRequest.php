<?php

namespace App\Http\Requests;

use App\Rules\BodyWordsRule;
use App\Rules\ConclusionWordsRule;
use App\Rules\EntryWordsRule;
use App\Rules\TagsRule;
use App\Rules\TitleRule;
use Illuminate\Foundation\Http\FormRequest;

class CornerPostRequest extends FormRequest
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
            'title' => ['required', 'string', "regex:/^[\pL\s\-']+$/u", new TitleRule],
            'body' => ['required', new BodyWordsRule],
            'category_id' => ['required', 'numeric'],
            'tags' => ['required', 'array', 'between:2,5'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
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




    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Başlık',
            // 'entry' => 'Giriş',
            'body' => 'Metin',
            // 'conclusion' => 'Sonuç',
            'category_id' => 'Kategori',
            'tags' => 'Etiket'
        ];
    }



}
