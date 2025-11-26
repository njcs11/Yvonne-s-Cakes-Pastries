<?php

namespace App\Repositories;

use App\Models\PaluwaganEntry;
use App\Models\PaluwaganPackage;

class PaluwaganRepository implements PaluwaganRepositoryInterface
{
    public function getPackagesByCustomer(int $customerID)
    {
        return PaluwaganEntry::where('customerID', $customerID)
            ->join('paluwaganpackage', 'paluwaganentry.packageID', '=', 'paluwaganpackage.packageID')
            ->select(
                'paluwaganpackage.packageID as id',
                'paluwaganpackage.packageName as name',
                'paluwaganpackage.description as description',
                'paluwaganentry.joinDate as joinDate',
                'paluwaganentry.status as status',
                'paluwaganpackage.totalAmount as package_amount',
                'paluwaganpackage.monthlyPayment as monthly',
                'paluwaganpackage.durationMonths as total_months',
                'paluwaganpackage.image as image'
            )
            ->get();
    }

    public function joinPackage(int $customerID, int $packageID)
    {
        $exists = PaluwaganEntry::where('customerID', $customerID)
            ->where('packageID', $packageID)
            ->exists();

        if ($exists) {
            return false;
        }

        return PaluwaganEntry::create([
            'customerID' => $customerID,
            'packageID' => $packageID,
            'joinDate' => now(),
            'status' => 'active'
        ]);
    }
    public function getAllEntriesByStatus(string $status)
{
    return DB::table('paluwaganentry')
        ->join('paluwaganpackage', 'paluwaganentry.packageID', '=', 'paluwaganpackage.packageID')
        ->where('paluwaganentry.status', strtoupper($status))
        ->select('paluwaganpackage.totalAmount as package_amount')
        ->get();
}

}
