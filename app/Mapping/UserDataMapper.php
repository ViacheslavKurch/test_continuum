<?php

namespace App\Mapping;

use App\Models\User;
use App\Mapping\Interfaces\UserDataMapperInterface;

final class UserDataMapper implements UserDataMapperInterface
{
    /**
     * @param User $user
     * @return array
     */
    public function mapObjectToRow(User $user): array
    {
        return [
            'id'            => $user->getId(),
            'email'         => $user->getEmail(),
            'password_hash' => $user->getPasswordHash()
        ];
    }

    /**
     * @param array $data
     * @return User
     */
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