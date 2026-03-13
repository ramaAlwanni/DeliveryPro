<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPassword\ForgetPasswordRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Requests\ForgetPassword\resetPasswordRequest;
use App\Http\Requests\ForgetPassword\verifyOtpRequest;
use App\Services\customerAuthService;
use App\Trait\Response;

class AuthController extends Controller
{
    use Response;
    protected $customerAuthService;
    public function __construct(customerAuthService $customerAuthService)
    {
        $this->customerAuthService = $customerAuthService;
    }
//-------------------------------------------------------------------------------------------------
    public function register(RegisterRequest $request) {
        $user = $this->customerAuthService->register($request->validated());
        return $this->SuccessResponse('messages.Success','messages.user_created' , $user , 200);
    }
//--------------------------------------------------------------------------------------------------
    public function login(LoginRequest $request) {
        $user = $this->customerAuthService->login($request->validated());
        return $this->SuccessResponse('messages.Success' ,'messages.user_login', $user , 200);
    }
//--------------------------------------------------------------------------------------------------

    public function forgetPassword(ForgetPasswordRequest $request) {
        $this->customerAuthService->forgetPassword($request->validated());
        return $this->SuccessResponse('messages.Success','messages.otp_sending', null , 200);
    }
    //********************************************* */
    public function verifyOtp(verifyOtpRequest $request)
    {
        $this->customerAuthService->verifyOtp($request->validated());
        return $this->SuccessResponse('messages.Success', 'messages.otp_verified', null, 200);
    }
    //********************************************* */
    public function resetPassword(resetPasswordRequest $request)
    {
        $this->customerAuthService->resetPassword($request->validated());
        return $this->SuccessResponse('messages.Success', 'messages.reset_password', null, 200);
    }
//--------------------------------------------------------------------------------------------------

    public function logout() {
        auth()->user()->tokens()->delete();
        return $this->successResponse('messages.Success', 'messages.user_logout', null ,200);
    }
//--------------------------------------------------------------------------------------------------


}
