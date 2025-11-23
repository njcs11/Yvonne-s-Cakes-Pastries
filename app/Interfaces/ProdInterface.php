<?php

namespace App\Interfaces;

interface ProdInterface
{
    public function getName(): string;
    public function getDescription(): string;
    public function getPrice(): float;
    public function getServings();
    public function getIngredients();
}
