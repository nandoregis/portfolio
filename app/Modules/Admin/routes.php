<?php

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
        
    ];

