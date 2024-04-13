<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Facades\App\Support\Pdf;
use Illuminate\Http\Request;

class TransferWaybillController extends Controller
{
    public function show(Transfer $transfer)
    {
        $this->authorize('manage-stock');

        return Pdf::view('transfers.waybill.show', compact(['transfer']))->stream();
    }
}
