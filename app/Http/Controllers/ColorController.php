<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Enums\Ability;
use Illuminate\Auth\Middleware\Authorize;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-shop')
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::with('products')->get();

        return view('colors.index', compact('colors'));
    }


}
