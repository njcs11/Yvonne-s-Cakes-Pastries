@extends('layouts.admin')

@section('title', 'Sales Report')

@section('content')
<main>
    <div class="px-10 py-8">
        <!-- Title -->
        <h2 class="text-4xl font-bold text-gray-800">Sales Reporting</h2>
        <p class="text-gray-500 mt-1 mb-6">Manage and track all customer orders</p>

        <!-- Report Period -->
        <div class="border rounded-xl p-6 bg-white mb-8">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-gray-600">
                    <span>🔻</span>
                    <span class="font-medium">Report Period:</span>
                </div>

                <button class="px-6 py-2 bg-pink-500 text-white rounded-lg">Daily</button>
                <button class="px-6 py-2 border border-gray-300 rounded-lg">Weekly</button>
                <button class="px-6 py-2 border border-gray-300 rounded-lg">Monthly</button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

            <div class="p-6 border rounded-xl">
                <p class="text-sm text-gray-500">Total Orders</p>
                <h3 class="text-3xl font-bold mt-1">0</h3>
                <p class="text-gray-400">Today</p>
            </div>

            <div class="p-6 border rounded-xl">
                <p class="text-sm text-gray-500">Total Revenue</p>
                <h3 class="text-3xl font-bold mt-1">₱0</h3>
                <p class="text-gray-400">Today</p>
            </div>

            <div class="p-6 border rounded-xl">
                <p class="text-sm text-gray-500">Completed Orders</p>
                <h3 class="text-3xl font-bold mt-1">0</h3>
                <p class="text-gray-400">Today</p>
            </div>

            <div class="p-6 border rounded-xl">
                <p class="text-sm text-gray-500">Avg Order Value</p>
                <h3 class="text-3xl font-bold mt-1">₱0</h3>
                <p class="text-gray-400">Today</p>
            </div>

        </div>

        <!-- Tabs Bar -->
        <div class="w-full flex bg-gray-100 text-gray-600 font-medium rounded-xl overflow-hidden">
            <button class="flex-1 p-3 text-center hover:bg-gray-200">Sales Summary</button>
            <button class="flex-1 p-3 text-center hover:bg-gray-200">By Category</button>
            <button class="flex-1 p-3 text-center hover:bg-gray-200">By Payment</button>
            <button class="flex-1 p-3 text-center hover:bg-gray-200">Product Performance</button>
        </div>

        <!-- Empty State / Placeholder -->
        <div class="my-6 flex items-center justify-center text-gray-400 border rounded-xl">
            No data available yet
        </div>
    </div>
</main>
@endsection
