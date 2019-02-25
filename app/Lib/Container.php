<?php

namespace App\Lib;

use App\Lib\Interfaces\ContainerInterface;

final class Container implements ContainerInterface
{
    /** @var array */
    private $services = [];

    /** @var array */
    private $servicesStore = [];

    /**
     * Container constructor.
     * @param array $services
     * @throws \Exception
     */
    public function __construct(array $services)
    {
        foreach ($services as $alias => $service) {
            $this->register($alias, $service['class'], $service['arguments']);
        }
    }

    /**
     * @param string $serviceAlias
     * @param string $className
     * @param array $arguments
     * @return Container
     * @throws \Exception
     */
    private function register(
        string $serviceAlias,
        string $className,
        array $arguments = []
    ): ContainerInterface
    {
        if (true === $this->hasService($serviceAlias)) {
            throw new \Exception('Service ' . $serviceAlias . 'with same alias already exists');
        }

        if (false === class_exists($className)) {
            throw new \Exception('Class ' . $className . 'does not exist');
        }

        $this->services[$serviceAlias] = [
            'class'     => $className,
            'arguments' => $arguments
        ];

        return $this;
    }

    /**
     * @param string $serviceAlias
     * @return object
     * @throws \Exception
     */
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

    /**
     * @param string $serviceAlias
     * @return bool
     */
    private function hasService(string $serviceAlias): bool
    {
        return isset($this->services[$serviceAlias]);
    }

    /**
     * @param string $serviceAlias
     * @return object
     * @throws \Exception
     */
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