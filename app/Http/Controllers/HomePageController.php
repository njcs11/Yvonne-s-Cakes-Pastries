<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        // Load categories - use the correct column name 'producttype'
        $categories = ProductType::orderBy('producttype')->get();

        // Product filtering
        $query = Product::query();

        if ($request->filled('type')) {
            $query->where('productTypeID', $request->type);
        }

        // Featured products
        $featuredProducts = $query->orderBy('productID', 'desc')->take(8)->get();

        return view('user.HomePage', compact('categories', 'featuredProducts'));
    }
}
