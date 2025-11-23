<?php

namespace App\Builders;

use App\Models\Product;
use App\Models\Serving;
use App\Models\ListOfIngredients;
use App\Models\Ingredient;

class ProductBuilder
{
    private Product $product;
    private ListOfIngredients $ingredientsList;
    private array $servings = [];
    private array $ingredients = [];

    public function __construct()
    {
        $this->product = new Product();
        $this->ingredientsList = new ListOfIngredients();
    }

    // Product basic info
    public function setType(int $productTypeID): self
    {
        $this->product->productTypeID = $productTypeID;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->product->name = $name;
        return $this;
    }

    public function setImageURL(string $imageURL): self
    {
        $this->product->imageURL = $imageURL;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->product->description = $description;
        return $this;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->product->isAvailable = $isAvailable;
        return $this;
    }

    // Add a serving
    public function addServing(string $size, int $servingCount, float $price): self
    {
        $this->servings[] = compact('size', 'servingCount', 'price');
        return $this;
    }

    // Add an ingredient
    public function addIngredient(string $name, float $quantity, string $unit): self
    {
        $this->ingredients[] = compact('name', 'quantity', 'unit');
        return $this;
    }

    // Persist product + servings + ingredients
    public function build(): Product
    {
        $this->product->save();

        // Save Servings
        foreach ($this->servings as $servingData) {
            $serving = new Serving($servingData);
            $serving->productID = $this->product->productID;
            $serving->save();
        }

        // Save ListOfIngredients
        $this->ingredientsList->productID = $this->product->productID;
        $this->ingredientsList->save();

        // Save Ingredients
        foreach ($this->ingredients as $ingredientData) {
            $ingredient = new Ingredient($ingredientData);
            $ingredient->listID = $this->ingredientsList->listID;
            $ingredient->save();
        }

        return $this->product;
    }
}
