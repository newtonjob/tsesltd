<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::withCount('orders')->{$request->type}()->get();
        $roles = Role::assignable()->get();

        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = $user->isAdmin() ? Role::assignable()->get() : [];

        return view('users.show', compact(['user', 'roles']));
    }
}
