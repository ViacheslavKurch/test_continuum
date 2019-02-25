<?php

namespace App;

use App\Lib\Auth;
use App\Lib\Router;
use App\Lib\Request;
use App\Lib\Container;

final class Application
{
    /** @var Container */
    private $container;

    /**
     * Application constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @throws \Exception
     */
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