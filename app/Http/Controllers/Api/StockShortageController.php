<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Notifications\StockShortageCreated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class StockShortageController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request, Location $location, Product $product)
    {
        $this->authorize('manage-stock');

        $stock = Stock::whereBelongsTo($location)->whereBelongsTo($product)->first();

        $request->validate([
            'quantity' => "required|numeric|min:1|max:{$stock->quantity}",
        ]);

        $stock->decrement('quantity', $request->quantity, [
            'updated_by' => Auth::id()
        ]);

        Notification::send(User::find(1050), new StockShortageCreated($stock, $request->quantity)
        );

        return Response::api('Stock updated successfully');
    }
}
