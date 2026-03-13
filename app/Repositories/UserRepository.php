<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function createUser($data) { return User::create($data); }
//--------------------------------------------------------------------------------------
    public function findUsersViaEmail($data) { return User::where('email' , $data['email'])->first(); }
//--------------------------------------------------------------------------------------
    public function checkUserOTP($otp , $user){  return $user->otp === $otp; }
//--------------------------------------------------------------------------------------
    public function setNewPassword($user , $password) 
    {  
        $user->update([
            'password' => Hash::make($password),
            'otp'      => null
        ]);
    }
//--------------------------------------------------------------------------------------
    public function updateUserProfile($user, $data , $path) 
    {
        if($path){
            $data['image'] = $path;
        }
        $user->update($data);
        return $user;
    }
    //--------------------------------------------------------------------------------------
}