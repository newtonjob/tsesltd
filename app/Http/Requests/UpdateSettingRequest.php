<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'about.title'            => 'filled',
            'about.text1'            => 'filled',
            'about.body.*.title'     => 'filled',
            'about.body.*.body'      => 'filled',
            'title'                  => 'filled',
            'description'            => 'filled',
            'footer_quote'           => 'filled',
            'phone'                  => 'filled',
            'email'                  => 'filled|email',
            'address'                => 'filled',
            'social_links.facebook'  => 'url|nullable',
            'social_links.instagram' => 'url|nullable',
            'social_links.twitter'   => 'url|nullable',
            'social_links.linkedin'  => 'url|nullable',
            'usd_exchange_rate'      => 'numeric',
        ];
    }
}
