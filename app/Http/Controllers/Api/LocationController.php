<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Location::class);
    }

    public function store(Request $request)
    {
        Location::create($request->validate([
            'name'        => 'required|unique:locations',
            'address'     => 'required',
            'featured_at' => 'nullable|date',
        ]));

        return Response::api('Location has been successfully created.');
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name'        => ['required', Rule::unique('locations')->ignore($location)],
            'address'     => 'required',
            'featured_at' => 'nullable|date',
        ]);

        $location->update($validated);

        return Response::api('Location has been updated successfully.');
    }

    public function destroy(Request $request, Location $location)
    {
        $location->delete();

        return Response::api('Location has been deleted successfully.');
    }
}
