<?php

namespace App\Services\Interfaces;

interface LoginUserServiceInterface
{
    public function execute(string $email,  string $password): void;
}