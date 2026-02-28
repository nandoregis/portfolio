<?php

namespace app\Modules\Auth\Model;
use app\Model\Model;

class UpdaterAuthModel extends Model
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

    public function editar_usuario(String $nome, String $email, String $acesso, Int $estatus, String $uuid)
    {
        $sql = "UPDATE `tb_usuarios`
        SET 
            nome = ?,
            email = ?,
            uuid_nivel = ?,
            estatus = ?
        WHERE uuid = ?";

        $pdo = parent::mysql_conn();

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $email, $acesso, $estatus, $uuid]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public function trocar_senha_usuario(String $nova_senha, String $uuid)
    {
        $sql = "UPDATE `tb_usuarios` SET senha = ? WHERE uuid = ?";
        $pdo = parent::mysql_conn();

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nova_senha, $uuid]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}