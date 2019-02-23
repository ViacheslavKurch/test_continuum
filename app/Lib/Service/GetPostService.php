<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\GetPostServiceInterface;
use App\Lib\Interfaces\PostRepositoryInterface;
use App\Model\Post;

class GetPostService implements GetPostServiceInterface
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

    public function execute(int $id): Post
    {
        return $this->postRepository->get($id);
    }
}