<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function createUser($data);
    public function findUsersViaEmail($data);
    public function checkUserOTP($otp, $user);
    public function setNewPassword($user, $password);
    public function updateUserProfile($user, $data, $path);
}
