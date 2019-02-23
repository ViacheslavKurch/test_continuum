<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\ListPostsServiceInterface;
use App\Lib\Interfaces\PostRepositoryInterface;

class ListPostsService implements ListPostsServiceInterface
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

    public function execute(): array
    {
        return $this->postRepository->getAll();
    }
}