<?php

namespace App\Lib\Interfaces;

interface ViewInterface
{
    public function render(string $view, array $parameters = []): string;
}