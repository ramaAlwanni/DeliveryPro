<?php

namespace App\Services;

use App\Models\Store;
use App\Repositories\StoresRepository;

class StoreService
{
    public $storesRepo;
    public function __construct(StoresRepository $storesRepo)
    {
        $this->storesRepo = $storesRepo;
    }
//------------------------------------------------------------------------------------------------
    public function showAllStores()
    {
        return $this->storesRepo->showAllStores();
    }
//--------------------------------------------------------------------------------------------
    public function searchInStores($term)
    {
        // LIKE prefix search (case-insensitive)
        $result = Store::where('name', 'LIKE', $term . '%')
                        ->orderBy('name')
                        ->limit(10)
                        ->get(['id', 'name']);
        return $result;
    }



}