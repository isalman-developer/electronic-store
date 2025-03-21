<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
            'brand' => 'required|string|max:255',
            'tag_number' => 'required|string|max:255|unique:products,tag_number',
            'price' => 'required|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
