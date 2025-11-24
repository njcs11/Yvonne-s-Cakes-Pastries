<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'orderID';
    public $timestamps = false;

    protected $fillable = [
        'customerID',
        'status',
        'orderDate',
        'totalAmount',
        'remarks',
        'deliveryAddress',
        'paymentStatus',
        'deliveryDate'
    ];

    

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderID', 'orderID');
    }
    
}
