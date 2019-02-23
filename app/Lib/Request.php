<?php

namespace App\Lib;

class Request
{
    /** @var array */
    private $request;

    /** @var array */
    private $server;

    /** @var array */
    private $session;

    public function __construct($request, $server, $session)
    {
        $this->request = $request;
        $this->server = $server;
        $this->session = $session;
    }

    public function getRequestMethod(): string
    {
        $requestMethod = $this->server['REQUEST_METHOD'];

        if ('POST' === $requestMethod && isset($this->request['_method'])) {
            $requestMethod = $this->request['_method'];
        }

        return $requestMethod;
    }

    public function getRequestPath(): string
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }

    public function getRequestParams(): array
    {
        return $this->request;
    }

    public function set($name, $value): void
    {
        $this->request[$name] = $value;
    }

    public function get(string $name, $defaultValue = null)
    {
        return $this->request[$name] ?? $defaultValue;
    }

    public function getSessionParam(string $name, $defaultValue = null)
    {
        return $this->session[$name] ?? $defaultValue;
    }

    public function setSessionParam($name, $value): void
    {
        $this->session[$name] = $value;

        $_SESSION[$name] = $value;
    }
}