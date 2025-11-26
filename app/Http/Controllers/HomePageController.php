<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Helpers\ProductLoader;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        // Load DB categories
        $categories = ProductType::orderBy('producttype')->get();

        // Remove Paluwagan if it exists in DB to avoid duplicates
        $categories = $categories->reject(function ($c) {
            return strtolower($c->productType) === 'paluwagan';
        });

        // Add virtual Paluwagan category
        $categories->push((object)[
            'productTypeID' => 'paluwagan',
            'productType'   => 'Paluwagan'
        ]);

        // Define icons for categories (FontAwesome classes)
        $categoryIcons = [
            'all' => 'fas fa-th-large',
            'paluwagan' => 'fas fa-hand-holding-usd',
            'cake' => 'fas fa-birthday-cake',
            'cupcake' => 'fas fa-cookie-bite',
            'food package' => 'fas fa-box-open',
            'food tray' => 'fas fa-utensils',
        ];

        // Load normal products
        $allProducts = ProductLoader::loadAllProducts();

        // Remove Paluwagan from normal products
        $allProducts = $allProducts->reject(function ($p) {
            return strtolower($p['productType']) === 'paluwagan';
        });

        // Load Paluwagan packages from DB
        $paluwagan = DB::table('paluwaganpackage')->get()->map(function ($p) {
            return [
                'id' => $p->packageID,
                'name' => $p->packageName,
                'productType' => 'paluwagan',
                'imageURL' => $p->image ? asset('images/paluwagan/' . $p->image) : asset('images/default-paluwagan.jpg'),
                'descriptionList' => explode('|', $p->description ?? ''),
                'servings' => [
                    [
                        'price' => $p->totalAmount,
                        'size'  => $p->durationMonths
                    ]
                ]
            ];
        });

        // Merge normal products with Paluwagan products
        $allProducts = $allProducts->merge($paluwagan);

        // Category filter logic
        $type = $request->filled('type') ? strtolower(trim($request->type)) : null;

        if ($type === 'paluwagan') {
            $featuredProducts = $allProducts->filter(function ($p) {
                return strtolower($p['productType']) === 'paluwagan';
            })->values();
        } elseif ($type && is_numeric($type)) {
            $featuredProducts = $allProducts
                ->where('productTypeID', intval($type))
                ->values();
        } elseif ($type) {
            // Invalid string type filter, return empty
            $featuredProducts = collect();
        } else {
            // Default: show first 8 normal products
            $featuredProducts = $allProducts
                ->reject(function ($p) {
                    return strtolower($p['productType']) === 'paluwagan';
                })
                ->take(8)
                ->values();
        }

        // Pass everything to view
        return view('user.HomePage', compact('categories', 'featuredProducts', 'categoryIcons'));
    }
}
