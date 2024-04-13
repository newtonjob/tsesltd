<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'                  => 'required|unique:categories',
            'image'                 => 'image',
            'featured_at'           => 'date',
            'relevance'             => 'numeric',
            'sub_categories.*.name' => 'unique:sub_categories|distinct',
        ];
    }

    public function messages(): array
    {
        return [
            'sub_categories.*.name.unique'      => 'Sub category #:position name already exists',
            'sub_categories.*.name.distinct'    => 'Sub category #:position name field has a duplicate value.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['sub_categories' => $this->collect('sub_categories')->filter->name->all()]);
    }
}
