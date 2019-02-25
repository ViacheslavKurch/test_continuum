<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface RegisterUserServiceInterface
{
    public function execute(string $email, string $password): User;
}