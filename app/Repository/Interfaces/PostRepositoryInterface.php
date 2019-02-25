<?php

namespace App\Repository\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function get(int $id): Post;

    public function delete(int $id): void;

    public function save(Post $post): void;

    public function getAll(): array;
}