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

        $menu = parent::components(parent::dir_base() . '/components/menu.php');
        $social = parent::components(parent::dir_base() . '/components/social.php');

        $html->set([
            'title' => 'Meu Portfolio',
            'menu' => $menu,
            'social' => $social,
            'home' => $this->pageHome(),
            'skills' => $this->pageSkills(),
            'projetos' => $this->pageProjetos(),
            'sobre' => $this->pageSobre()
            
        ])

        ->display();
    }


    public function pageHome() 
    {
       return parent::components(parent::dir_base() . '/home.php');
    }

    public function pageSkills() 
    {   

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

        
        
        return parent::components(parent::dir_base() . '/skills.php', [
            'card_skills' => $card_skills

        ]);

    }

    public function pageProjetos() 
    {   

        $arrProjetos = [
            [
                'img' => 'https://static.vecteezy.com/ti/fotos-gratis/t1/23056329-programador-pessoas-trabalhando-laptops-ou-smartphones-com-ai-artificial-inteligencia-programas-engenheiro-codificacao-em-computador-portatil-computadores-com-tecnologia-icones-e-binario-codigo-grande-dados-ai-robo-digital-maquina-foto.jpg',
                'titulo' => 'Lorem Ipsum',
                'descricao' => 'Sistema de modelo 3D, para camisas em que adiciona estampas em t-shirt.',
                'tecnologias' => [
                    'HTML',
                    'CSS',
                    'Javascript',
                ],
                'demo' => '#',
                'github' => '#'
            ],
            [
                'img' => 'https://i0.wp.com/blog.portaleducacao.com.br/wp-content/uploads/2022/02/365-O-que-e%CC%81-tecnologia_.jpg?fit=740%2C416&ssl=1',
                'titulo' => 'Lorem Ipsum',
                'descricao' => 'Sistema de modelo 3D, para camisas em que adiciona estampas em t-shirt.',
                'tecnologias' => [
                    'HTML',
                    'CSS',
                    'Javascript',
                    'PHP',
                    'Mysql'
                ],
                'demo' => '#',
                'github' => '#'
            ],
            [
                'img' => 'https://i0.wp.com/blog.portaleducacao.com.br/wp-content/uploads/2022/02/365-O-que-e%CC%81-tecnologia_.jpg?fit=740%2C416&ssl=1',
                'titulo' => 'Lorem Ipsum',
                'descricao' => 'Sistema de modelo 3D, para camisas em que adiciona estampas em t-shirt.',
                'tecnologias' => [
                    'HTML',
                    'CSS',
                    'Javascript',
                    'PHP',
                    'Mysql'
                ],
                'demo' => '#',
                'github' => '#'
            ]
        ];
        
        $cards = "";

        function getTec($arrTecnologias) {
                $tecnologias = "";

                foreach ($arrTecnologias as $tecnologia) {
                    $tecnologias .= '<div class="tecnologia-single"><small><b>' . $tecnologia . '</b></small></div>';
                }

                return $tecnologias;
        }

        foreach ($arrProjetos as $key => $value) {
           $cards .= parent::components(parent::dir_base() . '/components/card-projeto.php', [
                'img' => $value['img'],
                'titulo' => $value['titulo'],
                'descricao' => $value['descricao'],
                'tecnologias' => getTec($value['tecnologias']),
                'demo' => $value['demo'],
                'github' => $value['github']
           ]);
        }

        return parent::components(parent::dir_base() . '/projetos.php', [
            'cards' => $cards
        ]);
    }

    public function pageSobre() 
    {
        return parent::components(parent::dir_base() . '/sobre.php');
    }
    
}
