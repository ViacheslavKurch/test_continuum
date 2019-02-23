<?php

namespace App\Lib;

class View
{
    /** @var string */
    private $basePath;

    /** @var Auth */
    private $auth;

    public function __construct($basePath, Auth $auth)
    {
        $this->basePath = $basePath;
        $this->auth = $auth;
    }

    public function render(string $view, array $parameters = [])
    {
        $path = $this->basePath . str_replace('.', '/', $view) . '.php';

        $parameters['isAuthorized'] = $this->auth->isAuthorized();

        $viewContent = $this->getFileContentWithParams($path, $parameters);

        $pageParameters = $parameters;
        $pageParameters['content'] = $viewContent;

        return $this->getFileContentWithParams($this->basePath . 'layout.php', $pageParameters);
    }

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