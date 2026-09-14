<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'why_choose_product' => 'nullable|string',
            'sample_number_list' => 'nullable|string',
            'lining' => 'nullable|string',
            'weight' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lte:regular_price',
            'SKU' => 'required|string|max:255|unique:products,SKU',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'featured' => 'required|boolean',
            'stock_status' => 'required|in:instock,outofstock',
            'quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10000',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10000',
            'sizes' => ['nullable', 'array'],
            'sizes.*' => ['exists:sizes,id'],
            'colors' => ['nullable', 'array'],

            'colors.*' => ['exists:colors,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name cannot exceed 255 characters.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug already exists.',
            'description.required' => 'Description is required.',

            'regular_price.required' => 'Regular price is required.',
            'regular_price.numeric' => 'Regular price must be a number.',
            'regular_price.min' => 'Regular price cannot be negative.',
            'sale_price.numeric' => 'Sale price must be a number.',
            'sale_price.min' => 'Sale price cannot be negative.',
            'sale_price.lte' => 'Sale price cannot be greater than regular price.',
            'SKU.required' => 'SKU is required.',
            'SKU.unique' => 'This SKU already exists.',
            'category_id.required' => 'Category is required.',
            'category_id.exists' => 'Selected category does not exist.',
            'brand_id.required' => 'Brand is required.',
            'brand_id.exists' => 'Selected brand does not exist.',
            'featured.required' => 'Please select featured status.',
            'featured.boolean' => 'Featured must be Yes or No.',
            'stock_status.required' => 'Stock status is required.',
            'stock_status.in' => 'Stock status must be instock or outofstock.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity cannot be negative.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Image must be jpg, jpeg, png, or webp.',
            'image.max' => 'Image size cannot exceed 2MB.',
            'images.array' => 'Gallery images must be an array.',
            'images.*.image' => 'Each gallery file must be an image.',
            'images.*.mimes' => 'Gallery images must be jpg, jpeg, png, or webp.',
            'images.*.max' => 'Each gallery image cannot exceed 2MB.',
        ];
    }
}
