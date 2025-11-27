<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';         
    protected $primaryKey = 'userID';  
    public $timestamps = true;         

    protected $fillable = [
        'username',
        'password',
        'roleID',
        'status',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleID', 'roleID');
    }
}

