<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTO\CustomerLoginDTO;
use App\Services\CustomerLoginService;

class LoginPageController extends Controller
{
    protected CustomerLoginService $loginService;

    public function __construct(CustomerLoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    // Show login page
    public function index()
    {
        session()->forget('logged_in_user'); // Clear previous session
        return view('user.LoginPage');
    }

    // Handle login submission
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Create DTO
        $dto = new CustomerLoginDTO($request->only('username', 'password'));

        // Attempt login
        $customer = $this->loginService->login($dto);

        if (!$customer) {
            return back()->withErrors(['loginError' => 'Invalid credentials or inactive account.']);
        }

        // Store logged in customer in session
        session(['logged_in_user' => [
            'customerID' => $customer->customerID,
            'firstname' => $customer->firstName,
            'lastname'  => $customer->lastName,
            'username'  => $customer->username,
        ]]);

        return redirect()->route('home')
                         ->with('success', 'Welcome back, ' . $customer->firstName . '!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        session()->forget('logged_in_user');
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
}
