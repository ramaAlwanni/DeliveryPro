<?php

namespace app\Repositories\Interfaces;

interface StoresRepositoryInterface
{
    public function showAllStores();
    public function searchStores();
    public function createStore();
    public function updateStores();
    public function deleteStores();
    
}