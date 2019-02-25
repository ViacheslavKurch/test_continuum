<?php

namespace App\Services;

use App\Services\Interfaces\ListPostsServiceInterface;
use App\Repository\Interfaces\PostRepositoryInterface;

final class ListPostsService implements ListPostsServiceInterface
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
     * @return array
     */
    public function execute(): array
    {
        return $this->postRepository->getAll();
    }
}