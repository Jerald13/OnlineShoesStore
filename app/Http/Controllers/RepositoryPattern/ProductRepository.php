<?php

namespace App\Http\Controllers\RepositoryPattern;

use App\Models\Product;

class ProductRepository implements ProductInterface
{

    public function getAllProduct()
    {
        return Product::all();
    }

    public function createProduct($name, $price, $quantity, $imageUrl)
    {
        Product::create([
            "name" => $name,
            "price"=> $price,
            "quantity" => $quantity,
            "imageUrl" => $imageUrl
        ]);
    }

    public function getProductbyId($id)
    {
        return Product::find($id);
    }

    public function editProductDetails($name, $price, $quantity, $id)
    {
        $product = $this->getProductbyId($id);

        $product->update([
            "name" => $name,
            "price"=> $price,
            "quantity" => $quantity
        ]);

        $product->save();
    }

    public function importProduct($name, $price, $quantity){
        Product::create([
            "name" => $name,
            "price"=> $price,
            "quantity" => $quantity
        ]);
    }

    public function getAvailableProduct()
    {
        return Product::where("quantity", ">", "0")->get();
    }
}
