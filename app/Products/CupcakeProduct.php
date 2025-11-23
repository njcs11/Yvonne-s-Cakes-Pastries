<?php

namespace App\Products;

use App\Abstracts\AbstractProduct;

class CupcakeProduct extends AbstractProduct
{
    public function setType(): void
    {
        $this->product->productTypeID = 2; // Cupcake
    }
}
