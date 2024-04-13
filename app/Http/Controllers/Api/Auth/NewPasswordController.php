<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'token'    => 'required',
            'password' => 'required|min:5|confirmed'
        ]);

        $status = Password::reset($request->all(), function (User $user, $password) {
            Auth::login(tap($user, function ($user) use ($password) {
                $user->email_verified_at ??= now();
                $user->update(['password' => $password]);
            }));
        });

        throw_unless($status == Password::PASSWORD_RESET,
            ValidationException::withMessages(['password' => __($status)])
        );

        return Response::api(__($status));
    }
}
