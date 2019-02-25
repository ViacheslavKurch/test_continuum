<?php

namespace App\Mapping;

use DateTime;
use App\Models\Post;
use App\Mapping\Interfaces\PostDataMapperInterface;

final class PostDataMapper implements PostDataMapperInterface
{
    /**
     * @param Post $post
     * @return array
     */
    public function mapObjectToRow(Post $post): array
    {
        return [
            'id'         => $post->getId(),
            'title'      => $post->getTitle(),
            'text'       => $post->getText(),
            'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $post->getUpdatedAt() ? $post->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ];
    }

    /**
     * @param array $data
     * @return Post
     * @throws \Exception
     */
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