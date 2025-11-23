<?php

namespace App\Services;

use App\Models\Customer;
use App\DTO\CustomerDTO;

class CustomerService
{
    /**
     * Registers a new customer
     */
    public function register(CustomerDTO $dto): Customer
    {
        return Customer::create($dto->toArray());
    }
}
