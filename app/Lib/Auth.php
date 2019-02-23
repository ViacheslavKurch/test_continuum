<?php

namespace App\Lib;

use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\UserRepositoryInterface;
use App\Model\User;

class Auth implements AuthInterface
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

    public function init()
    {
        $userId = $this->request->getSessionParam('userId');

        if (null !== $userId) {
            $user = $this->userRepository->get($userId);
            $this->setUser($user);
        }
    }

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->request->setSessionParam('userId', $user->getId());
    }

    public function isAuthorized(): bool
    {
        return null !== $this->user;
    }
}