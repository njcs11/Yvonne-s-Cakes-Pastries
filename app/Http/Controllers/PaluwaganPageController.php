<?php

namespace App\Http\Controllers;

use App\Services\PaluwaganService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PaluwaganPageController extends Controller
{
    private $paluwaganService;

    public function __construct(PaluwaganService $paluwaganService)
    {
        $this->paluwaganService = $paluwaganService;
    }

    public function index()
    {
        // Get the customer ID
        $customerID = session('logged_in_user.customerID');


        // Ensure the user is authenticated
        if (!$customerID) {
            return redirect()->route('login')->with('error', 'You must be logged in to access Paluwagan.');
        }

        // Fetch paluwagan entries for the user
        $orders = $this->paluwaganService->getUserPaluwaganEntries($customerID);

        return view('user.PaluwaganPage', compact('orders'));
    }

    public function join(Request $request)
    {
        $request->validate([
            'packageID' => 'required|integer',
        ]);

        $customerID = Auth::id();

        if (!$customerID) {
            return response()->json(['error' => 'You must be logged in to join paluwagan.'], 401);
        }

        try {
            $this->paluwaganService->joinPaluwagan($customerID, $request->packageID);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 409);
        }

        return response()->json(['success' => true, 'message' => 'Successfully joined the paluwagan!']);
    }

    // Optional: stub for enroll if route exists
    public function enroll(Request $request)
    {
        return response()->json(['error' => 'Not implemented'], 501);
    }
}
