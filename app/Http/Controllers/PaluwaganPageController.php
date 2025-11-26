<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaluwaganRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PaluwaganPageController extends Controller
{
    protected $repo;

    public function __construct(PaluwaganRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $customerID = Auth::id();

        // If user not logged in, redirect to login
        if (!$customerID) {
            return redirect()->route('login');
        }

        // Get all paluwagan orders for this customer
        $orders = $this->repo->getPackagesByCustomer($customerID);

        return view('user.paluwaganpage', [
            'orders' => $orders
        ]);
    }

    public function join(Request $request)
    {
        $request->validate([
            'packageID' => 'required|integer',
        ]);

        if (!Auth::check()) {
            return response()->json(['error' => 'Login required'], 401);
        }

        $customerID = Auth::id();
        $packageID = $request->packageID;

        $result = $this->repo->joinPackage($customerID, $packageID);

        if (!$result) {
            return response()->json(['error' => 'Already joined this package']);
        }

        return response()->json(['success' => true, 'message' => 'Successfully joined Paluwagan']);
    }
}
