<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'ingredient';
    protected $primaryKey = 'ingredientID';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'unit',
        'quantityOnHand',
        'productID'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }
}
