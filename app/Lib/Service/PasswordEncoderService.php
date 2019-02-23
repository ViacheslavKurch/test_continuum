<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\PasswordEncoderServiceInterface;

class PasswordEncoderService implements PasswordEncoderServiceInterface
{
    public function encode(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify(string $password, string $passwordHash): bool
    {
        return password_verify($password,  $passwordHash);
    }
}