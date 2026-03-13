<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Trait\Response;
use Illuminate\Support\Facades\Auth;

class profileService
{
    use Response;
    protected $userRepo , $fileService;
    public function __construct(UserRepository $userRepo , FileService $fileService)
    {
        $this->userRepo = $userRepo;
        $this->fileService = $fileService;
    }
//-------------------------------------------------------------------------------------------------
    public function updateUserProfile($data){
        $user = Auth::user();
        $photoPath = null;

        if(isset($data['image'])){
            $photoPath = $this->fileService->handleUploadPhoto($user, $data);
        }
        $this->userRepo->updateUserProfile($user, $data, $photoPath);
        return $user;
    }
//-------------------------------------------------------------------------------------------------

}