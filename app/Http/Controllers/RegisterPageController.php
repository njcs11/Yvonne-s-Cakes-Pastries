<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\DTO\CustomerDTO;

class RegisterPageController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function show()
    {
        return view('user.RegisterPage');
    }

    public function store(Request $request)
    {
        // Step 1 & 2 & 3 validation
            $validated = $request->validate([
        'firstname'  => 'required|string|max:255',
        'lastname'   => 'required|string|max:255',
        'midInitial' => 'nullable|string|max:5',
        'address'    => 'required|string|max:255',
        'number'     => 'required|string|max:255',
        'email'      => 'required|email|max:255|unique:customer,email',
        'username'   => 'required|string|max:255|unique:customer,username',
        'password'   => 'required|string|min:8|confirmed',
    ]);


        $customerDTO = new CustomerDTO($validated);
        $customer = $this->customerService->register($customerDTO);

        session(['logged_in_customer' => $customer]);

        return redirect()->route('login')->with('success', 'Account created successfully! You can now log in.');
    }
}
