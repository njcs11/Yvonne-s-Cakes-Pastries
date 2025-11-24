<aside class="h-screen bg-white flex flex-col justify-between border-b border-black">
    <div class="p-6">
      <div class="flex items-center space-x-3 mb-10">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
        <div>
          <h2 class="font-bold text-gray-800">Yvonne’s Admin</h2>
          <p class="text-gray-500 text-sm">erika_yvonne@yahoo.com.ph</p>
        </div>
      </div>

      <nav class="space-y-12 px-5">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
          <span>📊</span><span>Dashboard</span>
        </a>
        <a href="{{ route('admin.orders') }}" class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
          <span>🛒</span><span>Orders</span>
        </a>
        <a href="{{ route('admin.salesreport') }}" class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
          <span>📄</span><span>Reports</span>
        </a>
        <a href="{{ route('admin.users') }}" class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
          <span>👥</span><span>Users</span>
        </a>
        <a href="{{ route('admin.paluwagan') }}" class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
          <span>💰</span><span>Paluwagan</span>
        </a>
        <a href="{{ route('admin.inventory') }}" class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
          <span>📦</span><span>Inventory</span>
        </a>
      </nav>
    </div>

    <form class="mt-auto px-12 pb-6" method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="flex items-center space-x-3 text-gray-700 hover:text-pink-500">
        <span>🚪</span><span>Logout</span>
      </button>
    </form>
  </aside>