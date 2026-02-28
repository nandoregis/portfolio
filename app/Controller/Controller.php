<?php

namespace app\Controller;

use app\Service\Components;
use app\Core\Navigation;
use app\Core\Token;
use app\View\View;
use ArrayAccess;
use DateTime;

class Controller
{
    
    private $view;
    private $components;
    private string $dir_base;

    public function __construct() {
        $this->view = new View;
        $this->components = new Components;
    }

    public function navigation()
    {   

        if( 
            Token::get_level_user() == ROLES['admin']['level'] 
                                    || 
            Token::get_level_user() == ROLES['subadmin']['level']) 
        {
            return (new Navigation)->getAll() ?? [];
        }

        return (new Navigation)->get_user() ?? [];
    }

    protected function set_static_dir_view(string $dir)
    {
        if(!$dir) return;

        $this->dir_base = $dir;
        $this->view = new View($dir);
    }

    protected function dir_base() {
        return $this->dir_base;
    }
    
    protected function html_render()
    {
        return $this->view;
    }

    protected function components(String $file, Array $vars = [])
    {   

        return $this->components
        ->load($file)
        ->set($vars)
        ->set('username', Token::get_username())
        ->render();
    }

    protected function multi_components(String $file, Array $elements = [], Array $aditional_elements = [])
    {
        $output = "";

        $el = $this->components->load($file);
        
        foreach ($elements as $key => $arr) 
        {   
            if(!isset($arr)) continue;
            
            if($aditional_elements)
            {
                $el->set($aditional_elements);
            }

            $el->set($arr);
            
            $output .= $el->set('username', Token::get_username())->render();

        }

        return $output;
    }

    protected function list_components(String $file, Array $list, String $var)
    {
        $output = "";
    

        foreach ($list as $key => $value) {

            $output .= $this->components($file,[
                $var => $value
            ]);
        }

        return $output;
    }

    protected function navigation_elements(Array $paths)
    {   

        $nav = '';
        
        foreach ($paths as $key => $value) {
            
            $icon = $value[0]['icon'];
            unset($value[0]);
            
            $nav .= $this->components('View/Components/sub.php',[
                'title' => ucfirst($key),
                'icon' => $icon,
                'href' => "/$key",
                'class' => 'sub-menu',
                'location' => empty($value) ? '-location' : '',
                'submenu' => (function () use ($value) {
                    $sub = '';
                    foreach ($value as $k => $val) 
                    {
                        $sub .= $this->components('View/Components/li.php', $val);
                    }

                    return $sub;
                })()
            ]);
        }

        return $nav;
    }

    protected function data_format(string $data)
    {
     // formatar em data
        if( $data) $invoice = ( new DateTime( $data ) )->format('d/m/Y');
    }

    protected function pagination(Int $amount, Int $amount_page = 10) : array
    {
        $itemQuantidade = $amount;
        $itensPorPagina = $amount_page;

        $paginaAtual = !isset($_GET['page']) ? 1 : $_GET['page'];
        $paginaAtual = intval($paginaAtual) === 0 ? 1 : intval($paginaAtual);

        $limitePaginas = ceil( $itemQuantidade / $itensPorPagina );
        
        // pagination logic
        $proximaPagina = $paginaAtual + 1 < $limitePaginas ? $paginaAtual + 1 : $limitePaginas;
        $paginaAtual = $paginaAtual > $proximaPagina ? $proximaPagina : $paginaAtual;
        $paginaAnterior = $paginaAtual - 1 < 1 ? 1 : $paginaAtual - 1;
        
        $inicio = ( $itensPorPagina * $paginaAtual ) - $itensPorPagina < 0 ? 0 : ( $itensPorPagina * $paginaAtual ) - $itensPorPagina;
        
        return [
            'index' => $inicio,
            'amount_limit' => $itensPorPagina,
            'atual_page' => $paginaAtual,
            'back_page' => $paginaAnterior,
            'next_page' => $proximaPagina
        ];
    }
}