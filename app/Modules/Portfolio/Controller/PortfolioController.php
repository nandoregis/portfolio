<?php

namespace app\Modules\Portfolio\Controller;

use app\Controller\Controller;

class PortfolioController extends Controller
{
 
    public function __construct() {

        parent::__construct();
        parent::set_static_dir_view('Modules/Portfolio/View/');

    }

    public function index(Object $req)
    {   
        $html = parent::html_render()->load('index.php');
        $html->set([
            'title' => 'Meu Portfolio',
        ])

        ->display();
    }
}