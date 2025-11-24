<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminSalesReportController extends Controller
{
    public function index()
    {
        return view('admin.salesreport');
    }
}
