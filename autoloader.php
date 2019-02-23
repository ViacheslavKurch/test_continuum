<?php

spl_autoload_register(function ($className) {
    $className = str_replace(APP_NAME . '\\', '', $className);

    $filename = APP_DIRECTORY . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    require_once $filename;
});