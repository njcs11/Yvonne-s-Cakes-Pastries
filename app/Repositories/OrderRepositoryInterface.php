<?php

namespace App\Repositories;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function create(array $data): Order;
    public function addItems(int $orderID, array $items): void;
    public function getByCustomer(int $customerID);
}
