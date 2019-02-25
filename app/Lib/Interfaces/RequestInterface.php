<?php

namespace App\Lib\Interfaces;

interface RequestInterface
{
    public function getRequestMethod(): string;

    public function getRequestPath(): string;

    public function getRequestParams(): array;

    public function get(string $name, $defaultValue = null);

    public function getSessionParam(string $name, $defaultValue = null);

    public function setSessionParam($name, $value): void;

    public function set($name, $value): void;
}