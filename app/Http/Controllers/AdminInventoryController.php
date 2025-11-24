<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminInventoryController extends Controller
{
    public function index()
    {
        return view('admin.inventory');
    }
}