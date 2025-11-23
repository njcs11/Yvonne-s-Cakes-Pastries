<?php

namespace App\Abstracts;

use App\Interfaces\ProdInterface;

abstract class AbstractProduct implements ProdInterface
{
    protected $name;
    protected $description;
    protected $price;

    public function __construct($name, $description, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    abstract public function getServings();
    abstract public function getIngredients();
}
