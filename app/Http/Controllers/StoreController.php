<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\StoreService;
use App\Trait\Response;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use Response;
    public $storesService;
    public function __construct(StoreService $storesService)
    {
        $this->storesService = $storesService;
    }
//----------------------------------------------------------------------------------------------
    public function showAllStores()
    {
        $stores = $this->storesService->showAllStores();

        if($stores->isEmpty()){
           return $this->SuccessResponse('Success','There are not stores yet!', null, 204);
        }
        return $this->SuccessResponse('Success','All stores', $stores, 200);
    }
//-----------------------------------------------------------------------------------------------
    public function storeSearch(Request $request) 
    {
        $term = $request->input('q', '');

        if($term){
            $result = $this->storesService->searchInStores($term);
            if ($result->isEmpty()) {
                return $this->ErrorResponse('Error', 'There are not stores start with this letters!', null, 404);
            }
            return $this->SuccessResponse('Success', 'All stores', $result, 200);
        }
        return $this->ErrorResponse('Error', 'Enter any letter for search!', null, 404);
    }

//-----------------------------------------------------------------------------
//this is function for testing spatie translation for the columns in dataBase
public function createStore(Request $request){
    $data = $request->validate([
        'name.en' => 'required|string|unique:stores,name->en',
        'name.ar' => 'required|string|unique:stores,name->ar',
        'description.en' => 'required|unique:stores,description->en',
        'description.ar' => 'required|unique:stores,description->ar',
    ]);

    $store = Store::create($data);

    return $this->SuccessResponse('messages.Success', 'messages.user_created', $store, 200);


}

}
