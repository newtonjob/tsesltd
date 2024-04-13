<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
    public function index(ReportRequest $request)
    {
        return view('reports.index', $request->data());
    }
}
