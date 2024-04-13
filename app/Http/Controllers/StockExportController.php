<?php

namespace App\Http\Controllers;

use App\Exports\StockReportExport;
use Illuminate\Http\Request;

class StockExportController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('manage-report');

        return new StockReportExport();
    }
}
