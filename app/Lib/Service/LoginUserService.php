<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\LoginUserServiceInterface;
use App\Lib\Interfaces\PasswordEncoderServiceInterface;
use App\Lib\Interfaces\UserRepositoryInterface;

class LoginUserService implements LoginUserServiceInterface
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
    public function __construct(UserRepositoryInterface $userRepository, PasswordEncoderServiceInterface $passwordEncoder, AuthInterface $auth)
    {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->auth = $auth;
    }

    public function execute(string $email, string $password): void
    {
        $user = $this->userRepository->findByEmail($email);

        if (null === $user || false === $this->passwordEncoder->verify($password, $user->getPasswordHash())) {
            throw new \Exception('Bad credentials');
        }

        $this->auth->setUser($user);
    }
}