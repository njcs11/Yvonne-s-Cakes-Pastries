<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';       // Table name
    protected $primaryKey = 'userID'; // Primary key
    public $timestamps = true;        // Use created_at / updated_at

    protected $fillable = [
        'username',
        'password',
        'roleID',
        'status',
    ];

    protected $hidden = [
        'password',
    ];
}
