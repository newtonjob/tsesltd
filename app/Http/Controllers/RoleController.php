<?php

namespace App\Http\Controllers;

use App\Models\Enums\Ability;
use App\Models\Role;
use Illuminate\Auth\Middleware\Authorize;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-admin')
        );
    }
    public function index()
    {
        $roles = Role::withCount('users')->get();
        $abilities = Ability::cases();

        return view('roles.index', compact(['roles', 'abilities']));
    }
    public function show(Role $role)
    {
        $abilities = Ability::cases();
        return view('roles.show', compact(['role', 'abilities']));
    }
}
