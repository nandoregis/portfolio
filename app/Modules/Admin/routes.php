<?php

use app\Middleware\AuthMiddleware;
use app\Modules\Admin\Controller\AdminApiController;
use app\Modules\Admin\Controller\AdminController;


    return [
        [   
            "route" => "/",
            "controller" => new AdminController,
            "method" => "index",
            "http" => ["GET", "POST"],
            "middlewares" => [],
            "active" => true
        ],
        [   
            "route" => "/v1/api/projetos",
            "controller" => new AdminApiController,
            "method" => "getAllProject",
            "http" => ["GET"],
            "middlewares" => [],
            "active" => true
        ],
        [   
            "route" => "/v1/api/projetos/c/create",
            "controller" => new AdminApiController,
            "method" => "createProject",
            "http" => ["POST"],
            "middlewares" => [new AuthMiddleware],
            "active" => true
        ],
        
        
    ];

