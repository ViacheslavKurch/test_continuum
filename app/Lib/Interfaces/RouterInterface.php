<?php

namespace App\Lib\Interfaces;

interface RouterInterface
{
    public function handle(RequestInterface $request, AuthInterface $auth): array;
}