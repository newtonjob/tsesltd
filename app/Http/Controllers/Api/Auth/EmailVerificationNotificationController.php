<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailVerificationNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:2,1');
    }

    public function __invoke(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return Response::api('Verification link sent. Check your email.');
    }
}
