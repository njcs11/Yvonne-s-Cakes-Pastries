@extends('layouts.app')

@section('no-footer')
@endsection

@section('content')
<div class="bg-[#FFF8F5] min-h-screen flex justify-center py-10 px-4 overflow-y-auto">
    <div class="w-full max-w-5xl">

        {{-- Header --}}
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">My Paluwagan</h2>
                <p class="text-gray-600 text-sm">
                    Manage your installment plans and payment schedules
                </p>
            </div>
            <a href="/catalog" class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded font-semibold text-sm">
                Go to Catalog
            </a>
        </div>

        {{-- Features --}}
        @php
            $features = [
                ['icon' => '💸', 'title' => 'Fixed Monthly Payment', 'desc' => 'Pay required amount on every due date', 'color' => 'text-green-600'],
                ['icon' => '📅', 'title' => 'Flexible Entry', 'desc' => 'Join at any month available in paluwagan', 'color' => 'text-purple-600'],
                ['icon' => '✅', 'title' => 'Premium Quality', 'desc' => 'High quality and trusted food', 'color' => 'text-green-700'],
            ];
        @endphp

        <div class="bg-blue-50 border border-blue-100 rounded-md shadow-sm p-6 grid md:grid-cols-3 gap-6 mb-8">
            @foreach ($features as $feature)
                <div class="text-center">
                    <div class="{{ $feature['color'] }} text-xl mb-2">{{ $feature['icon'] }}</div>
                    <h3 class="font-semibold text-gray-900">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- Simulate dynamic paluwagan orders --}}
        @php
            $orders = [
                [
                    'name' => 'Holiday Package',
                    'desc' => 'Crispy and juicy chicken',
                    'start' => 'Month 12',
                    'monthly' => 500,
                    'status' => 'On Track',
                    'months_paid' => 0,
                    'total_months' => 10,
                    'package_amount' => 5000,
                    'total_paid' => 0,
                    'next_payment' => '11/11/2025',
                ],
                [
                    'name' => 'Snack Box',
                    'desc' => 'Delicious assorted snacks',
                    'start' => 'Month 5',
                    'monthly' => 300,
                    'status' => 'Overdue',
                    'months_paid' => 2,
                    'total_months' => 6,
                    'package_amount' => 1800,
                    'total_paid' => 600,
                    'next_payment' => '11/20/2025',
                ],
                // Add more simulated orders here if needed
            ];
        @endphp

        @forelse ($orders as $order)
<div class="border border-red-200 bg-white rounded-md shadow-sm p-6 relative mb-6">
    <div class="flex justify-between items-start mb-2">
        <div>
            <h3 class="font-bold text-lg text-gray-900 flex items-center gap-2">
                <span class="text-green-600">✔</span> {{ $order->name }}
            </h3>
            <p class="text-sm text-gray-600">{{ $order->desc }}</p>
            <p class="text-sm text-gray-600 mt-1">
                <span class="font-semibold">Started:</span> {{ $order->startDate ?? 'N/A' }} • Monthly: <span class="font-semibold">₱{{ $order->monthly }}</span>
            </p>
        </div>
        <span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full font-medium">{{ $order->status }}</span>
    </div>
    {{-- Add progress and remaining logic as needed --}}
</div>
@empty
<p class="text-gray-500 text-center py-10">You have no active paluwagan orders. <a href="/catalog" class="text-orange-500 underline">Go to Catalog</a> to place an order.</p>
@endforelse


    </div>
</div>

@include('partials.components.paluwagan-modals')

@push('scripts')
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>
@endpush
@endsection
