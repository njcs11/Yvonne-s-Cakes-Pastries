<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\DTO\CustomerDTO;
use App\Services\CustomerService;
use App\Models\Customer;


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
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'mi' => 'nullable|string|max:5',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:customer,email',
            'address' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customer,username',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $customerDTO = new CustomerDTO($request->all());


        $this->customerService->register($customerDTO);


        return redirect()->route('login')->with('success', 'Account created successfully!');
    }


    public function checkUsername(Request $request)
    {
        $exists = Customer::where('username', $request->username)->exists();
        return response()->json(['exists' => $exists]);
    }
}