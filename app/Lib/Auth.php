<?php

namespace App\Lib;

use App\Models\User;
use App\Lib\Interfaces\AuthInterface;
use App\Repository\Interfaces\UserRepositoryInterface;

final class Auth implements AuthInterface
{
    /** @var Request */
    private $request;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var User | null */
    private $user = null;

    /**
     * Auth constructor.
     * @param Request $request
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(Request $request, UserRepositoryInterface $userRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
    }

    public function init(): void
    {
        $userId = $this->request->getSessionParam('userId');

        if (null !== $userId) {
            $user = $this->userRepository->get($userId);
            $this->setUser($user);
        }
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->request->setSessionParam('userId', $user->getId());
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return null !== $this->user;
    }
}