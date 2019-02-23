<?php

return [
    'blog.post.list' => [
        'path' => '/',
        'method' => 'GET',
        'controller' => 'controllers.blog::index',
        'auth' => false,
    ],
    'blog.post.get' => [
        'path' => '/post/{id}',
        'method' => 'GET',
        'controller' => 'controllers.blog::show',
        'auth' => false,
    ],
    'blog.post.edit' => [
        'path' => '/post/{id}/edit',
        'method' => 'GET',
        'controller' => 'controllers.blog::edit',
        'auth' => true,
    ],
    'blog.post.create' => [
        'path' => '/post',
        'method' => 'GET',
        'controller' => 'controllers.blog::create',
        'auth' => true,
    ],
    'blog.post.store' => [
        'path' => '/post',
        'method' => 'POST',
        'controller' => 'controllers.blog::store',
        'auth' => true,
    ],
    'blog.post.update' => [
        'path' => '/post/{id}',
        'method' => 'PUT',
        'controller' => 'controllers.blog::update',
        'auth' => true,
    ],
    'blog.post.delete' => [
        'path' => '/post/{id}',
        'method' => 'DELETE',
        'controller' => 'controllers.blog::delete',
        'auth' => true,
    ],
    'blog.user.login.get' => [
        'path' => '/login',
        'method' => 'GET',
        'controller' => 'controllers.login::show',
        'auth' => false,
    ],
    'blog.user.login.store' => [
        'path' => '/login',
        'method' => 'POST',
        'controller' => 'controllers.login::store',
        'auth' => false,
    ],
    'blog.user.register.get' => [
        'path' => '/register',
        'method' => 'GET',
        'controller' => 'controllers.register::show',
        'auth' => false,
    ],
    'blog.user.register.store' => [
        'path' => '/register',
        'method' => 'POST',
        'controller' => 'controllers.register::store',
        'auth' => false,
    ],
    'blog.user.logout' => [
        'path' => '/logout',
        'method' => 'GET',
        'controller' => 'controllers.login::logout',
        'auth' => true,
    ],
];