<?php

namespace App\Services;

use App\DTO\CreateOrderDTO;
use App\Repositories\OrderRepositoryInterface;

class OrderService
{
    private OrderRepositoryInterface $repo;

    public function __construct(OrderRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function createOrder(CreateOrderDTO $dto)
    {
        $total = 0;

        foreach ($dto->items as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = $this->repo->create([
            'customerID'      => $dto->customerID,
            'status'          => 'Pending',
            'orderDate'       => now(),
            'totalAmount'     => $total,
            'remarks'         => $dto->remarks,
            'deliveryAddress' => $dto->deliveryAddress,
            'paymentStatus'   => 'Unpaid',
            'deliveryDate'    => null
        ]);

        $this->repo->addItems($order->orderID, $dto->items);

        return $order;
    }

    public function getCustomerOrders(int $id)
    {
        return $this->repo->getByCustomer($id);
    }
}
