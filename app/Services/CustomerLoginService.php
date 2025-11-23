<?php
namespace App\Services;

use App\Models\Customer;
use App\DTO\CustomerLoginDTO;

class CustomerLoginService
{
    public function login(CustomerLoginDTO $dto): ?Customer
    {
        $customer = Customer::where('username', $dto->username)->first();

        if (!$customer) return null;
        if (!password_verify($dto->password, $customer->password)) return null;
        if (!$customer->isActive) return null;

        return $customer;
    }
}
