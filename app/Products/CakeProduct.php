<?php

namespace App\Products;

use App\Abstracts\AbstractProduct;

class CakeProduct extends AbstractProduct
{
    protected $servings;
    protected $ingredients;

    public function __construct($name, $description, $price, $servings, $ingredients)
    {
        parent::__construct($name, $description, $price);
        $this->servings = $servings;
        $this->ingredients = $ingredients;
    }

    public function getServings()
    {
        return $this->servings;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }
}
