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
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
            'image' => $request->image,
            'customization' => $request->customization ?? null,
        ];

        // If product already in cart
        if (isset($cart[$product['id']])) {
            // If customization differs, treat as new item
            if ($cart[$product['id']]['customization'] !== $product['customization']) {
                $uniqueKey = $product['id'] . '-' . md5(json_encode($product['customization']));
                $cart[$uniqueKey] = $product;
            } else {
                $cart[$product['id']]['quantity'] += $product['quantity'];
            }
        } else {
            $cart[$product['id']] = $product;
        }

        session(['cart' => $cart]);

        // Return total quantity in cart
        $cartCount = array_sum(array_column($cart, 'quantity'));

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    // Update quantity (+ / -)
    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;

        if (!isset($cart[$id])) {
            return redirect()->back()->with('error', 'Product not found in cart.');
        }

        // Update the quantity based on action
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

        // If product exists in the cart, remove it
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->back();
    }

    // Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }
}