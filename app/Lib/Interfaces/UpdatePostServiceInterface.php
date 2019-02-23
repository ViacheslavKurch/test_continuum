<?php

namespace App\Lib\Interfaces;

interface UpdatePostServiceInterface
{
    public function execute(string $id, string $title, string $text): void;
}