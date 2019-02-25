<?php

namespace App\Controllers;

use App\Lib\View;
use App\Lib\Request;
use App\Lib\Interfaces\AuthInterface;
use App\Services\Interfaces\GetPostServiceInterface;
use App\Services\Interfaces\ListPostsServiceInterface;
use App\Services\Interfaces\CreatePostServiceInterface;
use App\Services\Interfaces\DeletePostServiceInterface;
use App\Services\Interfaces\UpdatePostServiceInterface;

class BlogController extends MainController
{
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
    public function __construct(
        View $view,
        AuthInterface $auth,
        GetPostServiceInterface $getPostService,
        ListPostsServiceInterface $listPostsService,
        UpdatePostServiceInterface $updatePostService,
        DeletePostServiceInterface $deletePostService,
        CreatePostServiceInterface $createPostService
    )
    {
        $this->view = $view;
        $this->auth = $auth;
        $this->getPostService = $getPostService;
        $this->listPostsService = $listPostsService;
        $this->updatePostService = $updatePostService;
        $this->deletePostService = $deletePostService;
        $this->createPostService = $createPostService;
    }

    /**
     * @return string
     */
    public function index()
    {
        $posts = $this->listPostsService->execute();

        return $this->view->render('post.list', [
            'posts'     => $posts,
            'pageTitle' => 'Posts list'
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function show(Request $request)
    {
        $id = $request->get('id');

        $post = $this->getPostService->execute($id);

        return $this->view->render('post.show', [
            'post'      => $post,
            'pageTitle' => 'Post page'
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');

        $post = $this->getPostService->execute($id);

        return $this->view->render('post.edit', [
            'post'      => $post,
            'pageTitle' => 'Edit post page'
        ]);
    }

    /**
     * @param Request $request
     */
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

    /**
     * @return string
     */
    public function create()
    {
        return $this->view->render('post.create', [
            'pageTitle' => 'Post page'
        ]);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $post = $this->createPostService->execute(
            $request->get('title', ''),
            $request->get('text', '')
        );

        $this->redirect('/post/' . $post->getId());
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');

        $this->deletePostService->execute($id);

        $this->redirect('/');
    }
}