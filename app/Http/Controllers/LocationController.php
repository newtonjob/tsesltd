<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Auth\Middleware\Authorize;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop-location')
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::with('products')->get();

        return view('locations.index', compact('locations'));
    }

    public function show(Location $location)
    {
        $locations = Location::all();

        return view('locations.show', compact(['location', 'locations']));
    }
}
