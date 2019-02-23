<?php

namespace App\Controller;

use App\Lib\Interfaces\LoginUserServiceInterface;
use App\Lib\Request;
use App\Lib\View;

class LoginController
{
    use RedirectTrait;

    /** @var View */
    private $view;

    /** @var LoginUserServiceInterface */
    private $loginUserService;

    /**
     * LoginController constructor.
     * @param View $view
     * @param LoginUserServiceInterface $loginUserService
     */
    public function __construct(View $view, LoginUserServiceInterface $loginUserService)
    {
        $this->view = $view;
        $this->loginUserService = $loginUserService;
    }

    public function show()
    {
        return $this->view->render('auth.login');
    }

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