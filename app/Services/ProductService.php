<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    public $productRepo;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    //---------------------------------------------------------------------------------------
    public function showAllProduct($store_id)
    {
        return $this->productRepo->showAllProduct($store_id);
    }
    //---------------------------------------------------------------------------------------
    public function showProductDetails($product_id)
    {
        return $this->productRepo->showProductDetails($product_id);   
    }
    //----------------------------------------------------------------------------------------
    public function searchInProducts($term)
    {
        $result = Product::where('name' , 'LIKE' , $term . '%')
                            ->orderBy('name')
                            ->limit(10)
                            ->get(['id' , 'name']);
        return $result;
    }
}