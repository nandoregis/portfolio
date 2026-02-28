<?php

namespace app\Core;
use app\Service\JWT;

class Token
{

    public static function validate(String $tk)
    {
        if(!$tk || $tk !== $_SESSION[COOKIE_NAME]) return null;


        return true;
    }

    public static function create(Array $payload) : void
    {
        $token = (new JWT)->encode($payload);
        $_SESSION[COOKIE_NAME] = $token;
    }

    public static function get_token()
    {
        return isset($_SESSION[COOKIE_NAME]) ? $_SESSION[COOKIE_NAME] : '';
    }

    public static function get_uuid_user()
    {   
        if(!isset($_SESSION[COOKIE_NAME])) return null;

        $jwt = new JWT;
        $uuid = $jwt->decode($_SESSION[COOKIE_NAME]);
        return $uuid->uuid;
    }

    public static function get_type_user()
    {
        if(!isset($_SESSION[COOKIE_NAME])) return null;

        $jwt = new JWT;
        $uuid = $jwt->decode($_SESSION[COOKIE_NAME]);
        return $uuid->tipo_acesso;
    }

    public static function get_level_user()
    {
        if(!isset($_SESSION[COOKIE_NAME])) return null;

        $jwt = new JWT;
        $uuid = $jwt->decode($_SESSION[COOKIE_NAME]);
        return $uuid->nivel_acesso;
    }

    public static function get_username()
    {   
        if(!isset($_SESSION[COOKIE_NAME])) return null;
        
        $jwt = new JWT;
        $uuid = $jwt->decode($_SESSION[COOKIE_NAME]);
        return $uuid->nome;
    }


    

}