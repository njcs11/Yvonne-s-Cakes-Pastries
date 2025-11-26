@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div 
    x-data="{ 
        showDetails:false, 
        showAdd:false,
        user: {}  
    }" 
    class="px-4 md:px-10 py-6"
>

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3">
        <div>
<<<<<<< Updated upstream
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">User Management</h1>
            <p class="text-gray-500 text-sm md:text-base">{{ $users->total() }} registered users</p>
=======
            <h1 class="text-4xl font-bold text-gray-800">User Management</h1>
            <p class="text-gray-500">{{ $users->total() }} registered users</p>
>>>>>>> Stashed changes
        </div>

        <button 
            @click="showAdd = true"
            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 w-full md:w-auto">
            Add Admin
        </button>
    </div>

    {{-- Search Bar --}}
    <div class="mt-6">
        <form method="GET" action="{{ route('admin.users') }}">
            <input 
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Search users by name or username..."
                class="w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-pink-300 focus:outline-none"
            >
        </form>
    </div>

    {{-- Users List --}}
    <div class="mt-6 space-y-4">
<<<<<<< Updated upstream
        @forelse($users as $u)
            <div class="bg-white border border-pink-200 rounded-xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <p class="font-semibold text-gray-800">{{ $u->username }}</p>
                    <p class="text-gray-600">User ID: {{ $u->userID }}</p>
                    <p class="text-gray-600">Role ID: {{ $u->roleID }}</p>
                    <p class="text-gray-600">Status: {{ $u->status == 1 ? 'Active' : 'Inactive' }}</p>
                </div>

                <button 
                    @click="showDetails = true; user = {{ $u->toJson() }}"
                    class="px-4 py-2 border border-gray-400 rounded-lg hover:bg-gray-100 w-full md:w-auto">
=======
        @forelse($users as $user)
            <div class="bg-white border border-pink-200 rounded-xl p-4 flex items-center justify-between">
                <div class="flex gap-4">
                    <div>
                        <p class="font-semibold text-gray-800">{{ $user->username }}</p>
                        <p class="text-gray-600">User ID: {{ $user->userID }}</p>
                        <p class="text-gray-600">Role ID: {{ $user->roleID }}</p>
                        <p class="text-gray-600">Status: {{ $user->status == 1 ? 'Active' : 'Inactive' }}</p>
                    </div>
                </div>

                <button 
                    @click="showDetails = true; user = {{ $user->toJson() }}"
                    class="px-4 py-2 border border-gray-400 rounded-lg hover:bg-gray-100">
>>>>>>> Stashed changes
                    View Details
                </button>
            </div>
        @empty
<<<<<<< Updated upstream
            <p class="text-gray-500">No users yet.</p>
=======
            <p class="text-gray-500">No users found.</p>
>>>>>>> Stashed changes
        @endforelse

        {{-- Pagination --}}
        <div class="mt-4">
<<<<<<< Updated upstream
            {{ $users->links() }}
        </div>
    </div>

    {{-- USER DETAILS MODAL --}}
    <div 
        x-show="showDetails"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-3"
        x-cloak
    >
        <div class="bg-white rounded-xl w-full md:w-[600px] p-6 relative">
            <button 
                @click="showDetails = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-black">
                ✕
            </button>

            <h2 class="text-xl md:text-2xl font-semibold mb-1">User Details</h2>
            <p class="text-gray-500 mb-6 text-sm md:text-base">
                Complete information about <span x-text="user.username"></span>
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="font-semibold">User ID</p>
                    <p x-text="user.userID" class="text-gray-700"></p>
                </div>

                <div>
                    <p class="font-semibold">Username</p>
                    <p x-text="user.username" class="text-gray-700"></p>
                </div>

                <div class="md:col-span-2">
                    <p class="font-semibold">Role ID</p>
                    <p x-text="user.roleID" class="text-gray-700"></p>
                </div>

                <div class="md:col-span-2">
                    <p class="font-semibold">Status</p>
                    <span 
                        class="px-3 py-1 rounded-full text-sm"
                        :class="user.status == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'"
                        x-text="user.status == 1 ? 'Active' : 'Inactive'">
                    </span>
                </div>
            </div>

            {{-- Activate / Deactivate Button --}}
            <div class="mt-4">
                <button 
                    @click="
                        fetch('{{ url('/admin/users/toggle-status') }}/' + user.userID, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => { user.status = data.status; })
                    "
                    class="px-4 py-2 rounded-lg text-white"
                    :class="user.status == 1 ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-400 cursor-not-allowed'"
                >
                    <span x-text="user.status == 1 ? 'Deactivate User' : 'Inactive'"></span>
                </button>
            </div>
        </div>
    </div>

    {{-- ADD ADMIN MODAL --}}
=======
            {{ $users->withQueryString()->links() }}
        </div>
    </div>

    <!-- ADD ADMIN MODAL -->
>>>>>>> Stashed changes
    <div 
        x-show="showAdd"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-3"
        x-cloak
    >
<<<<<<< Updated upstream
        <div class="bg-white rounded-xl w-full md:w-[700px] p-6 relative">
=======
        <div class="bg-white rounded-xl w-[700px] p-6 relative">
>>>>>>> Stashed changes
            <button 
                @click="showAdd = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-black">
                ✕
            </button>

<<<<<<< Updated upstream
            <h2 class="text-xl md:text-2xl font-semibold">Add Admin</h2>
            <p class="text-gray-500 mb-6 text-sm md:text-base">Please fill in input fields</p>
=======
            <h2 class="text-2xl font-semibold">Add Admin</h2>
            <p class="text-gray-500 mb-6">Fill in the details below</p>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
>>>>>>> Stashed changes

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.storeAdmin') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                <div>
                    <label class="font-medium">Username</label>
                    <input name="username" type="text" value="{{ old('username') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                </div>

                <div class="col-span-2">
                    <label class="font-medium">Select Role</label>
                    <select name="roleID" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->roleID }}" {{ old('roleID') == $role->roleID ? 'selected' : '' }}>{{ $role->roleName }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="font-medium">Password</label>
                    <input name="password" type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                </div>

                <div>
                    <label class="font-medium">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2" required>
                </div>

                <div class="col-span-2 flex justify-end gap-2 mt-4">
                    <button 
                        type="button"
                        @click="showAdd = false"
                        class="px-5 py-2 bg-red-500 text-white rounded-lg">
                        Cancel
                    </button>

                    <button 
                        type="submit"
                        class="px-5 py-2 bg-yellow-500 text-white rounded-lg">
                        Create Account
                    </button>
                </div>
            </form>
<<<<<<< Updated upstream
=======
        </div>
    </div>

    <!-- USER DETAILS MODAL -->
    <div 
        x-show="showDetails"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
        x-cloak
    >
        <div class="bg-white rounded-xl w-[600px] p-6 relative">
            <button 
                @click="showDetails = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-black">
                ✕
            </button>

            <h2 class="text-2xl font-semibold mb-4">User Details</h2>

            <div class="space-y-2">
                <p><strong>Username:</strong> <span x-text="user.username"></span></p>
                <p><strong>User ID:</strong> <span x-text="user.userID"></span></p>
                <p><strong>Role ID:</strong> <span x-text="user.roleID"></span></p>
                <p><strong>Status:</strong> <span x-text="user.status == 1 ? 'Active' : 'Inactive'"></span></p>
            </div>
>>>>>>> Stashed changes
        </div>
    </div>

</div>
@endsection
