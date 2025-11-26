<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Services\UserManagementServiceInterface;
use App\Models\User;
<<<<<<< Updated upstream

class AdminUsersController extends Controller
{
    protected $userService;
=======
use App\Models\Role;

class AdminUsersController extends Controller
{
    protected UserManagementServiceInterface $userService;
>>>>>>> Stashed changes

    public function __construct(UserManagementServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
<<<<<<< Updated upstream
     * Display paginated list of users
=======
     * Display a listing of users with optional search.
>>>>>>> Stashed changes
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            $query->where('username', 'like', "%{$search}%")
                  ->orWhere('userID', 'like', "%{$search}%");
        })
        ->orderBy('userID', 'desc')
        ->paginate(10);

<<<<<<< Updated upstream
        $roles = \App\Models\Role::all();
=======
        $roles = Role::all();
>>>>>>> Stashed changes

        return view('admin.Users', compact('users', 'search', 'roles'));
    }

    /**
<<<<<<< Updated upstream
     * Store new admin user
=======
     * Store a new admin user.
>>>>>>> Stashed changes
     */
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
<<<<<<< Updated upstream
            $user = $this->userService->createUser([
=======
            $this->userService->createUser([
>>>>>>> Stashed changes
                'username' => $request->username,
                'password' => $request->password,
                'roleID' => $request->roleID,
            ]);

<<<<<<< Updated upstream
            return redirect()->route('admin.users')->with('success', 'Admin account created successfully.');
=======
            return redirect()->route('admin.users')
                ->with('success', 'Admin account created successfully.');
>>>>>>> Stashed changes
        } catch (\Exception $e) {
            Log::error('Failed to create admin user: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Failed to create admin account.']);
        }
    }

<<<<<<< Updated upstream
public function toggleStatus($userID)
{
    $user = \App\Models\User::findOrFail($userID);
    $user->status = $user->status == 1 ? 0 : 1;
    $user->save();

    return response()->json(['status' => $user->status]);
}

=======
    /**
     * Optional: View user details (can be used with modal in Blade)
     */
    public function show(int $userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user);
    }

    /**
     * Optional: Update user status
     */
    public function updateStatus(Request $request, int $userId)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        try {
            $this->userService->updateStatus($userId, $request->status);
            return redirect()->route('admin.users')
                ->with('success', 'User status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update user status: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Failed to update user status.']);
        }
    }

    /**
     * Optional: Change user role
     */
    public function changeRole(Request $request, int $userId)
    {
        $request->validate([
            'roleID' => 'required|integer',
        ]);

        try {
            $this->userService->changeUserRole($userId, $request->roleID);
            return redirect()->route('admin.users')
                ->with('success', 'User role updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to change user role: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Failed to change user role.']);
        }
    }

    /**
     * Optional: Delete a user
     */
    public function destroy(int $userId)
    {
        try {
            $this->userService->deleteUser($userId);
            return redirect()->route('admin.users')
                ->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete user: ' . $e->getMessage());
            return back()->withErrors(['msg' => 'Failed to delete user.']);
        }
    }
>>>>>>> Stashed changes
}
