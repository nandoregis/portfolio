<?php

namespace app\Modules\Admin\Controller;

use app\Controller\Controller;

class AdminController extends Controller
{
    public function __construct() {

        parent::__construct();
        parent::set_static_dir_view('Modules/Admin/View/');

    }

    public function index(Object $req)
    {   
        $html = parent::html_render()->load('index.php');


        $html->set([
            "sidebar" => $this->ComponentSidebar(),
            "projetos" => $this->PageProjetos(),
        ])->display();
    }


    private function PageProjetos() 
    {
        return parent::components(parent::dir_base() . '/pages/projetos.php');
    }

     private function ComponentSidebar() 
    {
        return parent::components(parent::dir_base() . '/components/sidebar.php');
    }
   
    
}