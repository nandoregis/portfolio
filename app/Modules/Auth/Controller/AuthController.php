<?php

namespace app\Modules\Auth\Controller;

use app\Controller\Controller;
use app\Core\Redirect;
use app\Core\Token;
use app\Modules\Auth\Model\AuthModel;
use app\Modules\Signature\Controller\SignatureController;
use app\Service\JWT;
use app\Service\Message;
use Exception;

class AuthController extends Controller
{

    private $authMiddleware;
    private $jwt;
    private $user;

    public function __construct() {

        parent::__construct();
        $this->jwt = new JWT;
        $this->user = new AuthModel;
        parent::set_static_dir_view('Modules/Auth/View/');

    }

    public function index(Object $req)
    {   
        $html = parent::html_render()->load('Login/index.php');

        try {
           
            if($this->login($req)) {

                $html->set('message', parent::components('View/Components/message.php',
                [
                    'status' => 'success',
                    'message' => 'Autenticado com sucesso!'
                ]));
            }

         
        } catch (\Exception $e) {
            
            $html->set('message', parent::components('View/Components/message.php',
            [
                'status' => json_decode($e->getMessage())->status,
                'message' => json_decode($e->getMessage())->message
            ]) );

        }

       
        $html->set([
            'title' => 'Acesso',
            'form' => parent::components(parent::dir_base().'/Login/Components/form.php')
        ])

        ->display();

    }

    private function login(Object $req)
    {   

        if(!$req->exist_post() ) return;

        $user = trim(strtolower($req->post('usuario')));
        $password = $req->post('senha');

        if(empty($user) || empty($password)) return throw new Exception(json_encode(['status' => 'error', 'message' => 'Campos vazios não são permitidos!']));
        
        $user = $this->user->getter()->get($user); 

        if(!$user || !password_verify($password, $user['senha'])) return throw new Exception(json_encode(['status' => 'error', 'message' => 'Usuario ou senha incorretos!']));

        unset($user['senha']); // remover informação sobre a senha
  
        Token::create($user);
        Redirect::to('/admin');
        
        return true;
    }
    
    public function logout(Object $req) 
    {

    }

    private function token($token)
    {
        // echo '<pre>';
        // print_r($this->jwt->decode($token));
        // echo '</pre>';
    }

}


