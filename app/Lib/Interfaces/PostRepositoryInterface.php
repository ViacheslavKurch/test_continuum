<?php

namespace App\Lib\Interfaces;

use App\Model\Post;

interface PostRepositoryInterface
{
    public function get(int $id): Post;

    public function delete(int $id): void;

    public function save(Post $post): void;

    public function getAll(): array;
}