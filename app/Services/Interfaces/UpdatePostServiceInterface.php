<?php

namespace App\Services\Interfaces;

interface UpdatePostServiceInterface
{
    public function execute(string $id, string $title, string $text): void;
}