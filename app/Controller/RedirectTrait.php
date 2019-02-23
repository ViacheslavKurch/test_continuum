<?php

namespace App\Controller;

trait RedirectTrait
{
    public function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }
}