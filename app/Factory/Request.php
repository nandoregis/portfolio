<?php

namespace app\Factory;

use app\Core\Token;

class Request {


    public array $headers;
    public array $body;
    public string $uri;
    public string $method;
    private string $authToken;

    public function __construct() {
        $this->headers = getallheaders();
        $this->body = $_POST ?: $_GET; 
        $this->uri = strtok($_SERVER["REQUEST_URI"], '?');
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->authToken = Token::get_token();
    } 

    public function input(string $key, $default = null) 
    {
        return $this->body[$key] ?? $default;
    }

    public function get(string $key, $default = null) 
    {
        return $this->getRequest()[$key] ?? $default;
    }

    public function post(string $key, $default = null) 
    {
        return $this->postRequest()[$key] ?? $default;
    }

    public function get_auth_token()
    {
        return $this->authToken;
    }

    public function destroy_auth_token()
    {
        $this->authToken = "";
    }

    public function exist_post()
    {
        if( $this->postRequest() ) return true;
        return false;
    }

    public function get_uri() { return $this->uri;}
    
    private function getRequest(): array 
    {
        return $this->method === 'GET' ? $_GET : [];
    }

    private function postRequest(): array 
    {
        return $this->method === 'POST' ? $_POST : [];
    }
    

}