<?php

namespace app\Modules\Auth\Model;

use app\Core\Token;
use app\Model\Model;

class GetterAuthModel extends Model
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

    public function get($user)
    {   
        $tb_user = self::$tables['usuario'];
        $tb_nivel = self::$tables['acesso'];

        $pdo = parent::mysql_conn();

        $sql = "SELECT 
        user.uuid, 
        user.nome, 
        user.email, 
        user.senha,
        user.estatus, 
        user.uuid_nivel AS uuid_acesso, 
        nivel.tipo_acesso,
        nivel.nivel AS nivel_acesso
        FROM $tb_user AS user
        INNER JOIN $tb_nivel AS nivel 
        ON user.uuid_nivel = nivel.uuid
        WHERE usuario = ?";

        $result = $pdo->prepare($sql);
        $result->execute([$user]);
        $result = $result->fetch();
        
        return empty($result) ? [] : $result;

    }

    public function get_put_uuid(String $uuid)
    {
        $tb_user = self::$tables['usuario'];
        $tb_nivel = self::$tables['acesso'];
        $tb_assinaturas = self::$tables['assinaturas'];
        $tb_plano = self::$tables['planos'];

        $pdo = parent::mysql_conn();

        $sql = "SELECT 
        user.uuid, 
        user.nome, 
        user.email,
        user.senha,
        user.usuario, 
        user.estatus, 
        user.uuid_nivel AS uuid_acesso, 
        nivel.tipo_acesso,
        nivel.nivel AS nivel_acesso,
        assinatura.uuid AS uuid_assinatura,
        assinatura.data_inicio AS inicio_assinatura,
        assinatura.data_fim AS fim_assinatura,
        assinatura.estatus AS estatus_assinatura,
        plano.uuid AS uuid_plano,
        plano.tipo AS tipo_plano,
        plano.preco AS preco_plano
        FROM $tb_user AS user
        INNER JOIN $tb_nivel AS nivel 
        ON user.uuid_nivel = nivel.uuid
        LEFT JOIN $tb_assinaturas AS assinatura 
        ON assinatura.uuid_usuario = user.uuid
        LEFT JOIN $tb_plano AS plano 
        ON plano.uuid = assinatura.uuid_plano
        WHERE user.uuid = ?";

        $result = $pdo->prepare($sql);
        $result->execute([$uuid]);
        $result = $result->fetch();

        return empty($result) ? [] : $result;
    }

    public function get_small_levels(Int $level) : array
    {   
        $tb_nivel = self::$tables['acesso'];
        $pdo = parent::mysql_conn();

        $sql = "SELECT uuid, acesso FROM $tb_nivel WHERE nivel < ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$level]);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function get_all() 
    {
        $tb_user = self::$tables['usuario'];
        $tb_nivel = self::$tables['acesso'];

        $uuid_usuario = Token::get_uuid_user();

        $pdo = parent::mysql_conn();

        $sql = "SELECT 
        user.uuid, 
        user.nome, 
        user.email, 
        user.senha,
        user.estatus,
        user.registro_criado, 
        user.uuid_nivel AS uuid_acesso, 
        nivel.tipo_acesso,
        nivel.nivel AS nivel_acesso
        FROM $tb_user AS user
        INNER JOIN $tb_nivel AS nivel 
        ON user.uuid_nivel = nivel.uuid
        WHERE user.uuid != ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uuid_usuario]);
        $result = $stmt->fetchAll();
        
        return empty($result) ? [] : $result;

    }

    public function get_por_acesso() 
    {
        $tb_user = self::$tables['usuario'];
        $tb_nivel = self::$tables['acesso'];

        $pdo = parent::mysql_conn();

       $sql = "SELECT
        SUM(CASE WHEN nivel.tipo_acesso IN ('admin', 'subadmin') THEN 1 ELSE 0 END) AS total_admin,
        SUM(CASE WHEN nivel.tipo_acesso = 'comum' THEN 1 ELSE 0 END) AS total_normal,
        SUM(CASE WHEN nivel.tipo_acesso = 'ilimitado' THEN 1 ELSE 0 END) AS total_ilimitado
        FROM $tb_user AS user
        INNER JOIN $tb_nivel AS nivel 
        ON user.uuid_nivel = nivel.uuid;";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        
        return empty($result) ? [] : $result;

    }

    public function get_usuario_pelo_nome(String $usuario) : bool
    {   
        $tb = self::$tables['usuario'];
        $sql = "SELECT COUNT(*) FROM `$tb` WHERE usuario = ?";
        $pdo =  parent::mysql_conn();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuario]);

        $total = $stmt->fetchColumn();

        return $total > 0;
    }

    public function get_email(String $email, String $diferente_uuid = null)
    {
        $tb = self::$tables['usuario'];
        $sqlIncrement = $diferente_uuid ? "AND uuid != ?" : "";
        $sql = "SELECT * FROM `$tb` WHERE email = ? ".$sqlIncrement;

        $pdo =  parent::mysql_conn();

        $stmt = $pdo->prepare($sql);
        $diferente_uuid  ?  $stmt->execute([$email,$diferente_uuid]) : $stmt->execute([$email]);
        $total = $stmt->fetchColumn();

        return $total > 0;
    }

}