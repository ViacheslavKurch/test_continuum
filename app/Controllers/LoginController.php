<?php

namespace App\Controllers;

use App\Lib\View;
use App\Lib\Request;
use App\Services\Interfaces\LoginUserServiceInterface;

class LoginController extends MainController
{
    /** @var View */
    private $view;

    /** @var LoginUserServiceInterface */
    private $loginUserService;

    /**
     * LoginController constructor.
     * @param View $view
     * @param LoginUserServiceInterface $loginUserService
     */
    public function __construct(
        View $view,
        LoginUserServiceInterface $loginUserService
    )
    {
        $this->view = $view;
        $this->loginUserService = $loginUserService;
    }

    /**
     * @return string
     */
    public function show()
    {
        return $this->view->render('auth.login');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->loginUserService->execute(
            $request->get('email'),
            $request->get('password')
        );

        $this->redirect('/');
    }

    public function logout()
    {
        session_destroy();

        $this->redirect('/');
    }
}