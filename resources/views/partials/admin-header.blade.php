<header class="bg-white border-b border-pink-200 px-8 p-6 flex justify-between items-center">
    <h1 class="text-2xl font-serif text-pink-500">Yvonne's Cakes & Pastries</h1>
    <div class="text-gray-700">
        Welcome, 
        @if(session('admin_logged_in')) 
            <!-- Dynamically display admin's username -->
            <span class="font-semibold text-pink-500">{{ session('admin_username') }}</span>
        @else 
            <span class="font-semibold text-pink-500">Guest</span>
        @endif
    </div>
</header>
