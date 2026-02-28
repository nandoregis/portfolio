<?php

use app\Middleware\CacheMiddleware;
use app\Middleware\RedirectIfAuthenticatedMiddleware;
use app\Middleware\RedirectIfLogoutMiddleware;
use app\Modules\Auth\Controller\AuthController;

    return [
        [   
            "route" => "/",
            "controller" => new AuthController,
            "method" => "index",
            "http" => ["GET", "POST"],
            "middlewares" => [new CacheMiddleware, new RedirectIfAuthenticatedMiddleware],
            "active" => true
        ],
         [   
            "route" => "/logout",
            "controller" => new AuthController,
            "method" => "logout",
            "http" => ["GET"],
            "middlewares" => [new RedirectIfLogoutMiddleware],
            "active" => true
        ]
    ];

