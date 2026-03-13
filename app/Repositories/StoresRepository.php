<?php

namespace App\Repositories;

use App\Models\Store;
use App\Repositories\Interfaces\StoresRepositoryInterface;

class StoresRepository implements StoresRepositoryInterface
{
    public function showAllStores()
    {
        return Store::all();
    }
/////////////////////////////////////////
    public function searchStores()
    {

    }

    public function createStore(){

    }
    public function updateStores(){

    }
    public function deleteStores(){

    }
}