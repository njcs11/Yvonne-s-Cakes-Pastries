<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ProductLoader;

class CatalogPageController extends Controller
{
    public function index()
<<<<<<< Updated upstream
{
    $allProducts = ProductLoader::loadAllProducts();
    return view('user.CatalogPage', ['products' => $allProducts]);
}

=======
    {
        // Fetch products with their product type and servings
        $products = DB::table('product')
            ->leftJoin('producttype', 'product.productTypeID', '=', 'producttype.productTypeID')
            ->leftJoin('serving', 'product.productID', '=', 'serving.productID')
            ->select(
                'product.productID',
                'product.name',
                'product.description',
                'product.imageURL',
                'producttype.productType',
                'serving.size',
                'serving.price'
            )
            ->get()
            ->groupBy('productID') 
            ->map(function ($group) {
                $first = $group->first();

                $servings = $group->isEmpty()
                    ? []
                    : $group->map(function ($g) {
                        return [
                            'size' => $g->size,
                            'price' => $g->price
                        ];
                    })->toArray();

                return [
                    'id' => $first->productID,
                    'name' => $first->name,
                    'description' => $first->description,
                    'descriptionList' => $first->description
                        ? array_filter(array_map('trim', explode("\n", $first->description)))
                        : [],
                    'imageURL' => $first->imageURL,
                    'productType' => strtolower(str_replace(' ', '', $first->productType)),
                    'servings' => $servings ?? []
                ];
            })->values();

        // Fetch paluwagan packages
        $paluwaganPackages = DB::table('paluwaganpackage')
            ->select(
                'packageID as id',
                'packageName as name',
                'description',
                'totalAmount',
                'durationMonths',
                'monthlyPayment',
                'image',
                DB::raw("'paluwagan' as productType")
            )
            ->get()
            ->map(function ($pkg) {
                return [
                    'id' => $pkg->id,
                    'name' => $pkg->name,
                    'description' => $pkg->description,
                    'descriptionList' => $pkg->description
                        ? array_filter(array_map('trim', explode("\n", $pkg->description)))
                        : [],
                    'imageURL' => 'images/' . $pkg->image,  
                    'productType' => 'paluwagan',
                    'totalAmount' => $pkg->totalAmount,
                    'durationMonths' => $pkg->durationMonths,
                    'monthlyPayment' => $pkg->durationMonths > 0
                        ? $pkg->totalAmount / $pkg->durationMonths
                        : $pkg->totalAmount,
                    'servings' => [
                        [
                            'size' => (int)$pkg->durationMonths, // ensure numeric
                            'price' => $pkg->totalAmount
                        ]
                    ]
                ];
            });

        $allProducts = $products->merge($paluwaganPackages);

        return view('user.CatalogPage', ['products' => $allProducts]);
    }
>>>>>>> Stashed changes
}