<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->user();

        return [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string|min:8|password_check:' . $user->password,
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Поле "Имя" обов\'язкове для заповнення.',
            'phone.required' => 'Поле "Телефон" обов\'язкове для заповнення.',
            'email.required' => 'Поле "Email" обов\'язкове для заповнення.',
            'email.email' => 'Введіть коректний email.',
            'email.unique' => 'Цей email вже використовується.',
            'current_password.required' => 'Поле "Поточний пароль" обов\'язкове для заповнення.',
            'current_password.password_check' => 'Поточний пароль не відповідає збереженому паролю користувача.',
            'current_password.min' => 'Пароль повинен містити мінімум 8 символів.',
            'current_password.confirmed' => 'Паролі не співпадають.',
            'password.required' => 'Поле "Пароль" обов\'язкове для заповнення.',
            'password.min' => 'Пароль повинен містити мінімум 8 символів.',
            'password.confirmed' => 'Паролі не співпадають.',
        ];
    }
}
