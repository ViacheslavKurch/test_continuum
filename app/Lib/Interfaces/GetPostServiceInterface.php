<?php

namespace App\Lib\Interfaces;

use App\Model\Post;

interface GetPostServiceInterface
{
    public function execute(int $id): Post;
}