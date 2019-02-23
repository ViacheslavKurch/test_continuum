<?php

namespace App\Controller;

use App\Lib\Interfaces\RegisterUserServiceInterface;
use App\Lib\Request;
use App\Lib\View;

class RegisterController
{
    use RedirectTrait;

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

    public function show()
    {
        return $this->view->render('auth.register');
    }

    public function store(Request $request)
    {
        $this->registerUserService->execute(
            $request->get('email'),
            $request->get('password')
        );

        $this->redirect('/login');
    }
}