<?php

namespace app\Core;

use app\Factory\Href;
use app\Service\Components;

class Navigation
{
    private $href;
    private $comp;
    private $roles;

    public function __construct() 
    {
        $this->href = new Href;
        $this->comp = new Components;
        
    }

    public function getAll() : array
    {
        return array_merge($this->user(), $this->admin());
    }

    public function get_user() : array
    {
        return $this->user();
    }

    public function get_admin() : array
    {
        return $this->admin();
    }

    private function user()
    {       
        
        $this->href
        ->new('dashboard', 

            $this->comp->load('View/svg/dashboard.svg')
            ->set([
                'width' => '15',
                'height' => '15'
            ])
            ->render()
        )
        //---------------------------------
        
        ->new('produtos', 

            $this->comp->load('View/svg/produto.svg')
            ->set([
                'width' => '15',
                'height' => '15'
            ])
            ->render()
        )
        
        //---------------------------
        ->new('cores' , 
            $this->comp->load('View/svg/cores.svg')
            ->set([
                'width' => '15',
                'height' => '15'
            ])
            ->render()
        )

        ->new('complemetar',
            $this->comp->load('View/svg/dashboard.svg')
            ->set([
                'width' => '15',
                'height' => '15'
            ])
            ->render()
        )->href('Produtos', 'produtos', $this->comp->load('View/svg/produto.svg')
        ->set([
            'width' => '15',
            'height' => '15'
        ])->render() );
    
        return $this->href->get_all();
    }

    private function admin() 
    {
        $href =  new Href;
       
        $href
        ->new('admin', $this->comp->load('View/svg/dashboard.svg')
        ->set([
            'width' => '15',
            'height' => '15'
        ])
        ->render() )

        ->href('Usuários', "usuarios", $this->comp->load('View/svg/usuario.svg')
        ->set([
            'width' => '15',
            'height' => '15'
        ])->render() )

        ->href('Banners', "banners", $this->comp->load('View/svg/banner.svg')
        ->set([
            'width' => '15',
            'height' => '15'
        ])->render() );
        
        return $href->get_all();
    }



}