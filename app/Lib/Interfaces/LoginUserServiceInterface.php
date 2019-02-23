<?php

namespace App\Lib\Interfaces;

interface LoginUserServiceInterface
{
    public function execute(string $email,  string $password): void;
}