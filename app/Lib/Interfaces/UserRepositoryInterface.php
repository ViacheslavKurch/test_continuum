<?php

namespace App\Lib\Interfaces;

use App\Model\User;

interface UserRepositoryInterface
{
    public function get(int $id): User;

    public function findByEmail(string $email): ?User;

    public function save(User $user): void;
}