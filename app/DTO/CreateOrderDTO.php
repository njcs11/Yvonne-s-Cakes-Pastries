<?php

namespace App\DTO;

class CreateOrderDTO
{
    public int $customerID;
    public string $deliveryAddress;
    public string $remarks;
    public array $items;

    public function __construct(array $data)
    {
        $this->customerID      = $data['customerID'];
        $this->deliveryAddress = $data['deliveryAddress'];
        $this->remarks         = $data['remarks'] ?? null;
        $this->items           = $data['items'];
    }
}
