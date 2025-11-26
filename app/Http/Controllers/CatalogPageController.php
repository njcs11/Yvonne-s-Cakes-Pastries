<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ProductLoader;

class CatalogPageController extends Controller
{
    public function index()
{
    $allProducts = ProductLoader::loadAllProducts();
    return view('user.CatalogPage', ['products' => $allProducts]);
}

}