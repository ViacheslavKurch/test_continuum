<?php

namespace App\Lib\Repository;

use App\Lib\Interfaces\PostDataMapperInterface;
use App\Lib\Interfaces\PostRepositoryInterface;
use App\Lib\Interfaces\StorageAdapterInterface;
use App\Model\Post;

class PostRepository implements PostRepositoryInterface
{
    private const TABLE_NAME = 'posts';

    /** @var StorageAdapterInterface */
    private $storageAdapter;

    /** @var PostDataMapperInterface */
    private $postDataMapper;

    /**
     * PostRepository constructor.
     * @param StorageAdapterInterface $storageAdapter
     * @param PostDataMapperInterface $postDataMapper
     */
    public function __construct(StorageAdapterInterface $storageAdapter, PostDataMapperInterface $postDataMapper)
    {
        $this->storageAdapter = $storageAdapter;
        $this->postDataMapper = $postDataMapper;
    }

    public function get(int $id): Post
    {
        $postData = $this->storageAdapter->get(static::TABLE_NAME, $id);

        if (null === $postData) {
            throw new \Exception('Post not found');
        }

        return $this->postDataMapper->mapRowToObject($postData);
    }

    public function delete(int $id): void
    {
        $this->storageAdapter->delete(static::TABLE_NAME, $id);
    }

    public function save(Post $post): void
    {
        $postData = $this->postDataMapper->mapObjectToRow($post);

        if (null === $post->getId()) {
            $id = $this->storageAdapter->insert(static::TABLE_NAME, $postData);
            $post->setId($id);
        } else {
            $this->storageAdapter->update(static::TABLE_NAME, $post->getId(), $postData);
        }
    }

    public function getAll(): array
    {
        $rowPosts = $this->storageAdapter->getAll(static::TABLE_NAME);

        $posts = array_map(function ($post) {
            return $this->postDataMapper->mapRowToObject($post);
        },  $rowPosts);

        return $posts;
    }
}