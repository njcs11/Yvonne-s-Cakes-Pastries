<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Services\UserManagementServiceInterface;
use App\Models\User;


class AdminUsersController extends Controller
{
    protected $userService;

    public function __construct(UserManagementServiceInterface $userService)
    {
        $this->userService = $userService;
    }

   
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            $query->where('username', 'like', "%{$search}%")
                  ->orWhere('userID', 'like', "%{$search}%");
        })
        ->orderBy('userID', 'desc')
        ->paginate(10);

        $roles = \App\Models\Role::all();

        return view('admin.Users', compact('users', 'search', 'roles'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('user', 'username'),
            ],
            'password' => 'required|string|min:6|confirmed',
            'roleID' => 'required|integer',
        ]);

        try {
            $user = $this->userService->createUser([
                'username' => $request->username,
                'password' => $request->password,
                'roleID' => $request->roleID,
            ]);

            return redirect()->route('admin.users')->with('success', 'Admin account created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create admin user: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Failed to create admin account.']);
        }
    }

    public function toggleStatus($userID)
    {
        $user = \App\Models\User::findOrFail($userID);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return response()->json(['status' => $user->status]);
    }

}