<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegisterRequest extends FormRequest
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
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Поле "Телефон" є обов\'язковим.',
            'phone.unique' => 'Користувач з таким номером вже існує.',
            'phone.numeric' => 'Поле номера телефону повинно містити тільки числові значення.',
            'phone.digits' => 'Поле номера телефону повинно містити рівно 10 цифр.',
            'password.required' => 'Поле "Пароль" є обов\'язковим.',
            'password.string' => 'Поле "Пароль" повинно бути рядком.',
            'password.min' => 'Пароль повинен містити щонайменше 8 символів.',
            'password.confirmed' => 'Підтверджений пароль не співпадає.',
        ];
    }
}
