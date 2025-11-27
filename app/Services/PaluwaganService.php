<?php

namespace App\Services;

use App\Repositories\PaluwaganRepositoryInterface;

class PaluwaganService
{
    private $repository;

    public function __construct(PaluwaganRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUserPaluwaganEntries(int $customerID)
    {
        return $this->repository->getUserEntries($customerID);
    }

    public function joinPaluwagan(int $customerID, int $packageID)
    {
        $joined = $this->repository->joinPackage($customerID, $packageID);

        if (!$joined) {
            throw new \Exception("You have already joined this package.");
        }

        return $joined;
    }
}