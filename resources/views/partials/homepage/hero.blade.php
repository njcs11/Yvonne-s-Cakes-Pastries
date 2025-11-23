<section class="relative h-[80vh] flex items-center justify-center text-center overflow-hidden">
    <img src="{{ asset('images/Hero_Background_overlay.webp') }}" 
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-20 text-white max-w-2xl px-4">
        <h1 class="text-4xl md:text-5xl text-pink-300 font-semibold mb-4">
            Yvonne's Cakes & Pastries
        </h1>
        <p class="text-lg md:text-xl mb-6 py-4">Satisfy your cravings! Get exclusive deals and delicious food delivered to your door.</p>

        @php $user = session('logged_in_user'); @endphp

        @if(!$user)
            <a href="#products" class="bg-pink-400 hover:bg-pink-500 px-8 py-3 rounded-lg text-lg">
                Browse Products
            </a>
        @else
            <a href="{{ route('catalog') }}" class="bg-yellow-400 text-black px-8 py-3 rounded-lg text-lg">
                Order Now
            </a>
        @endif
    </div>
</section>
