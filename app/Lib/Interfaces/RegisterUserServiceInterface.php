<?php

namespace App\Lib\Interfaces;

use App\Model\User;

interface RegisterUserServiceInterface
{
    public function execute(string $email, string $password): User;
}