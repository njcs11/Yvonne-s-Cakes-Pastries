<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrdersPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

 $customer = session('logged_in_user');

    if (!$customer) {
        return redirect()->route('login')->with('error', 'Please log in to view your orders.');
    }

    $userID = $customer['customerID'];
    
        // Get all orders of the logged-in user with their items & products
        $orders = Order::where('customerID', $userID)
            ->with(['orderItems.product'])
            ->orderBy('orderDate', 'desc')
            ->get();

        return view('user.OrdersPage', compact('orders'));
    }
}
