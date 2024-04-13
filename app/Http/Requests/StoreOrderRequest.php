<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreOrderRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'delivery_type'    => 'required',
            'delivery_address' => 'required_if:delivery_type,delivery',
        ] + ($this->user() ? [] : [
            'first_name' => 'required',
            'last_name'  => 'nullable',
            'email'      => 'email|required|unique:users',
            'phone'      => 'required|numeric|digits_between:10,15|unique:users',
        ]);
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Looks like you already have a profile with us. Kindly login to continue',
            'phone.unique' => 'Looks like you already have a profile with us. Kindly login to continue',
        ];
    }

    public function fulfill(): Order
    {
        $user = $this->user() ?? User::create(
            $this->only('email', 'first_name', 'last_name', 'phone')
        );

        Auth::login($user);

        $order = $user->orders()->create(
            $this->only('delivery_address', 'delivery_type')
        );

        $order->products()->attach(
            cart()->keyBy('id')->map->only('price', 'quantity')
        );

        return $order;
    }
}
