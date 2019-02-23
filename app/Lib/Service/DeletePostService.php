<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\DeletePostServiceInterface;
use App\Lib\Interfaces\PostRepositoryInterface;

class DeletePostService implements DeletePostServiceInterface
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

    public function execute(int $id): void
    {
        $this->postRepository->delete($id);
    }
}