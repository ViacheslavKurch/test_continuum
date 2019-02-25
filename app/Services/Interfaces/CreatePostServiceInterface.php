<?php

namespace App\Services\Interfaces;

use App\Models\Post;

interface CreatePostServiceInterface
{
    public function execute(string $title, string $text): Post;
}