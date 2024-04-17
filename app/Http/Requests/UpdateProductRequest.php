<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $productId = $this->route('product');

        return [
            'category_id' => 'required',
            'title_ua' => 'required|min:8|max:255|unique:products,title_ua,' . $productId,
            'title_ru' => 'nullable|min:8|max:255|unique:products,title_ru,' . $productId,
            'price' => 'required|numeric',
            'description_ua' => 'required|min:20|max:65535',
            'description_ru' => 'nullable|min:20|max:65535',
            'quantity' => 'required|numeric',
            'article' => 'required|numeric|digits:7|unique:products,article,' . $productId,
            'thumbnail' => 'nullable|image:jpeg,png,jpg',
            'badge' => 'nullable',
            'product_photos' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'category_id' => 'Поле категории обязательно для заполнения.',
            'title_ua.required' => 'Поле заголовка обязательно для заполнения.',
            'title_ua.min' => 'Заголовок должен содержать минимум :min символов.',
            'title_ua.max' => 'Заголовок должен содержать не более :max символов.',
            'title_ru.required' => 'Поле заголовка обязательно для заполнения.',
            'title_ru.min' => 'Заголовок должен содержать минимум :min символов.',
            'title_ru.max' => 'Заголовок должен содержать не более :max символов.',
            'price.required' => 'Поле цены обязательно для заполнения.',
            'price.numeric' => 'Цена должна быть числом.',
            'description_ua.required' => 'Поле описания обязательно для заполнения.',
            'description_ua.min' => 'Описание должно содержать минимум :min символов.',
            'description_ua.max' => 'Описание должно содержать не более :max символов.',
            'description_ru.required' => 'Поле описания обязательно для заполнения.',
            'description_ru.min' => 'Описание должно содержать минимум :min символов.',
            'description_ru.max' => 'Описание должно содержать не более :max символов.',
            'quantity.required' => 'Поле количества обязательно для заполнения.',
            'quantity.numeric' => 'Количество должно быть числом.',
            'article.required' => 'Поле артикула обязательно для заполнения.',
            'article.numeric' => 'Артикул должен быть числом.',
            'article.digits' => 'Артикул должен содержать :digits символов.',
            'thumbnail.nullable' => 'Поле изображения может быть пустым.',
            'badge.nullable' => 'Поле бейджа может быть пустым.',
            'product_photos.*' => 'Неверный формат'
        ];
    }
}
