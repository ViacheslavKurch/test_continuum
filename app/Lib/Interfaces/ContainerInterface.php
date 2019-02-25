<?php

namespace App\Lib\Interfaces;

interface ContainerInterface
{
    public function getService(string $serviceAlias): object;
}