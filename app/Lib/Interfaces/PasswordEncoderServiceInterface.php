<?php

namespace App\Lib\Interfaces;

interface PasswordEncoderServiceInterface
{
    public function encode(string $password): string;

    public function verify(string $password, string $passwordHash): bool;
}