<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\CreatePostServiceInterface;
use App\Lib\Interfaces\PostRepositoryInterface;
use App\Model\Post;

class CreatePostService implements CreatePostServiceInterface
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

    public function execute(string $title, string $text): Post
    {
        $post = new Post($title, $text, new \DateTime());

        $this->postRepository->save($post);

        return $post;
    }
}