<?php

namespace App\Http\Requests;

use App\Models\Stock;
use App\Models\Transfer;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
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
            'product_transfer.*.to_location_id'   => 'required',
            'product_transfer.*.product_id'       => 'required',
            'product_transfer.*.quantity'         => ['required', 'numeric', 'min:1'],
        ];
    }

    public function fulfill()
    {
        Transfer::create()->products()->attach(
            $this->collect('product_transfer')->keyBy('product_id'),
            ['from_location_id' => $this->location->id]
        );
    }
}
