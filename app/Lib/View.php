<?php

namespace App\Lib;

use App\Lib\Interfaces\AuthInterface;
use App\Lib\Interfaces\ViewInterface;

final class View implements ViewInterface
{
    /** @var string */
    private $basePath;

    /** @var Auth */
    private $auth;

    /**
     * View constructor.
     * @param $basePath
     * @param AuthInterface $auth
     */
    public function __construct($basePath, AuthInterface $auth)
    {
        $this->basePath = $basePath;
        $this->auth = $auth;
    }

    /**
     * @param string $view
     * @param array $parameters
     * @return string
     */
    public function render(string $view, array $parameters = []): string
    {
        $path = $this->basePath . str_replace('.', '/', $view) . '.php';

        $parameters['isAuthorized'] = $this->auth->isAuthorized();

        $viewContent = $this->getFileContentWithParams($path, $parameters);

        $pageParameters = $parameters;
        $pageParameters['content'] = $viewContent;

        return $this->getFileContentWithParams($this->basePath . 'layout.php', $pageParameters);
    }

    /**
     * @param $filePath
     * @param $parameters
     * @return string
     */
    private function getFileContentWithParams($filePath, $parameters): string
    {
        ob_start();

        extract($parameters);

        require_once $filePath;

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
}