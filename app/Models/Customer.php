<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
use HasFactory;


protected $table = 'customer';
protected $primaryKey = 'customerID';
public $timestamps = true; // uses created_at & updated_at


// Keep camelCase to match your DB
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



    protected $hidden = ['password'];
}