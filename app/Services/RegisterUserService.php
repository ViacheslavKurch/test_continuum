<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\RegisterUserServiceInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\PasswordEncoderServiceInterface;

final class RegisterUserService implements RegisterUserServiceInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var PasswordEncoderServiceInterface */
    private $passwordEncoderService;

    /**
     * RegisterUserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param PasswordEncoderServiceInterface $passwordEncoderService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordEncoderServiceInterface $passwordEncoderService
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoderService = $passwordEncoderService;
    }

    /**
     * @param string $email
     * @param string $password
     * @return User
     * @throws \Exception
     */
    public function execute(string $email, string $password): User
    {
        if (null !== $this->userRepository->findByEmail($email)) {
            throw new \Exception('User with same email already exists');
        }

        $passwordHash = $this->passwordEncoderService->encode($password);

        $user = new User($email, $passwordHash);

        $this->userRepository->save($user);

        return $user;
    }
}