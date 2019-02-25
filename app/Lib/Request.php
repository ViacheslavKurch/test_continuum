<?php

namespace App\Lib;

use App\Lib\Interfaces\RequestInterface;

final class Request implements RequestInterface
{
    /** @var array */
    private $request;

    /** @var array */
    private $server;

    /** @var array */
    private $session;

    /**
     * Request constructor.
     * @param array $request
     * @param array $server
     * @param array $session
     */
    public function __construct(
        array $request,
        array $server,
        array $session
    )
    {
        $this->request = $request;
        $this->server = $server;
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        $requestMethod = $this->server['REQUEST_METHOD'];

        if ('POST' === $requestMethod && isset($this->request['_method'])) {
            $requestMethod = $this->request['_method'];
        }

        return $requestMethod;
    }

    /**
     * @return string
     */
    public function getRequestPath(): string
    {
        return parse_url($this->server['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * @return array
     */
    public function getRequestParams(): array
    {
        return $this->request;
    }

    /**
     * @param string $name
     * @param null $defaultValue
     * @return mixed|null
     */
    public function get(string $name, $defaultValue = null)
    {
        return $this->request[$name] ?? $defaultValue;
    }

    /**
     * @param string $name
     * @param null $defaultValue
     * @return mixed|null
     */
    public function getSessionParam(string $name, $defaultValue = null)
    {
        return $this->session[$name] ?? $defaultValue;
    }

    /**
     * @param $name
     * @param $value
     */
    public function setSessionParam($name, $value): void
    {
        $this->session[$name] = $value;

        $_SESSION[$name] = $value;
    }

    /**
     * @param $name
     * @param $value
     */
    public function set($name, $value): void
    {
        $this->request[$name] = $value;
    }
}