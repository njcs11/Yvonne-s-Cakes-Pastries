<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    // Show user management page with search & pagination
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('username', 'like', "%{$search}%")
                      ->orWhere('userID', 'like', "%{$search}%");
            })
            ->orderBy('userID', 'desc')
            ->paginate(10);
            
              $roles = Privilege::all(); // fetch all roles dynamically

        return view('admin.users', compact('users', 'search'));
    }

    // Show single user for modal (AJAX)
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Create new admin user
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user,username',
            'password' => 'required|string|min:6|confirmed',
            'roleID'   => 'required|integer',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'roleID'   => $request->roleID,
            'status'   => 1,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin account created successfully.');
    }

    // Deactivate user (soft delete alternative)
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 0; // inactive
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User deactivated successfully.');
    }
}
