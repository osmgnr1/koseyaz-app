<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

            'username' =>['required', 'string', 'lowercase', 'max:20', 'unique:'.User::class],
            'name' => ['string', 'max:25', 'nullable'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'ends_with:@hotmail.com,@outlook.com,@outlook.com.tr,@gmail.com,@yahoo.com', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ];
    }


    public function attributes(): array
    {
        return [
            'username' => __('Username'),
            'name' => __('Name'),
            'email' => __('E-Mail Address'),
            'password' => __('Password')
        ];
    }




}
