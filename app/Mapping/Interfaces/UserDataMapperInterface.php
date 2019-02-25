<?php

namespace App\Mapping\Interfaces;

use App\Models\User;

interface UserDataMapperInterface
{
    public function mapObjectToRow(User $user): array;

    public function mapRowToObject(array $data): User;
}