<?php

namespace app\Modules\Auth\Model;

use app\Core\Token;
use app\Core\UUID;
use app\Model\Model;

class SetterAuthModel extends Model
{

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


     public function criar_usuario(String $nome, String $email, String $usuario, String $senha) {
        
        $uuid = UUID::generator();
        $uuid_nivel = '24e4e21dac2dd1356a8ba1859695b1'; // uuid usuario comun - fazer função de buscar no banco de dados
        $uuid_adm = Token::get_uuid_user();
        $token = "";
        $estatus = 0;
        $data_registro = date('Y-m-d H:i:s'); // Ex: 2025-05-18 14:30:00

        $sql = "INSERT INTO `tb_usuarios` ( 
        id, 
        uuid,
        uuid_nivel, 
        uuid_adm,
        nome, 
        email,
        usuario,
        senha,
        token,
        estatus,
        registro_criado,
        registro_atualizado
        ) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?)";

        $pdo = parent::mysql_conn();
        
        $result = $pdo->prepare($sql);
        $result = $result->execute([$uuid, $uuid_nivel,$uuid_adm,$nome,$email,$usuario,$senha,$token,$estatus,$data_registro,$data_registro]);

        $result = !$result ? $result : $uuid; 
        return $result;
    }
}