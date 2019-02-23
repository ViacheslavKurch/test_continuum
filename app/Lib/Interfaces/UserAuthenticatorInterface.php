<?php

namespace App\Lib\Interfaces;

use App\Model\User;

interface UserAuthenticatorInterface
{
    public function execute(string $email, string $password): User;
}