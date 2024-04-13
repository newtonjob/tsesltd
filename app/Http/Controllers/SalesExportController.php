<?php

namespace App\Http\Controllers;

use App\Exports\SalesReportExport;
use Illuminate\Http\Request;

class SalesExportController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->authorize('manage-report');

        return new SalesReportExport;
    }
}
