<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NewUserController extends Controller
{
    public function store(Request $request)
    {
        Auth::login(User::create($request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:users',
            'phone'      => 'required|numeric|min_digits:10|unique:users',
            'gender'     => 'required',
            'password'   => 'required|min:3|confirmed',
        ])));

        return Response::api('Your account has been registered successfully, use your credentials to login.');
    }

}
