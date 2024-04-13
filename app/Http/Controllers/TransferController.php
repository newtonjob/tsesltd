<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Transfer;
use Illuminate\Auth\Middleware\Authorize;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-stock')
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transfers = Transfer::with(['products', 'creator'])->latest()->get();
        $locations = Location::has('products')->get();

        return view('transfers.index', compact('transfers', 'locations'));
    }

    public function create(Location $location)
    {
        return view('transfers.create', ['location'  => $location, 'locations' => Location::all()]);
    }

    public function show(Transfer $transfer)
    {
        return view('transfers.show', compact('transfer'));
    }
}
