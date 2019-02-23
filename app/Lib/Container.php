<?php

namespace App\Lib;

class Container
{
    /** @var array */
    private $services;

    /** @var array */
    private $servicesStore;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->services = [];
        $this->servicesStore = [];
    }

    public function register(string $serviceAlias, string $className, array $arguments = []): self
    {
        if (true === $this->hasService($serviceAlias)) {
            throw new \Exception('Service ' . $serviceAlias . 'with same alias already exists');
        }

        if (false === class_exists($className)) {
            throw new \Exception('Class ' . $className . 'does not exist');
        }

        $this->services[$serviceAlias] = [
            'class' => $className,
            'arguments' => $arguments
        ];

        return $this;
    }

    private function hasService(string $serviceAlias): bool
    {
        return isset($this->services[$serviceAlias]);
    }

    public function getService(string $serviceAlias): object
    {
        if (false === $this->hasService($serviceAlias)) {
            throw new \Exception('Service ' . $serviceAlias . ' not found');
        }

        if (false === isset($this->servicesStore[$serviceAlias])) {
            $this->servicesStore[$serviceAlias] = $this->resolveService($serviceAlias);
        }

        return $this->servicesStore[$serviceAlias];
    }

    private function resolveService(string $serviceAlias): object
    {
        $serviceConfig = $this->services[$serviceAlias];

        $className = $serviceConfig['class'];

        $classArguments = [];

        foreach ($serviceConfig['arguments'] as $argument) {
            if (is_string($argument) && $argument[0] === '@') {
                $classArguments[] = $this->getService(ltrim($argument, '@'));
            } else {
                $classArguments[] = $argument;
            }
        }

        return new $className(...$classArguments);
    }
}