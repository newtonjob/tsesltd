<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                  => ['required', Rule::unique('categories')->ignore($this->category)],
            'image'                 => 'image',
            'featured_at'           => 'date|nullable',
            'relevance'             => 'numeric',
            'sub_categories.*.name' => 'unique:sub_categories|distinct|filled',
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
