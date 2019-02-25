<?php

namespace App\Services\Interfaces;

use App\Models\Post;

interface GetPostServiceInterface
{
    public function execute(int $id): Post;
}