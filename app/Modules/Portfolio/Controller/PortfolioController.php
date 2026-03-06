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

        $arrCardSkills = [
            [
                'tecnologia' => 'HTML',
                'descricao' => '6 anos entre estudo e prática na programação.',
                'icon' => 'fa-brands fa-html5',
                'color' => 'rgb(227, 76, 38);'
            ],

            [
                'tecnologia' => 'CSS',
                'descricao' => '6 anos entre estudo e prática na programação.',
                'icon' => 'fa-brands fa-css3',
                'color' => '#3e509e;'
            ],
            [
                'tecnologia' => 'Javascript',
                'descricao' => '6 anos entre estudo e prática na programação.',
                'icon' => 'fa-brands fa-js',
                'color' => 'yellow;'
            ],

        ];
        
        $card_skills = "";

        foreach ($arrCardSkills as $key => $value) {
            $card_skills .= parent::components(parent::dir_base() . '/components/card-skills.php', $value);
        }

        $home = parent::components(parent::dir_base() . '/home.php');
        $skills = parent::components(parent::dir_base() . '/skills.php', [
            'card_skills' => $card_skills

        ]);

        $projetos = parent::components(parent::dir_base() . '/projetos.php');


        $menu = parent::components(parent::dir_base() . '/components/menu.php');
        $social = parent::components(parent::dir_base() . '/components/social.php');

        $html->set([
            'title' => 'Meu Portfolio',
            'menu' => $menu,
            'social' => $social,
            'home' => $home,
            'skills' => $skills,
            'projetos' => $projetos,
            
        ])

        ->display();
    }
}
