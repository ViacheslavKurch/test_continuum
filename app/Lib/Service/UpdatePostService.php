<?php

namespace App\Lib\Service;

use App\Lib\Interfaces\PostRepositoryInterface;
use App\Lib\Interfaces\UpdatePostServiceInterface;

class UpdatePostService implements UpdatePostServiceInterface
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

    public function execute(string $id, string $title, string $text): void
    {
        $post = $this->postRepository->get($id);

        $post->update($title, $text);

        $this->postRepository->save($post);
    }
}