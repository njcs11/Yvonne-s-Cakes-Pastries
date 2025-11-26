<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartPageController extends Controller
{
    // Show cart page
    public function index()
    {
        $cart = session('cart', []);
        return view('user.CartPage', compact('cart'));
    }

    // Add product to cart
    public function add(Request $request)
    {
        $cart = session('cart', []);

        $product = [
            'productID' => $request->productID ?? $request->id,   // store numeric productID
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
            'image' => $request->image,
            'customization' => $request->customization ?? null,
        ];

        // Use productID consistently as the key
        $key = $product['productID'];
        if (isset($cart[$key])) {
            // If customization differs, treat as new item
            if ($cart[$key]['customization'] !== $product['customization']) {
                $uniqueKey = $key . '-' . md5(json_encode($product['customization']));
                $cart[$uniqueKey] = $product;
            } else {
                $cart[$key]['quantity'] += $product['quantity'];
            }
        } else {
            $cart[$key] = $product;
        }

        session(['cart' => $cart]);

        // Return total quantity in cart
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Update quantity
    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;

        if (!isset($cart[$id])) {
            return redirect()->back()->with('error', 'Product not found in cart.');
        }

        if ($request->action === 'increase') {
            $cart[$id]['quantity'] += 1;
        } elseif ($request->action === 'decrease' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity'] -= 1;
        }

        session(['cart' => $cart]);

        return redirect()->back();
    }

    // Remove a product
    public function remove(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->back();
    }

    // Clear cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}
