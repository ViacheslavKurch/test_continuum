<?php

namespace App\Repository\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function get(int $id): User;

    public function findByEmail(string $email): ?User;

    public function save(User $user): void;
}