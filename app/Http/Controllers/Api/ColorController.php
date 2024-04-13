<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ColorController
{
    public function __construct()
    {
        Gate::authorize('manage-shop');
    }

    public function store(Request $request)
    {
        Color::create($request->validate([
            'name' => 'required|unique:colors',
        ]));

        return Response::api('Color has been successfully created.');
    }

    public function update(Request $request, Color $color)
    {
        $color->update($request->validate([
            'name' => ['required', Rule::unique('colors')->ignore($color)],
        ]));

        return Response::api('Color has been updated successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return Response::api('Color has been deleted successfully.');
    }
}
