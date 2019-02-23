<?php

namespace App\Lib\Interfaces;

interface DeletePostServiceInterface
{
    public function execute(int $id): void;
}