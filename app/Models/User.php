<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';         // Confirmed your table name is 'user'
    protected $primaryKey = 'userID';  // Primary key
    public $timestamps = true;         // Use timestamps

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
<<<<<<< Updated upstream
}
=======
}

>>>>>>> Stashed changes
