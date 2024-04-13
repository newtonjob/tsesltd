<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Facades\App\Support\Pdf;
use App\Models\User;

class OrderInvoiceController extends Controller
{
    public function show(Request $request, Order $order)
    {
        $this->authorize('view', $order);

        if ($request->has('tses')){
            config(['pdf.watermark' => cloudinary_url('tses/logo/tses-logo.jpg')]);
        }

        return Pdf::view('orders.invoice.show', compact(['order']))->stream();
    }
}
