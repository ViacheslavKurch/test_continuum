<?php

namespace App\Services;

use App\Repository\Interfaces\PostRepositoryInterface;
use App\Services\Interfaces\UpdatePostServiceInterface;

final class UpdatePostService implements UpdatePostServiceInterface
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
     * @param string $id
     * @param string $title
     * @param string $text
     * @throws \Exception
     */
    public function execute(string $id, string $title, string $text): void
    {
        $post = $this->postRepository->get($id);

        $post->update($title, $text);

        $this->postRepository->save($post);
    }
}