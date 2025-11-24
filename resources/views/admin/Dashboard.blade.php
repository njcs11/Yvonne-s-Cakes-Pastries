@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white h-screen overflow-y-auto p-4">  {{-- ✅ Full-page scrollable --}}

    <main class="max-w-full mx-auto">  {{-- Prevent width overflow --}}
        
        <h2 class="text-3xl font-bold mb-2">Dashboard Overview</h2>
        <p class="text-gray-600 mb-8">Welcome to your Admin Dashboard</p>

        <!-- Cards Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10"> {{-- ✅ Responsive grid --}}
            <div class="bg-[#FFF7F7] border border-pink-200 p-5 rounded-lg shadow-sm">
                <p class="text-gray-600">Total Revenue</p>
                <h3 class="text-2xl font-bold">₱{{ $totalRevenue ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">From {{ $completedOrders ?? 0 }} completed orders</p>
            </div>

            <div class="bg-[#FFF7F7] border border-pink-200 p-5 rounded-lg shadow-sm">
                <p class="text-gray-600">Pending Orders</p>
                <h3 class="text-2xl font-bold">{{ $pendingOrders ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">{{ $pendingOrders ?? 0 }} orders in progress</p>
            </div>

            <div class="bg-[#FFF7F7] border border-pink-200 p-5 rounded-lg shadow-sm">
                <p class="text-gray-600">Active Paluwagan</p>
                <h3 class="text-2xl font-bold">₱{{ $activePaluwagan ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">{{ $collected ?? 0 }} collected</p>
            </div>

            <div class="bg-[#FFF7F7] border border-pink-200 p-5 rounded-lg shadow-sm">
                <p class="text-gray-600">Low Stock Items</p>
                <h3 class="text-2xl font-bold">{{ $lowStock ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Requires attention</p>
            </div>
        </div>

        <!-- Content grid: Recent Orders + Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> {{-- Responsive --}}
            
            <!-- Recent Orders -->
            <div class="bg-white border border-pink-200 p-8 rounded-lg h-80 overflow-y-auto"> {{-- Scrollable --}}
                <h3 class="text-2xl font-bold text-gray-700 mb-4">Recent Orders</h3>

                @if($recentOrders->count() == 0)
                    <p class="text-gray-500">No orders yet</p>
                @else
                    <div class="overflow-x-auto"> {{-- Horizontal scroll for mobile --}}
                        <table class="min-w-full text-left text-gray-700">
                            <thead class="bg-gray-100 sticky top-0"> {{-- Fixed header --}}
                                <tr class="border-b">
                                    <th class="py-2">Order ID</th>
                                    <th class="py-2">Customer</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Total</th>
                                    <th class="py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-2">#{{ $order->orderID }}</td>
                                        <td class="py-2">{{ $order->customerID }}</td>
                                        <td class="py-2">{{ $order->status }}</td>
                                        <td class="py-2">₱{{ number_format($order->totalAmount, 2) }}</td>
                                        <td class="py-2">{{ $order->orderDate }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white border border-pink-200 p-8 rounded-lg lg:col-span-1">
                <h3 class="text-xl font-bold mb-2">Quick Actions</h3>
                <p class="text-gray-500 mb-5">Common administrative task</p>

                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 border border-pink-200 rounded-lg">
                        <span>Pending Orders</span><span class="font-bold">{{ $pendingOrders }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 border border-pink-200 rounded-lg">
                        <span>Low Stock Products</span><span class="font-bold">{{ $lowStock }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 border border-pink-200 rounded-lg">
                        <span>Total Customers</span><span class="font-bold">{{ $totalCustomers }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 border border-pink-200 rounded-lg">
                        <span>Total Products</span><span class="font-bold">{{ $totalProducts }}</span>
                    </div>
                </div>
            </div>

        </div>

    </main>

</div>
@endsection
