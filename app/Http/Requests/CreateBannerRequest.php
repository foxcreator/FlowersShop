<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
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
            'product_id' => 'nullable|exists:products,id|required_without_all:link',
            'title_ua' => 'required|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'image' => 'required',
            'btn_text_ua' => 'nullable|string|max:255',
            'btn_text_ru' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255|required_without_all:product_id',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.exists' => 'Выбранный продукт не существует.',
            'product_id.required_without_all' => 'Поле Продукт или Ссылка должно быть заполнено',
            'title_ua.required' => 'Поле "Наименование UA" обязательно для заполнения.',
            'title_ua.max' => 'Поле "Наименование UA" не должно превышать 255 символов.',
            'title_ru.max' => 'Поле "Наименование RU" не должно превышать 255 символов.',
            'image.required' => 'Поле изображение обязательно для заполнения.',
            'btn_text_ua.max' => 'Поле "Текст кнопки UA" не должно превышать 255 символов.',
            'btn_text_ru.max' => 'Поле "Текст кнопки RU" не должно превышать 255 символов.',
            'link.max' => 'Поле "Ссылка на страницу" не должно превышать 255 символов.',
            'link.required_without_all' => 'Поле Продукт или Ссылка должно быть заполнено',
            'is_active.boolean' => 'Поле "Отображать постер на главной странице" должно быть логического типа.',
        ];
    }
}
