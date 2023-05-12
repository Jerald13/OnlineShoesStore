<?php

namespace App\Http\Controllers\RepositoryPattern;

interface ProductInterface
{
    public function getAllProduct();

    public function createProduct($name, $price, $quantity, $imageUrl);

    public function getProductbyId($id);

    public function editProductDetails($name, $price, $quantity, $id);

    public function importProduct($name, $price, $quantity);

    public function getAvailableProduct();
}
