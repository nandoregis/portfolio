<?php

use app\Modules\Portfolio\Controller\PortfolioController;

    return [
        [   
            "route" => "/",
            "controller" => new PortfolioController,
            "method" => "index",
            "http" => ["GET"],
            "middlewares" => [],
            "active" => true
        ],
        
    ];

