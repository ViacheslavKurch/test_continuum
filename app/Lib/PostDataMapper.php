<?php

namespace App\Lib;

use App\Lib\Interfaces\PostDataMapperInterface;
use DateTime;
use App\Model\Post;

class PostDataMapper implements PostDataMapperInterface
{
    public function mapObjectToRow(Post $post): array
    {
        return [
            'id' => $post->getId(),
            'title' => $post->getTitle(),
            'text' => $post->getText(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $post->getUpdatedAt() ? $post->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ];
    }

    public function mapRowToObject(array $data): Post
    {
        $post = new Post(
            $data['title'],
            $data['text'],
            new DateTime($data['created_at']),
            $data['updated_at'] ? new DateTime($data['updated_at']) : null
        );

        $post->setId($data['id']);

        return $post;
    }
}