<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\User;
use App\Notifications\StockShortageCreated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class StockController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('manage-stock');

        $request->validate(['product_id' => 'required', 'quantity.*' => 'numeric']);

        foreach ($request->collect('quantity')->filter() as $location_id => $quantity) {
            Stock::firstOrCreate([
                'product_id'  => $request->product_id,
                'location_id' => $location_id,
            ])->update(['quantity' => $quantity]);
        }

        return Response::api('Stock added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function destroy(Request $request, Stock $stock)
    {
        $request->validate([
            'quantity' => "required|numeric|min:1|max:{$stock->quantity}",
        ]);

        $stock->update(['quantity' => -$request->quantity]);

        Notification::send(
            User::notifiable()->admin()->get()->filter->can('manage-stock'),
            new StockShortageCreated($stock, $request->quantity)
        );

        return Response::api('Stock updated successfully');
    }
}
