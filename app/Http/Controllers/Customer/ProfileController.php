<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\profileService;
use App\Trait\Response;

class ProfileController extends Controller
{
    use Response;
    protected $userProfileService;
    public function __construct(profileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }
//------------------------------------------------------------------------------------------------
    public function updateUserProfile(ProfileRequest $request){

        $user = $this->userProfileService->updateUserProfile($request->validated());
        return $this->SuccessResponse('Success','Profile user has been updated successfully',
                                      $user->getChanges() , 200);

    }

}
