<?php

namespace App\Lib\Interfaces;

use App\Model\Post;

interface PostDataMapperInterface
{
    public function mapObjectToRow(Post $post): array;

    public function mapRowToObject(array $data): Post;
}