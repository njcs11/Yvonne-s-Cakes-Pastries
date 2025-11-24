<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPaluwaganController extends Controller
{
    public function index()
    {
        return view('admin.paluwagan');
    }
}
