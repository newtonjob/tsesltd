<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController
{
    public function store(Request $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        throw_unless($status == Password::RESET_LINK_SENT,
            ValidationException::withMessages(['password' => __($status)])
        );

        return Response::api(__($status));
    }
}
