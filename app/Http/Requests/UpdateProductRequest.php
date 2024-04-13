<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name'              => ['required', Rule::unique('products')->ignore($this->product), 'max:255'],
            'tags'              => 'nullable',
            'price'             => 'required',
            'discount'          => 'filled',
            'model_no'          => ['nullable', Rule::unique('products')->ignore($this->product), 'max:255'],
            'brand_id'          => 'filled',
            'cost_price'        => 'required',
            'featured_at'       => 'date|nullable',
            'description'       => 'nullable',
            'sub_category_id'   => 'required',
        ];
    }
}
