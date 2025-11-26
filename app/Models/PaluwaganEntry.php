<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaluwaganEntry extends Model
{
    use HasFactory;

    protected $table = 'paluwaganentry';
    protected $primaryKey = 'paluwaganEntryID';
    public $timestamps = false;

    protected $fillable = [
        'customerID',
        'packageID',
        'joinDate',
        'status'
    ];

    // Relation to package
    public function package()
    {
        return $this->belongsTo(PaluwaganPackage::class, 'packageID', 'packageID');
    }
}
