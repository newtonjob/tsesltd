<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePosOrderRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('point-of-sale');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'delivery_type'    => 'required',
            'delivery_address' => 'nullable',
            'delivery_fee'     => 'required_with:delivery_address|exclude',
            'user_id'          => 'nullable|numeric|exclude_unless:phone,null',
            'phone'            => 'nullable|required_without:user_id|numeric|digits_between:10,15|unique:users',
            'email'            => 'nullable|unique:users',
            'first_name'       => 'nullable|required_without:user_id',
            'last_name'        => 'nullable',
            'gender'           => 'nullable|required_without:user_id'
        ];
    }

    public function passedValidation() :void
    {
        if (! $this->filled('user_id')) {
            $this->merge(['user_id' => User::Create(
                $this->only('phone', 'first_name', 'last_name', 'gender', 'email'))->getKey()
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'phone' => 'Customer with this phone number already exists. Kindly select from existing Customers.',
            'email' => 'Customer with this email address already exists. Kindly select from existing Customers
                        or choose another email.',
        ];
    }

    public function fulfill(): Order
    {
        $order = Order::create($this->only('user_id', 'delivery_address', 'delivery_type'));

        $order->products()->attach(
            cart()->keyBy('id')->map->only('price', 'quantity')
        );

        return $order;
    }
}
