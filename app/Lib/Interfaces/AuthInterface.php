<?php

namespace App\Lib\Interfaces;

use App\Model\User;

interface AuthInterface
{
    public function setUser(User $user): void;

    public function isAuthorized(): bool;
}