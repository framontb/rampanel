<?php
declare(strict_types=1);
namespace Rampanel\User;

class UserList
{
    public array $userList = [];

    // Type hinting with interface CheckUserIntegrity
    public function __construct(CheckUserIntegrity $user)
    {
        $this->addUser($user);
    }

    public function addUser(CheckUserIntegrity $user)
    {
        $this->userList[] = $user;
    }

}