<?php

namespace App\Lib\Interfaces;

use App\Model\User;

interface UserDataMapperInterface
{
    public function mapObjectToRow(User $user): array;

    public function mapRowToObject(array $data): User;
}