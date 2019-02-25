<?php

namespace App\Controllers;

abstract class MainController
{
    /**
     * @param string $url
     */
    public function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }
}