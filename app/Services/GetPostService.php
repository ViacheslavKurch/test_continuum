<?php

namespace App\Services;

use App\Models\Post;
use App\Services\Interfaces\GetPostServiceInterface;
use App\Repository\Interfaces\PostRepositoryInterface;

final class GetPostService implements GetPostServiceInterface
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
     * @param int $id
     * @return Post
     */
    public function execute(int $id): Post
    {
        return $this->postRepository->get($id);
    }
}