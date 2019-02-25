<?php

namespace App\Mapping\Interfaces;

use App\Models\Post;

interface PostDataMapperInterface
{
    public function mapObjectToRow(Post $post): array;

    public function mapRowToObject(array $data): Post;
}