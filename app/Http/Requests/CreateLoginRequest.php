<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoginRequest extends FormRequest
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
            'credential' => ['required', 'max:250', new \App\Rules\ValidCredentialsRule],
            'password' => ['required','string', new \App\Rules\ValidCredentialsRule],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле електронної пошти обов\'язкове для заповнення',
            'email.email' => 'Будь ласка, введіть коректну електронну пошту',
            'email.max' => 'Електронна пошта не повинна перевищувати 200 символів',

            'password.required' => 'Поле паролю обов\'язкове для заповнення',
            'password.string' => 'Поле паролю повинно бути рядком',
            ];
    }
}
