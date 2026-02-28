<?php

require '../router.php';
use app\Core\Web;

$routes = new Web;


get('/', 'app/Pages/index.php');

$routes->run();

any('/404', 'app/Pages/404.php');