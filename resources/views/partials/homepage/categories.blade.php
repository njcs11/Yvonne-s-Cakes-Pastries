<section class="py-6 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex space-x-4 justify-center overflow-x-auto pb-2 no-scrollbar">

            {{-- ALL CATEGORY --}}
            <a href="{{ route('home') }}#products"
               class="flex-shrink-0 bg-pink-100 hover:bg-pink-200 text-pink-700 px-5 py-3
                      rounded-full font-medium shadow-sm flex items-center space-x-2">
                <i class="{{ $categoryIcons['all'] ?? 'fas fa-tag' }}"></i>
                <span>All</span>
            </a>

            {{-- DB CATEGORIES --}}
            @foreach ($categories as $cat)
                @php
                    $iconClass = $categoryIcons[strtolower($cat->productType)] ?? 'fas fa-tag';
                @endphp

                <a href="{{ route('home', ['type' => $cat->productTypeID]) }}#products"
                   class="flex-shrink-0 bg-pink-100 hover:bg-pink-200 text-pink-700 px-5 py-3
                          rounded-full font-medium shadow-sm flex items-center space-x-2">
                    <i class="{{ $iconClass }}"></i>
                    <span>{{ $cat->productType }}</span>
                </a>
            @endforeach

        </div>
    </div>
</section>
