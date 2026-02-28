<?php

namespace app\Middleware;

use app\Core\Redirect;
use app\Core\Token;

/**
 * Middleware para verificar se usuário tem permissão de acesso.
 */
class RoleMiddleware 
{
    private array $roles;
    private array $level_roles;

    public function __construct(
        array $roles = [ROLES['admin']['type'], ROLES['subadmin']['type']],
        array $level_roles = [ROLES['admin']['level'], ROLES['subadmin']['level']]
     ) 
    {
        // Tipos e níveis permitidos
        $this->roles = $roles;
        $this->level_roles = $level_roles;
    }

    public function handle($req, callable $next) 
    {   
        $token = $req->get_auth_token();

        $token_type  = Token::get_type_user($token);  // retorna string: admin ou subadmin
        $token_level = Token::get_level_user($token); // retorna int: 99 ou 90

        // Verifica se usuário está dentro dos níveis de acesso permitidos
        if (
            !in_array($token_type, $this->roles) || 
            !in_array($token_level, $this->level_roles)
        ) 
        {
            Redirect::to('/dashboard');
        }

        return $next($req);
    }
}
