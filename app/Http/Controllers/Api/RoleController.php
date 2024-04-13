<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-admin')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create($request->validate(['name' => 'required|unique:roles', 'abilities' => 'required']));

        return Response::api('Role Added Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($role)],
            'abilities' => 'required'
        ]));

        return Response::api('Role updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return Response::api('Location deleted successfully');
    }
}
