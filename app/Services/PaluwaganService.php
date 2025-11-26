<?php

namespace App\Services;

use App\Repositories\PaluwaganRepositoryInterface;

class PaluwaganService
{
    protected $repo;

    public function __construct(PaluwaganRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getUserPaluwaganEntries(int $customerID)
    {
        return $repo->getUserEntries($customerID);
    }

    public function joinPaluwagan(int $customerID, int $packageID)
    {
        return $this->repo->joinPackage($customerID, $packageID);
    }
}
