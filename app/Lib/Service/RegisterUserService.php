<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\PasswordEncoderServiceInterface;
use App\Lib\Interfaces\RegisterUserServiceInterface;
use App\Lib\Interfaces\UserRepositoryInterface;
use App\Model\User;

class RegisterUserService implements RegisterUserServiceInterface
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
    public function __construct(UserRepositoryInterface $userRepository, PasswordEncoderServiceInterface $passwordEncoderService)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoderService = $passwordEncoderService;
    }

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