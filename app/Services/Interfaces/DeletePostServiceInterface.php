<?php

namespace App\Services\Interfaces;

interface DeletePostServiceInterface
{
    public function execute(int $id): void;
}