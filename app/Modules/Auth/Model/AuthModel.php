<?php

namespace app\Modules\Auth\Model;

use app\Core\Token;
use app\Core\UUID;
use app\Model\Model;

class AuthModel extends Model
{
    private static $connection;
    private static $tables = [
        'usuario' => 'tb_usuarios',
        'acesso' => 'tb_niveis_acesso',
        'assinaturas' => 'tb_assinaturas',
        'planos' => 'tb_planos'
    ];

    public function __construct() 
    {
        parent::__construct();
    }

    public function getter() : object
    {
        return new GetterAuthModel;
    }

    public function setter() : object
    {
        return new SetterAuthModel;
    }

    public function updater() : object
    {
        return new UpdaterAuthModel;
    }

    public function deleter()
    {

    }

}