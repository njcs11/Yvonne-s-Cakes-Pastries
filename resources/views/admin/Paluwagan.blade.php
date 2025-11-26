@extends('layouts.admin')

@section('title', 'Paluwagan')

@section('content')
<div class="px-4 sm:px-10 py-8">

    {{-- Page Header --}}
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Paluwagan Management</h1>
    <p class="text-gray-500 -mt-1 mb-8 text-sm sm:text-base">Monitor and manage paluwagan orders</p>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5 mb-8">

        <div class="border border-pink-200 bg-pink-50 p-5 sm:p-6 rounded-xl">
            <p class="text-gray-600 font-semibold text-sm sm:text-base">Active Subscription</p>
            <div class="flex items-center justify-between mt-2">
                <p class="text-2xl sm:text-3xl font-bold">0</p>
                <span class="text-blue-600 text-xl sm:text-2xl">📄</span>
            </div>
        </div>

        <div class="border border-pink-200 bg-pink-50 p-5 sm:p-6 rounded-xl">
            <p class="text-gray-600 font-semibold text-sm sm:text-base">Collected Revenue</p>
            <div class="flex items-center justify-between mt-2">
                <p class="text-2xl sm:text-3xl font-bold">0</p>
                <span class="text-green-600 text-xl sm:text-2xl">✔</span>
            </div>
        </div>

        <div class="border border-pink-200 bg-pink-50 p-5 sm:p-6 rounded-xl">
            <p class="text-gray-600 font-semibold text-sm sm:text-base">Expected Revenue</p>
            <div class="flex items-center justify-between mt-2">
                <p class="text-2xl sm:text-3xl font-bold">₱0</p>
                <span class="text-purple-600 text-xl sm:text-2xl">📅</span>
            </div>
        </div>

        <div class="border border-pink-200 bg-pink-50 p-5 sm:p-6 rounded-xl">
            <p class="text-gray-600 font-semibold text-sm sm:text-base">Late Payments</p>
            <div class="flex items-center justify-between mt-2">
                <p class="text-2xl sm:text-3xl font-bold">0</p>
                <span class="text-red-600 text-xl sm:text-2xl">⚠️</span>
            </div>
        </div>

    </div>

    {{-- Search + Filters --}}
    <div class="border rounded-xl border-pink-200 p-5">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            {{-- Search Bar --}}
            <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 w-full md:w-1/2">
                <span class="text-gray-400 mr-2 text-sm sm:text-base">🔍</span>
                <input 
                    type="text" 
                    class="w-full outline-none text-sm sm:text-base" 
                    placeholder="Search by package name or ID..."
                >
            </div>

            {{-- Filters --}}
            <div class="flex gap-2 flex-wrap">
                <button class="px-4 py-2 bg-black text-white rounded-lg text-sm sm:text-base">All (0)</button>
                <button class="px-4 py-2 border border-pink-300 rounded-lg text-sm sm:text-base">On Track (0)</button>
                <button class="px-4 py-2 border border-pink-300 rounded-lg text-sm sm:text-base">Late (0)</button>
                <button class="px-4 py-2 border border-pink-300 rounded-lg text-sm sm:text-base">Fully Paid (0)</button>
            </div>

        </div>
    </div>

    {{-- Subscription Table --}}
    <div class="border border-pink-200 mt-8 rounded-xl p-6">

        <h2 class="text-lg sm:text-xl font-semibold text-gray-800">Subscription</h2>
        <p class="text-gray-500 text-xs sm:text-sm mb-4">0 subscription found</p>

        {{-- Table (Scrollable on Mobile) --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm sm:text-base min-w-max">
                <thead class="border-b text-gray-600">
                    <tr>
                        <th class="py-2 px-3 whitespace-nowrap">Subscription ID</th>
                        <th class="py-2 px-3 whitespace-nowrap">Package</th>
                        <th class="py-2 px-3 whitespace-nowrap">Progress</th>
                        <th class="py-2 px-3 whitespace-nowrap">Monthly</th>
                        <th class="py-2 px-3 whitespace-nowrap">Paid</th>
                        <th class="py-2 px-3 whitespace-nowrap">Remaining</th>
                        <th class="py-2 px-3 whitespace-nowrap">Due Date</th>
                        <th class="py-2 px-3 whitespace-nowrap">Status</th>
                        <th class="py-2 px-3 whitespace-nowrap">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Empty State --}}
                    <tr>
                        <td colspan="9" class="py-10 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <span class="text-4xl mb-2">📄</span>
                                No subscription found
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection