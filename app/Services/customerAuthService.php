<?php

namespace App\Services;

use App\Exceptions\Auth\LoginException;
use App\Exceptions\ForgetPassword\OTPException;
use App\Mail\OTPMail;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class customerAuthService
{
    protected $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
//----------------------------------------------------------------------------------------------
    public function register($request) {
        return $this->userRepo->createUser($request);
    }
//----------------------------------------------------------------------------------------------

    public function login($request) {
        $credentails = [ 'email' => $request['email'],
                        'password' => $request['password']];

        if(!Auth::attempt($credentails)){
            throw new LoginException();
        }
        $token = Auth()->user()->createToken('token-name')->plainTextToken;
        return $token;
    }
//----------------------------------------------------------------------------------------------

    public function forgetPassword($request) {
        $user = $this->userRepo->findUsersViaEmail($request);
        if(!$user){
            throw new ModelNotFoundException();
        }
        $otp = rand(1000, 9999);
        $user->update(['otp' => $otp]);
        Mail::to($user->email)->send(new OTPMail($otp));
    }
        //************************************** */

    public function verifyOtp($request)
    {
        $user = $this->userRepo->findUsersViaEmail($request);
        if (!$user) {
            throw new ModelNotFoundException();
        }
        $correctOTP = $this->userRepo->checkUserOTP($request['otp'], $user);
        if (!$correctOTP) {
            throw new OTPException();
        }
    }
        //************************************** */
     public function resetPassword($request)
    {
        $user = $this->userRepo->findUsersViaEmail($request);
        if (!$user) {
            throw new ModelNotFoundException();
        }
        $correctOTP = $this->userRepo->checkUserOTP($request['otp'], $user);
        if (!$correctOTP) {
            throw new OTPException();
        }
        $this->userRepo->setNewPassword($user , $request['password']);
    }

    


}