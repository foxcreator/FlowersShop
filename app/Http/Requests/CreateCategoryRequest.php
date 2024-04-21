<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title_uk' => 'required|min:4|max:255',
            'title_ru' => 'nullable|min:4|max:255',
            'description_uk' => 'required|min:20|max:65535',
            'description_ru' => 'nullable|min:20|max:65535',
            'thumbnail' => 'required|image:jpeg,png,jpg',
            'is_show_on_homepage' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'title_uk.required' => 'Поле заголовка обязательно для заполнения.',
            'title_uk.min' => 'Наименование должен содержать минимум :min символов.',
            'title_uk.max' => 'Наименование должен содержать не более :max символов.',
            'title_ru.required' => 'Поле обязательно для заполнения.',
            'title_ru.min' => 'Наименование должен содержать минимум :min символов.',
            'title_ru.max' => 'Наименование должен содержать не более :max символов.',
            'description_uk.required' => 'Поле обязательно для заполнения.',
            'description_uk.min' => 'Описание должно содержать минимум :min символов.',
            'description_uk.max' => 'Описание должно содержать не более :max символов.',
            'description_ru.required' => 'Поле обязательно для заполнения.',
            'description_ru.min' => 'Описание должно содержать минимум :min символов.',
            'description_ru.max' => 'Описание должно содержать не более :max символов.',
            'thumbnail.required' => 'Поле изображения не может быть пустым.',
        ];
    }
}
