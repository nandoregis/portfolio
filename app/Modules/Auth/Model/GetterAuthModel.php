<?php

namespace app\Modules\Auth\Model;

use app\Core\Token;
use app\Model\Model;

class GetterAuthModel extends Model
{

     private static $tables = [
        'usuario' => 'tb_admin',
    ];

    public function __construct() 
    {
        parent::__construct();
    }

    public function get($user)
    {   
        $tb_user = self::$tables['usuario'];
    

        $pdo = parent::mysql_conn();

        $sql = "SELECT 
        user.uuid, 
        user.nome, 
        user.senha
        FROM $tb_user AS user
        WHERE usuario = ?";

        $result = $pdo->prepare($sql);
        $result->execute([$user]);
        $result = $result->fetch();
        
        return empty($result) ? [] : $result;

    }


}