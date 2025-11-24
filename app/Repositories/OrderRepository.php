<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function addItems(int $orderID, array $items): void
    {
        foreach ($items as $item) {
            OrderItem::create([
                'orderID'   => $orderID,
                'productID' => $item['productID'],
                'price'     => $item['price'],
                'qty'       => $item['qty'],
                'subtotal'  => $item['price'] * $item['qty']
            ]);
        }
    }

    public function getByCustomer(int $customerID)
    {
        return Order::where('customerID', $customerID)
            ->with('orderItems')
            ->get();
    }
}
