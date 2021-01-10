<?php

namespace App\Http\Repositories;

use App\Models\Product;
use Auth;

interface ProductInterface{
    public function store(array $data);
}

class ProductRepository implements ProductInterface
{

  function __construct(Product $product)
  {
      $this->product = $product;
  }

  public function store(array $data){
    return $this->product->create([
            'product_name' => $data['product_name'],
            'shipping_address' => $data['shipping_address'],
            'price' => $data['price']
        ]);
  }
}
