<?php

namespace App\Lib;

use App\Lib\Interfaces\UserDataMapperInterface;
use App\Model\User;

class UserDataMapper implements UserDataMapperInterface
{
    public function mapObjectToRow(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'password_hash' => $user->getPasswordHash()
        ];
    }

    public function mapRowToObject(array $data): User
    {
        $user = new User(
            $data['email'],
            $data['password_hash']
        );

        $user->setId($data['id']);

        return $user;
    }
}