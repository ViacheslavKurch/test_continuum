<?php

namespace App\Lib\Repository;

use App\Lib\Interfaces\StorageAdapterInterface;
use App\Lib\Interfaces\UserDataMapperInterface;
use App\Lib\Interfaces\UserRepositoryInterface;
use App\Model\User;

class UserRepository implements UserRepositoryInterface
{
    private const TABLE_NAME = 'users';

    /** @var StorageAdapterInterface */
    private $storageAdapter;

    /** @var UserDataMapperInterface */
    private $userDataMapper;

    /**
     * UserRepository constructor.
     * @param StorageAdapterInterface $storageAdapter
     * @param UserDataMapperInterface $userDataMapper
     */
    public function __construct(StorageAdapterInterface $storageAdapter, UserDataMapperInterface $userDataMapper)
    {
        $this->storageAdapter = $storageAdapter;
        $this->userDataMapper = $userDataMapper;
    }

    public function get(int $id): User
    {
        $userData = $this->storageAdapter->get(static::TABLE_NAME, $id);

        if (null === $userData) {
            throw new \Exception('User not found');
        }

        return $this->userDataMapper->mapRowToObject($userData);
    }

    public function findByEmail(string $email): ?User
    {
        $userData = $this->storageAdapter->getByFieldValue(static::TABLE_NAME, 'email', $email);

        if (null === $userData) {
            return null;
        }

        return $this->userDataMapper->mapRowToObject($userData);
    }

    public function save(User $user): void
    {
        $this->storageAdapter->insert(static::TABLE_NAME, $this->userDataMapper->mapObjectToRow($user));
    }


}