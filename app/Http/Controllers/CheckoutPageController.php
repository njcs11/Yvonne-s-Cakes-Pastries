<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutPageController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $downpayment = $subtotal * 0.5;
        $balance = $subtotal - $downpayment;

        return view('user.CheckoutPage', compact('cart', 'subtotal', 'downpayment', 'balance'));
    }

   public function placeOrder(Request $request)
{
    $user = session('logged_in_user');
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
    }

    $customerID = $user['customerID'];

    $cart = session('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart')->with('error', 'Your cart is empty.');
    }

    $validated = $request->validate([
        'deliveryAddress' => 'required|string|max:255',
        'remarks' => 'nullable|string|max:200',
        'deliveryDate' => 'nullable|date',
        'payment' => 'required|string|in:gcash,cod',
        'paymentProof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
    ]);

    DB::transaction(function() use ($validated, $cart, $customerID) {
        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Create order
        $order = Order::create([
            'customerID' => $customerID,
            'totalAmount' => $totalAmount,
            'deliveryAddress' => $validated['deliveryAddress'],
            'remarks' => $validated['remarks'] ?? '',
            'paymentStatus' => 'PENDING',
            'deliveryDate' => $validated['deliveryDate'] ?? now(),
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'orderID' => $order->orderID,
                'productID' => $request->productID ?? $request->id,
                'price' => $item['price'],
                'qty' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');
    });

    return redirect()->route('catalog')->with('success', 'Your order has been placed successfully!');
}

}
