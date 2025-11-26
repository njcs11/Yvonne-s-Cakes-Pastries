@extends('layouts.app')

@section('content')
<div class="flex flex-col bg-[#FFF8F5] min-h-screen">

    <div class="flex flex-1 overflow-hidden">

        {{-- Sidebar: Categories --}}
        <aside class="w-64 bg-white shadow-md flex flex-col py-6 px-3 sticky top-0 h-screen">
            <div class="flex-shrink-0">
                <h3 class="text-lg font-bold mb-1 px-2 text-gray-800">Browse Menu</h3>
                <p class="text-sm text-gray-500 px-2 mb-4">Select a category</p>
            </div>

            @php
                $categories = [
                    ['name' => 'Paluwagan', 'image' => '/images/paluwaganA.jpg'],
                    ['name' => 'Food Package', 'image' => '/images/packageA.jpg'],
                    ['name' => 'Food Tray', 'image' => '/images/foodtrayA.jpg'],
                    ['name' => 'Cake', 'image' => '/images/cakeA.jpg'],
                    ['name' => 'Cupcake', 'image' => '/images/cupcakeA.jpg'],
                ];
            @endphp

            <div id="category-list" class="flex-1 overflow-y-auto custom-scrollbar pr-1">
                <div class="category-container flex flex-col space-y-4">
                    @foreach ($categories as $category)
                        <button 
                            class="category-btn flex flex-col items-center text-center bg-white rounded-xl shadow-md hover:shadow-lg hover:bg-[#FFEFEA] transition p-3"
                            data-category="{{ strtolower(str_replace(' ', '', $category['name'])) }}">
                            <img src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}" class="w-20 h-20 rounded-lg object-cover mb-2">
                            <span class="font-semibold text-gray-700 text-sm">{{ $category['name'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto px-8 py-6 bg-[#FFF8F5]" style="padding-bottom: 100px;" id="catalog-section">
            
            <h2 class="text-2xl font-bold mb-6">Paluwagan Packages</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($packages as $package)
                    <div class="product-card bg-white rounded-xl shadow-md hover:shadow-lg transition p-4 cursor-pointer"
                        onclick="openPaluwaganModal({
                            id: {{ $package->id }},
                            name: '{{ $package->name }}',
                            imageURL: '{{ asset($package->image) }}',
                            descriptionList: {!! json_encode(explode("\n", $package->description)) !!},
                            totalAmount: {{ $package->package_amount }},
                            durationMonths: {{ $package->total_months }}
                        })"
                    >
                        <img src="{{ asset($package->image) }}" alt="{{ $package->name }}" class="rounded-lg mb-4 w-full h-40 object-cover">
                        <h3 class="text-lg font-semibold mb-1">{{ $package->name }}</h3>
                        <ul class="list-disc ml-6 text-gray-500 mb-2">
                            @foreach(explode("\n", $package->description) as $item)
                                @if(trim($item) !== '')
                                    <li>{{ $item }}</li>
                                @endif
                            @endforeach
                        </ul>
                        <p class="text-gray-800 font-semibold">
                            ₱ {{ number_format($package->package_amount, 2) }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-full">No Paluwagan packages joined yet.</p>
                @endforelse
            </div>
        </main>
    </div>

    {{-- Fixed Cart Section --}}
    <div class="fixed bottom-0 left-0 right-0 bg-[#FBD2CF] border-t border-[#F3B9B5] px-8 py-7 flex justify-between items-center shadow-[0_-2px_10px_rgba(0,0,0,0.1)] rounded-t-xl z-50">
        <a href="{{ route('cart') }}" class="flex items-center gap-2 text-gray-700 font-medium hover:underline">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8h13.2M7 13l1.6-8M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
            </svg>
            <span>Show Cart</span>
            <span id="cart-count" class="text-sm text-gray-500 ml-2">{{ count(session('cart', [])) }} item(s) added</span>
        </a>

        <div>
            <a href="{{ route('checkout') }}"
                class="bg-[#FF1493] hover:bg-[#FF69B4] text-white px-6 py-3 rounded-lg font-semibold shadow-md transition-all duration-200">
                Order and Pay
            </a>
        </div>
    </div>

    {{-- Include Modals --}}
    @include('user.modals.paluwagan')
</div>
@endsection
