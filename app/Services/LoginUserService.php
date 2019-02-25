<?php

namespace App\Services;

use App\Lib\Interfaces\AuthInterface;
use App\Services\Interfaces\LoginUserServiceInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\PasswordEncoderServiceInterface;

final class LoginUserService implements LoginUserServiceInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var PasswordEncoderServiceInterface */
    private $passwordEncoder;

    /** @var AuthInterface */
    private $auth;

    /**
     * LoginUserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param PasswordEncoderServiceInterface $passwordEncoder
     * @param AuthInterface $auth
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        PasswordEncoderServiceInterface $passwordEncoder,
        AuthInterface $auth
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->auth = $auth;
    }

    /**
     * @param string $email
     * @param string $password
     * @throws \Exception
     */
    public function execute(string $email, string $password): void
    {
        $user = $this->userRepository->findByEmail($email);

        if (null === $user || false === $this->passwordEncoder->verify($password, $user->getPasswordHash())) {
            throw new \Exception('Bad credentials');
        }

        $this->auth->setUser($user);
    }
}