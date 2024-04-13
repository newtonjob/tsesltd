<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransferRequest;
use App\Models\Location;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            Authorize::using('manage-stock')
        );
    }

    public function store(StoreTransferRequest $request, Location $location)
    {
        DB::transaction(fn () => $request->fulfill());

        return Response::api('Transfer was successful');
    }
}
