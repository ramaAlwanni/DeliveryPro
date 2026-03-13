<?php

namespace app\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function showAllProduct($store_id);
    public function searchProducts();
    public function showProductDetails($product_id);
    public function createProduct();
    public function updateProduct();
    public function deleteProduct();

}
