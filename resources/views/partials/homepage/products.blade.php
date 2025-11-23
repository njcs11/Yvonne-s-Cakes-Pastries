<section id="products" class="py-16 bg-gray-100">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-center mb-10">Menu</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      @foreach ($featuredProducts as $product)
          <div 
            onclick="window.location.href='{{ session('logged_in_user') ? route('catalog') : route('register') }}'"
            class="bg-white rounded-lg shadow hover:shadow-lg cursor-pointer overflow-hidden transition">
              <img src="{{ asset($product['imageURL']) }}" class="w-full h-40 object-cover">

              <div class="p-4">
                  <h3 class="font-semibold text-lg text-center">{{ $product['name'] }}</h3>
                  <p class="text-pink-600 font-semibold">{{ $product['price'] }}</p>
              </div>
          </div>
      @endforeach

    </div>
  </div>
</section>
