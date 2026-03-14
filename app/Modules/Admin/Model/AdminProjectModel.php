<?php

namespace app\Modules\Admin\Model;

use app\Core\UUID;
use app\Model\Model;

class AdminProjectModel extends Model
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function getAllProject() 
    {
        $sql = "SELECT * FROM tb_projetos";
        $pdo = parent::mysql_conn();

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function createProject(
        string $titulo, 
        string $descricao, 
        string $tecnologias, 
        string $img_url, 
        string $github_url, 
        string $demo_url)
    {

        $uuid = UUID::generator();

        $sql = "INSERT INTO tb_projetos 
        (uuid, titulo, descricao, tecnologias, img_url, github_url, demo_url) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
        

        $pdo = parent::mysql_conn();
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $uuid,
            $titulo,
            $descricao,
            $tecnologias,
            $img_url,
            $github_url,
            $demo_url
        ]);

        return [
            'uuid' => $uuid,
        ];
    
    }

    public function updateProject(
        string $uuid,
        Array $projeto,
    ){

        extract($projeto);

        $sql = "UPDATE tb_projetos SET
            titulo = ?,
            descricao = ?,
            tecnologias = ?,
            img_url = ?,
            github_url = ?,
            demo_url = ?
        WHERE uuid = ?";

        $pdo = parent::mysql_conn();

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $titulo,
            $descricao,
            $tecnologias,
            $img_url,
            $github_url,
            $demo_url,
            $uuid
        ]);

    }

    public function deleteProject(string $uuid)
    {
        $sql = "DELETE FROM tb_projetos WHERE uuid = ?";

        $pdo = parent::mysql_conn();
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$uuid]);

        return $stmt->rowCount() > 0;
    }

}