<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Trait\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Response;
    public $productsSer;
    public function __construct(ProductService $productsSer)
    {
        $this->productsSer = $productsSer;
    }
//-----------------------------------------------------------------------------------------------
    public function showStoreProduct($store_id) 
    {
        $products =  $this->productsSer->showAllProduct($store_id);

        if ($products->isEmpty()) {
            return $this->SuccessResponse('Success','There are not products yet!', null, 204);
        }
        return $this->SuccessResponse('Success','All products', $products, 200);
    }
    //------------------------------------------------------------------------------------------------
    public function showProductDetails($product_id)
    {
        $product =  $this->productsSer->showProductDetails($product_id);
        if(!$product){
            throw new ModelNotFoundException();
        }
        return $this->SuccessResponse('Success','Product details', $product, 200);
    }

    //-----------------------------------------------------------------------------------------------
    public function productSearch(Request $request)
    {
        $term = $request->input('q', '');

        if ($term) {
            $result = $this->productsSer->searchInProducts($term);
            if ($result->isEmpty()) {
                return $this->ErrorResponse('Error', 'There are not product start with this letters!', null, 404);
            }
            return $this->SuccessResponse('Success', 'All products', $result, 200);
        }
        return $this->ErrorResponse('Error', 'Enter any letter for search!', null, 404);
    }













}
