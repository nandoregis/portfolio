<?php

namespace app\Modules\Admin\Controller;

use app\Controller\Controller;
use app\Modules\Admin\Model\AdminProjectModel;

class AdminApiController extends Controller
{   
    
    private $adminProjectModel;

    public function __construct() {
        parent::__construct();
        $this->adminProjectModel = new AdminProjectModel;
    }

    public function getAllProject(Object $req)
    {   
        $response = [
            [
                "uuid" => 'aaaa',
                'titulo' => 'aaaaaaaaa',
                'descricao' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
                'tecnologias' => 'a,b,c,d,f,g',
                'img_url' => 'http://localhost',
                'github_url' => 'http://localhost',
                'demo_url' => '#'
            ],
            [
                "uuid" => 'bbbbbbb',
                'titulo' => 'aaaabbbbbbbbbbbaaaaa',
                'descricao' => 'bbbbbbbbbbbbbbbdsadasdasdsadasdasdasdbbbbbbbbbbbbbbbbbbbbbb',
                'tecnologias' => 'a,b,c,d,f,g',
                'img_url' => 'http://localhost',
                'github_url' => 'http://localhost',
                'demo_url' => '#'
            ]
        ];

        return parent::apiView(200, $response);
    }



    public function createProject(Object $req)
    {
        $data = $this->getProjectData($req);
        $check = $this->validateInputProject($data);

        if (!$check['status']) {
            return parent::apiView(400, $check);
        }

        try {
            $result = $this->adminProjectModel->createProject(...array_values($data));
            return parent::apiView(201, ['message' => 'Sucesso', 'status' => true]);
        } catch (\Exception $e) {
            return parent::apiView(500, ['message' => 'Erro no servidor', 'status' => false]);
        }
    }

    public function updateProject(Object $req)
    {
        
        $uuid = $req->input('uuid');
        $data = $this->getProjectData($req);
        $check = $this->validateInputProject($data);

        if (!$check['status']) {
            return parent::apiView(400, $check);
        }
      
        try {
            $result = $this->adminProjectModel->updateProject($uuid, $data);
            return parent::apiView(201, ['message' => 'Sucesso', 'status' => true]);
        } catch (\Exception $e) {
            return parent::apiView(500, ['message' => 'Erro no servidor', 'status' => false]);
        }

    }

    private function getProjectData(Object $req): array 
    {
        return [
            'titulo'      => $req->input('titulo'),
            'descricao'   => $req->input('descricao'),
            'tecnologias' => $req->input('tecnologias'),
            'img_url'     => $req->input('img_url'),
            'github_url'  => $req->input('github_url'),
            'demo_url'    => $req->input('demo_url')
        ];
    }

    private function validateInputProject(array $data) : array
    { 
        // Transforma ['titulo' => '...'] em $titulo, etc.
        extract($data);

        // 1. Verificação de campos obrigatórios (mais limpo)
        $requiredFields = ['titulo', 'descricao', 'tecnologias', 'img_url', 'github_url', 'demo_url'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return ['status' => false, 'message' => "O campo {$field} deve ser preenchido"];
            }
        }

        // 2. Validação de Regex (Tecnologias)
        $techRegex = '/^[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*(,[a-zA-Z0-9]+(-[a-zA-Z0-9]+)*)*$/i';
        if (!preg_match($techRegex, $tecnologias)) {
            return ['status' => false, 'message' => 'Formato de tecnologias inválido. Ex: (tec,api-2,front)'];
        }

        // 3. Validação de URLs (Centralizada)
        $urlsToValidate = [
            'img' => $img_url, 
            'github' => $github_url, 
            'demo' => $demo_url
        ];

        foreach ($urlsToValidate as $label => $url) {
            if ($url !== '#' && !filter_var($url, FILTER_VALIDATE_URL)) {
                return ['status' => false, 'message' => "O campo {$label} não é uma URL válida"];
            }
        }

        return ['status' => true];
    }
    
}