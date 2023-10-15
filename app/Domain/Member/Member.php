<?php

namespace App\Domain\Member;

class Member
{
    private $memberInfo = [];
    private $password;

    public function __construct($memberInfo)
    {
        $this->memberInfo = $memberInfo;
    }


    public function changePassword($oldPassword, $newPassword)
    {
        if ($oldPassword != $this->memberInfo['password']) {
             throw new \Exception("no match password");
        }
        $this->password = $newPassword;
        return $newPassword;
    }

}