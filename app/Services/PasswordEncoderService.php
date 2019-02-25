<?php

namespace App\Services;

use App\Services\Interfaces\PasswordEncoderServiceInterface;

final class PasswordEncoderService implements PasswordEncoderServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function encode(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @param string $passwordHash
     * @return bool
     */
    public function verify(string $password, string $passwordHash): bool
    {
        return password_verify($password,  $passwordHash);
    }
}