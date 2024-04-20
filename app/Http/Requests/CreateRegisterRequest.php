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
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Ім\'я" є обов\'язковим.',
            'name.string' => 'Поле "Ім\'я" повинно бути рядком.',
            'name.max' => 'Поле "Ім\'я" не може бути довшим за 255 символів.',
            'last_name.required' => 'Поле "Прізвище" є обов\'язковим.',
            'last_name.string' => 'Поле "Прізвище" повинно бути рядком.',
            'last_name.max' => 'Поле "Прізвище" не може бути довшим за 255 символів.',
            'phone.required' => 'Поле "Телефон" є обов\'язковим.',
            'phone.unique' => 'Користувач з таким номером вже існує.',
            'phone.string' => 'Поле "Телефон" повинно бути рядком.',
            'phone.max' => 'Поле "Телефон" не може бути довшим за 20 символів.',
            'email.required' => 'Поле "Електронна пошта" є обов\'язковим.',
            'email.email' => 'Поле "Електронна пошта" повинно бути дійсною адресою електронної пошти.',
            'email.unique' => 'Користувач з такою адресою електронної пошти вже існує.',
            'email.max' => 'Поле "Електронна пошта" не може бути довшим за 255 символів.',
            'password.required' => 'Поле "Пароль" є обов\'язковим.',
            'password.string' => 'Поле "Пароль" повинно бути рядком.',
            'password.min' => 'Пароль повинен містити щонайменше 8 символів.',
            'password.confirmed' => 'Підтверджений пароль не співпадає.',
        ];
    }
}
