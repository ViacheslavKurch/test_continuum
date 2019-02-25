<?php

namespace App\Lib;

use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\RouterInterface;
use App\Lib\Interfaces\RequestInterface;

final class Router implements RouterInterface
{
    /** @var array */
    private $routes;

    /**
     * Router constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param RequestInterface $request
     * @param AuthInterface $auth
     * @return array
     * @throws \Exception
     */
    public function handle(RequestInterface $request, AuthInterface $auth): array
    {
        $requestMethod = $request->getRequestMethod();
        $requestPath = $request->getRequestPath();

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $this->routeMatchRequestPath($route['path'], $requestPath)) {

                if (true === $route['auth'] && false === $auth->isAuthorized()) {
                    throw new \Exception('Not authorized');
                }

                $this->setRouteNamedParametersValuesToRequest($route['path'], $requestPath, $request);

                return explode('::', $route['controller']);
            }
        }

        throw new \Exception('Route not found');
    }

    /**
     * @param string $route
     * @param string $requestPath
     * @return bool
     */
    private function routeMatchRequestPath(string $route, string $requestPath): bool
    {
        $routePattern = $this->getRoutePattern($route);

        if (null !== $routePattern) {
            return preg_match($routePattern, $requestPath);
        }

        return $route === $requestPath;
    }

    /**
     * @param string $route
     * @param string $requestPath
     * @param Request $request
     */
    private function setRouteNamedParametersValuesToRequest(string $route, string $requestPath, Request $request): void
    {
        $routePattern = $this->getRoutePattern($route);

        if (null !== $routePattern && false !== preg_match($routePattern, $requestPath, $requestMatches)) {
            if (false !== preg_match_all('/{(\w+)}/', $route, $routeMatches)) {
                for ($i = 0; $i < count($routeMatches[1]); $i++) {
                    $request->set(
                        $routeMatches[1][$i],
                        $requestMatches[1][$i]
                    );
                }
            }
        }
    }

    /**
     * @param string $route
     * @return string|null
     */
    private function getRoutePattern(string $route): ?string
    {
        $routePattern = preg_replace('/{(\w+)}/', '(\d+)',  $route,  -1,  $count);

        if ($count > 0) {
            $routePattern = sprintf('~^%s$~', $routePattern);

            return $routePattern;
        }

        return null;
    }
}