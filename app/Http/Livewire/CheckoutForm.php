<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CheckoutForm extends Component
{
    public $phone;

    public function render()
    {
        $user = User::where('phone', $this->phone)->first();

        return view('livewire.checkout-form', compact('user'));
    }
}
