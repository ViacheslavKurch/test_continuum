<?php

$routing = include('./routing.php');

return [
    'app.postRepository' => [
        'class' => \App\Repository\PostRepository::class,
        'arguments' => [
            '@app.pdoAdapter',
            '@app.postDataMapper'
        ]
    ],
    'app.userRepository' => [
        'class' => \App\Repository\UserRepository::class,
        'arguments' => [
            '@app.pdoAdapter',
            '@app.userDataMapper'
        ]
    ],
    'app.getPostService' => [
        'class' => \App\Services\GetPostService::class,
        'arguments' => [
            '@app.postRepository'
        ]
    ],
    'app.listPostsService' => [
        'class' => \App\Services\ListPostsService::class,
        'arguments' => [
            '@app.postRepository'
        ]
    ],
    'app.updatePostService' => [
        'class' => \App\Services\UpdatePostService::class,
        'arguments' => [
            '@app.postRepository'
        ]
    ],
    'app.deletePostService' => [
        'class' => \App\Services\DeletePostService::class,
        'arguments' => [
            '@app.postRepository'
        ]
    ],
    'app.createPostService' => [
        'class' => \App\Services\CreatePostService::class,
        'arguments' => [
            '@app.postRepository'
        ]
    ],
    'app.request' => [
        'class' => \App\Lib\Request::class,
        'arguments' => [
            $_REQUEST,
            $_SERVER,
            $_SESSION
        ]
    ],
    'app.router' => [
        'class' => \App\Lib\Router::class,
        'arguments' => [
            $routing
        ]
    ],
    'app.view' => [
        'class' => \App\Lib\View::class,
        'arguments' => [
            VIEWS_DIRECTORY,
            '@app.auth'
        ]
    ],
    'app.auth' => [
        'class' => \App\Lib\Auth::class,
        'arguments' => [
            '@app.request',
            '@app.userRepository'
        ]
    ],
    'app.auth.passwordEncoder' => [
        'class' => \App\Services\PasswordEncoderService::class,
        'arguments' => [],
    ],
    'app.loginUserService' => [
        'class' => \App\Services\LoginUserService::class,
        'arguments' => [
            '@app.userRepository',
            '@app.auth.passwordEncoder',
            '@app.auth'
        ]
    ],
    'app.registerUserService' => [
        'class' => \App\Services\RegisterUserService::class,
        'arguments' => [
            '@app.userRepository',
            '@app.auth.passwordEncoder'
        ]
    ],
    'app.postDataMapper' => [
        'class' => \App\Mapping\PostDataMapper::class,
        'arguments' => []
    ],
    'app.userDataMapper' => [
        'class' => \App\Mapping\UserDataMapper::class,
        'arguments' => []
    ],
    'app.pdoAdapter' => [
        'class' => \App\Lib\PDOAdapter::class,
        'arguments' => [
            $dbConnection
        ]
    ],
    'controllers.blog' => [
        'class' => \App\Controllers\BlogController::class,
        'arguments' => [
            '@app.view',
            '@app.auth',
            '@app.getPostService',
            '@app.listPostsService',
            '@app.updatePostService',
            '@app.deletePostService',
            '@app.createPostService'
        ]
    ],
    'controllers.login' => [
        'class' => \App\Controllers\LoginController::class,
        'arguments' => [
            '@app.view',
            '@app.loginUserService'
        ]
    ],
    'controllers.register' => [
        'class' => \App\Controllers\RegisterController::class,
        'arguments' => [
            '@app.view',
            '@app.registerUserService'
        ]
    ],
];