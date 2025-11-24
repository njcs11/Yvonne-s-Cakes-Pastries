<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PaluwaganEntry;
use App\Models\PaluwaganSchedule;
use App\Models\Ingredient;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ✔ Total Revenue from COMPLETED orders
        $totalRevenue = Order::where('status', 'Completed')->sum('totalAmount');

        // ✔ Count completed orders
        $completedOrders = Order::where('status', 'Completed')->count();

        // ✔ Pending Orders
        $pendingOrders = Order::where('status', 'Pending')->count();

        // ✔ Active Paluwagan total collected
        $activePaluwagan = PaluwaganSchedule::where('status', 'Active')->sum('amountPaid');

        // ✔ Total collected payments
        $collected = PaluwaganSchedule::where('isPaid', 1)->sum('amountPaid');

        // ✔ Low stock items (ingredients qty < threshold)
        $lowStock = Ingredient::where('quantityOnHand', '<', 10)->count();

        // ✔ Total Customers
        $totalCustomers = Customer::count();

        // ✔ Total Products
        $totalProducts = Product::count();

        // ✔ Recent Orders (latest 5)
        $recentOrders = Order::orderBy('orderDate', 'DESC')
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'completedOrders',
            'pendingOrders',
            'activePaluwagan',
            'collected',
            'lowStock',
            'totalCustomers',
            'totalProducts',
            'recentOrders'
        ));
    }
}
