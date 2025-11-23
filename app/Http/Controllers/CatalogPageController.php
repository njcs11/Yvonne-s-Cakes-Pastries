<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogPageController extends Controller
{
    public function index()
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
            ->groupBy('productID') // group by product
            ->map(function ($group) {
                $first = $group->first();

                // Collect all serving options for this product (or empty array if none)
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
                    'servings' => $servings
                ];
            })->values();

        return view('user.CatalogPage', compact('products'));
    }
}
