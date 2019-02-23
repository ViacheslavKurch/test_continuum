<?php

namespace App\Controller;

use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\CreatePostServiceInterface;
use App\Lib\Interfaces\DeletePostServiceInterface;
use App\Lib\Interfaces\GetPostServiceInterface;
use App\Lib\Interfaces\ListPostsServiceInterface;
use App\Lib\Interfaces\UpdatePostServiceInterface;
use App\Lib\View;
use App\Lib\Request;

class BlogController
{
    use RedirectTrait;

    /** @var View */
    private $view;

    /** @var AuthInterface */
    private $auth;

    /** @var GetPostServiceInterface */
    private $getPostService;

    /** @var ListPostsServiceInterface */
    private $listPostsService;

    /** @var UpdatePostServiceInterface */
    private $updatePostService;

    /** @var DeletePostServiceInterface */
    private $deletePostService;

    /** @var CreatePostServiceInterface */
    private $createPostService;

    /**
     * BlogController constructor.
     * @param View $view
     * @param AuthInterface $auth
     * @param GetPostServiceInterface $getPostService
     * @param ListPostsServiceInterface $listPostsService
     * @param UpdatePostServiceInterface $updatePostService
     * @param DeletePostServiceInterface $deletePostService
     * @param CreatePostServiceInterface $createPostService
     */
    public function __construct(View $view, AuthInterface $auth, GetPostServiceInterface $getPostService, ListPostsServiceInterface $listPostsService, UpdatePostServiceInterface $updatePostService, DeletePostServiceInterface $deletePostService, CreatePostServiceInterface $createPostService)
    {
        $this->view = $view;
        $this->auth = $auth;
        $this->getPostService = $getPostService;
        $this->listPostsService = $listPostsService;
        $this->updatePostService = $updatePostService;
        $this->deletePostService = $deletePostService;
        $this->createPostService = $createPostService;
    }

    public function index()
    {
        $posts = $this->listPostsService->execute();

        return $this->view->render('post.list', [
            'posts' => $posts,
            'pageTitle' => 'Posts list'
        ]);
    }

    public function show(Request $request)
    {
        $id = $request->get('id');

        $post = $this->getPostService->execute($id);

        return $this->view->render('post.show', [
            'post' => $post,
            'pageTitle' => 'Post page'
        ]);
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');

        $post = $this->getPostService->execute($id);

        return $this->view->render('post.edit', [
            'post' => $post,
            'pageTitle' => 'Edit post page'
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        $this->updatePostService->execute(
            $id,
            $request->get('title', ''),
            $request->get('text', '')
        );

        $this->redirect('/post/' . $id);
    }

    public function create()
    {
        return $this->view->render('post.create', [
            'pageTitle' => 'Post page'
        ]);
    }

    public function store(Request $request)
    {
        $post = $this->createPostService->execute(
            $request->get('title', ''),
            $request->get('text', '')
        );

        $this->redirect('/post/' . $post->getId());
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');

        $this->deletePostService->execute($id);

        $this->redirect('/');
    }
}