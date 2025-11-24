@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div 
    x-data="{ 
        showDetails:false, 
        showAdd:false,
        user: {}   // store user details here
    }" 
    class="px-10 py-6"
>

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">User Management</h1>
            <p class="text-gray-500">0 registered customers</p>
        </div>

        <button 
            @click="showAdd = true"
            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
            Add Admin
        </button>
    </div>

    {{-- Search Bar --}}
    <div class="mt-6">
        <input 
            type="text"
            placeholder="Search users by name, email, or username..."
            class="w-full border border-pink-200 rounded-lg py-2 px-4 focus:ring-pink-300 focus:outline-none"
        >
    </div>

    {{-- Users List --}}
<div class="mt-6 space-y-4">
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
                View Details
            </button>
        </div>
    @empty
        <p class="text-gray-500">No users yet.</p>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>


    <!-- ===================================================== -->
    <!-- USER DETAILS MODAL -->
    <!-- ===================================================== -->
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

            <h2 class="text-2xl font-semibold mb-1">User Details</h2>
            <p class="text-gray-500 mb-6">Complete information about <span x-text="user.name"></span></p>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <p class="font-semibold">User ID</p>
                    <p x-text="user.id" class="text-gray-700"></p>
                </div>

                <div>
                    <p class="font-semibold">Username</p>
                    <p x-text="user.username" class="text-gray-700"></p>
                </div>

                <div>
                    <p class="font-semibold">Full Name</p>
                    <p x-text="user.name ?? (user.first_name + ' ' + user.last_name)" class="text-gray-700"></p>
                </div>

                <div>
                    <p class="font-semibold">Email</p>
                    <p x-text="user.email" class="text-gray-700"></p>
                </div>

                <div>
                    <p class="font-semibold">Contact</p>
                    <p x-text="user.contact ?? 'N/A'" class="text-gray-700"></p>
                </div>

                <div>
                    <p class="font-semibold">Status</p>
                    <span 
                        class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm"
                        x-text="user.status ?? 'Active'">
                    </span>
                </div>

                <div class="col-span-2">
                    <p class="font-semibold">Address</p>
                    <p x-text="user.address ?? 'No address provided'" class="text-gray-700"></p>
                </div>
            </div>
        </div>
    </div>


    <!-- ===================================================== -->
    <!-- ADD ADMIN MODAL -->
    <!-- ===================================================== -->
    <div 
        x-show="showAdd"
        class="fixed inset-0 bg-black/40 flex items-center justify-center z-50"
        x-cloak
    >
        <div class="bg-white rounded-xl w-[700px] p-6 relative">

            <button 
                @click="showAdd = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-black">
                ✕
            </button>

            <h2 class="text-2xl font-semibold">Add Admin</h2>
            <p class="text-gray-500 mb-6">Please fill in input fields</p>

            <form action="{{ route('admin.users.storeAdmin') }}" method="POST" class="grid grid-cols-2 gap-4">
                @csrf

                <div>
                    <label class="font-medium">Last Name</label>
                    <input name="last_name" type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="font-medium">First Name</label>
                    <input name="first_name" type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="font-medium">Middle Name</label>
                    <input name="middle_name" type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="font-medium">Username</label>
                    <input name="username" type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div class="col-span-2">
                    <label class="font-medium">Email Address</label>
                    <input name="email" type="email" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div class="col-span-2">
    <label class="font-medium">Select Role</label>
    <select name="roleID" class="w-full border border-gray-300 rounded-lg px-3 py-2">
        @foreach($roles as $role)
            <option value="{{ $role->privId }}">{{ $role->privName }}</option>
        @endforeach
    </select>
</div>


                <div>
                    <label class="font-medium">Password</label>
                    <input name="password" type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="font-medium">Confirm Password</label>
                    <input name="password_confirmation" type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2">
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

        </div>
    </div>

</div>

@endsection
