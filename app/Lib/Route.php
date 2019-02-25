<?php

namespace App\Lib;

use App\Lib\Interfaces\RouteInterface;

final class Route implements RouteInterface
{
    /** @var string */
    private $route;

    /** @var string */
    private $controller;

    /** @var string */
    private $action;

    /** @var bool */
    private $needAuthorization;

    /**
     * Route constructor.
     * @param string $route
     * @param string $controller
     * @param string $action
     * @param bool $needAuthorization
     */
    public function __construct(
        string $route,
        string $controller,
        string $action,
        bool $needAuthorization
    )
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->action = $action;
        $this->needAuthorization = $needAuthorization;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return bool
     */
    public function needAuthorization(): bool
    {
        return $this->needAuthorization;
    }
}