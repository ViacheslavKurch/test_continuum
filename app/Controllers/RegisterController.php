<?php

namespace App\Controllers;

use App\Lib\View;
use App\Lib\Request;
use App\Services\Interfaces\RegisterUserServiceInterface;

class RegisterController extends MainController
{
    /** @var View */
    private $view;

    /** @var RegisterUserServiceInterface */
    private $registerUserService;

    /**
     * RegisterController constructor.
     * @param View $view
     * @param RegisterUserServiceInterface $registerUserService
     */
    public function __construct(View $view, RegisterUserServiceInterface $registerUserService)
    {
        $this->view = $view;
        $this->registerUserService = $registerUserService;
    }

    /**
     * @return string
     */
    public function show()
    {
        return $this->view->render('auth.register');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->registerUserService->execute(
            $request->get('email'),
            $request->get('password')
        );

        $this->redirect('/login');
    }
}