<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'required|unique:products|max:255',
            'tags'              => 'nullable',
            'price'             => 'required',
            'discount'          => 'filled',
            'model_no'          => 'nullable|unique:products|max:255',
            'brand_id'          => 'nullable',
            'cost_price'        => 'required',
            'featured_at'       => 'date|nullable',
            'description'       => 'nullable',
            'sub_category_id'   => 'required',
        ];
    }
}
