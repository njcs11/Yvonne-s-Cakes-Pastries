<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'customerID';
    public $timestamps = true;

    protected $fillable = [
        'firstName',
        'lastName',
        'mi',
        'phone',
        'email',
        'address',
        'username',
        'password',
        'isActive',
    ];

    // Optional: hide password when serializing
    protected $hidden = ['password'];
}
