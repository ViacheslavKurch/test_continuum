<?php

namespace App\Lib\Interfaces;

interface RouteInterface
{
    public function getRoute(): string;

    public function getController(): string;

    public function getAction(): string;

    public function needAuthorization(): bool;
}