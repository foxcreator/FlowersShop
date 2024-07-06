<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'product_id' => 'nullable|exists:products,id',
            'title_uk' => 'nullable|string|max:255',
            'title_ru' => 'nullable|string|max:255',
            'image' => 'nullable',
            'btn_text_uk' => 'nullable|string|max:255',
            'btn_text_ru' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'product_id.exists' => 'Выбранный продукт не существует.',
            'title_uk.required' => 'Поле "Наименование UA" обязательно для заполнения.',
            'title_uk.max' => 'Поле "Наименование UA" не должно превышать 255 символов.',
            'title_ru.max' => 'Поле "Наименование RU" не должно превышать 255 символов.',
            'btn_text_uk.max' => 'Поле "Текст кнопки UA" не должно превышать 255 символов.',
            'btn_text_ru.max' => 'Поле "Текст кнопки RU" не должно превышать 255 символов.',
            'link.max' => 'Поле "Ссылка на страницу" не должно превышать 255 символов.',
            'is_active.boolean' => 'Поле "Отображать постер на главной странице" должно быть логического типа.',
        ];
    }
}
