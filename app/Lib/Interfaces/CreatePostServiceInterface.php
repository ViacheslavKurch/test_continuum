<?php

namespace App\Lib\Interfaces;

use App\Model\Post;

interface CreatePostServiceInterface
{
    public function execute(string $title, string $text): Post;
}