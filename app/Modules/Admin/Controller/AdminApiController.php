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
        
    }


    
   
    
}