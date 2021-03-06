<?php

namespace App\Lib\Interfaces;

use App\Models\User;

interface UserAuthenticatorInterface
{
    public function execute(string $email, string $password): User;
}