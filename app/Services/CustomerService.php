<?php


namespace App\Services;


use App\Models\Customer;
use App\DTO\CustomerDTO;


class CustomerService
{
    public function register(CustomerDTO $dto): Customer
    {
    return Customer::create($dto->toArray());
    }
}