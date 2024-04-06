<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheck;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->hasUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'old_password' => ['required', new CurrentPasswordCheck],
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Поле обязательно для заполнения.',
            'old_password.*' => 'Не верный пароль.',
            'password.required' => 'Поле обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            'password.confirmed' => 'Пароль и подтверждение пароля не совпадают.',
        ];
    }
}
