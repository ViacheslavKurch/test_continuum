<?php

namespace App;

use App\Lib\Auth;
use App\Lib\Container;
use App\Lib\Request;
use App\Lib\Router;

class Application
{
    /** @var Container */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run(): void
    {
        /** @var Router $router */
        $router = $this->container->getService('app.router');

        /** @var Request $request */
        $request = $this->container->getService('app.request');

        /** @var Auth $auth */
        $auth = $this->container->getService('app.auth');
        $auth->init();

        $data = $router->handle($request, $auth);

        $controller = $this->container->getService($data[0]);
        $action = $data[1];

        $response = $controller->{$action}($request);

        echo $response;
    }
}