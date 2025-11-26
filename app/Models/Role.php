<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'roleID';
    public $timestamps = false;

    public function privileges()
    {
        return $this->belongsToMany(
            Privilege::class,
            'roleprivilege',
            'roleID',
            'privilegeID'
        );
    }
}

