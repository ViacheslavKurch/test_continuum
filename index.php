<?php

session_start();

require_once './config.php';

$routing = include('./routing.php');
$dbConnection = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT .';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);

$container = new \App\Lib\Container();

$container
    ->register('controllers.blog', \App\Controller\BlogController::class, ['@app.view', '@app.auth', '@app.getPostService', '@app.listPostsService', '@app.updatePostService', '@app.deletePostService', '@app.createPostService'])
    ->register('controllers.login', \App\Controller\LoginController::class, ['@app.view', '@app.loginUserService'])
    ->register('controllers.register', \App\Controller\RegisterController::class, ['@app.view', '@app.registerUserService'])
    ->register('app.request', \App\Lib\Request::class, [$_REQUEST, $_SERVER, $_SESSION])
    ->register('app.router', \App\Lib\Router::class, [$routing])
    ->register('app.view', \App\Lib\View::class, [VIEWS_DIRECTORY, '@app.auth'])
    ->register('app.auth', \App\Lib\Auth::class, ['@app.request', '@app.userRepository'])
    ->register('app.auth.passwordEncoder', \App\Lib\Service\PasswordEncoderService::class)
    ->register('app.loginUserService', \App\Lib\Service\LoginUserService::class, ['@app.userRepository', '@app.auth.passwordEncoder', '@app.auth'])
    ->register('app.registerUserService', \App\Lib\Service\RegisterUserService::class, ['@app.userRepository', '@app.auth.passwordEncoder'])
    ->register('app.postDataMapper', \App\Lib\PostDataMapper::class)
    ->register('app.userDataMapper', \App\Lib\UserDataMapper::class)
    ->register('app.pdoAdapter', \App\Lib\PDOAdapter::class, [$dbConnection])
    ->register('app.postRepository', \App\Lib\Repository\PostRepository::class, ['@app.pdoAdapter', '@app.postDataMapper'])
    ->register('app.userRepository', \App\Lib\Repository\UserRepository::class, ['@app.pdoAdapter', '@app.userDataMapper'])
    ->register('app.getPostService', \App\Lib\Service\GetPostService::class, ['@app.postRepository'])
    ->register('app.listPostsService', \App\Lib\Service\ListPostsService::class, ['@app.postRepository'])
    ->register('app.updatePostService', \App\Lib\Service\UpdatePostService::class, ['@app.postRepository'])
    ->register('app.deletePostService', \App\Lib\Service\DeletePostService::class, ['@app.postRepository'])
    ->register('app.createPostService', \App\Lib\Service\CreatePostService::class, ['@app.postRepository']);

try {
    (new \App\Application($container))->run($container);
} catch (Exception $exception) {
    echo 'Error : ' . $exception->getMessage();
}
