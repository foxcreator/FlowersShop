<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubcategoryRequest extends FormRequest
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
            'name_uk' => 'required|string|max:255|unique:subcategories,name_uk',
            'name_ru' => 'required|string|max:255|unique:subcategories,name_ru',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
}
