<?php

namespace App\Services;

use App\Repository\Interfaces\PostRepositoryInterface;
use App\Services\Interfaces\DeletePostServiceInterface;

final class DeletePostService implements DeletePostServiceInterface
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
     */
    public function execute(int $id): void
    {
        $this->postRepository->delete($id);
    }
}