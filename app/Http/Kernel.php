<?php
protected $routeMiddleware = [
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'auth' => \App\Http\Middleware\Authenticate::class,
];
