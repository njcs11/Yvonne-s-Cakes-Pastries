<section id="products" class="py-16 bg-gray-100">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-center mb-10">Menu</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      @if ($featuredProducts->isEmpty())
        <div class="col-span-full text-center text-gray-500">
            <p>No products available for this category.</p>
        </div>
      @else

        @foreach ($featuredProducts as $product)

            {{-- PALUWAGAN PRODUCT --}}
            @if (strtolower($product['productType']) === 'paluwagan')

                <div class="paluwagan-card bg-white rounded-lg shadow hover:shadow-lg cursor-pointer overflow-hidden transition"
                    data-id="{{ $product['id'] }}"
                    data-name="{{ $product['name'] }}"
                    data-image="{{ $product['imageURL'] }}"
                    data-description='@json($product["descriptionList"] ?? [])'
                    data-servings='@json($product["servings"] ?? [])'>

                    <img src="{{ asset($product['imageURL']) }}" class="w-full h-40 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-center">{{ $product['name'] }}</h3>
                        <p class="text-pink-600 font-semibold">
                          {{ $product['price'] ?? ($product['servings'][0]['price'] ?? 'N/A') }}
                        </p>
                    </div>
                </div>

            @else
            {{-- OTHER PRODUCTS (unchanged) --}}
                <div 
                    onclick="window.location.href='{{ session('logged_in_user') ? route('catalog') : route('register') }}'"
                    class="bg-white rounded-lg shadow hover:shadow-lg cursor-pointer overflow-hidden transition">

                    <img src="{{ asset($product['imageURL']) }}" class="w-full h-40 object-cover">

                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-center">{{ $product['name'] }}</h3>
                        <p class="text-pink-600 font-semibold">
                          {{ $product['price'] ?? ($product['servings'][0]['price'] ?? 'N/A') }}
                        </p>
                    </div>
                </div>
            @endif

        @endforeach

      @endif

    </div>
  </div>
</section>
