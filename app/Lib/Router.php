<?php

namespace App\Lib;

class Router
{
    /** @var array */
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function handle(Request $request, Auth $auth): array
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

    private function routeMatchRequestPath(string $route, string $requestPath): bool
    {
        $routePattern = $this->getRoutePattern($route);

        if (null !== $routePattern) {
            return preg_match($routePattern, $requestPath);
        }

        return $route === $requestPath;
    }

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