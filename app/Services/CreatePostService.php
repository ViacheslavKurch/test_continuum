<?php

namespace App\Services;

use App\Models\Post;
use App\Services\Interfaces\CreatePostServiceInterface;
use App\Repository\Interfaces\PostRepositoryInterface;

final class CreatePostService implements CreatePostServiceInterface
{
    /** @var PostRepositoryInterface */
    private $postRepository;

    /**
     * GetPostService constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param string $title
     * @param string $text
     * @return Post
     * @throws \Exception
     */
    public function execute(string $title, string $text): Post
    {
        $post = new Post($title, $text, new \DateTime());

        $this->postRepository->save($post);

        return $post;
    }
}