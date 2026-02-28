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

        $home = parent::components(parent::dir_base() . '/home.php');
        $skills = parent::components(parent::dir_base() . '/skills.php');


        $menu = parent::components(parent::dir_base() . '/components/menu.php');
        $social = parent::components(parent::dir_base() . '/components/social.php');


        $html->set([
            'title' => 'Meu Portfolio',
            'menu' => $menu,
            'social' => $social,
            'home' => $home,
            'skills' => $skills
        ])

        ->display();
    }
}