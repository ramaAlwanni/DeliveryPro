<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function showAllProduct($store_id)
    {
        return Product::where('store_id' , $store_id)->get();
    }
    //////////////////////////////////////////////////////////////
    public function searchProducts()
    {

    }
    /////////////////////////////////////////////////////////////
    public function showProductDetails($product_id)
    {
        return Product::where('id' , $product_id)->first();
    }
    /////////////////////////////////////////////////////////////
    public function createProduct()
    {

    }
    public function updateProduct()
    {

    }
    public function deleteProduct()
    {

    }
}