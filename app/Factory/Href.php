<?php

namespace app\Factory;

use Exception;

class Href
{

    private $dataLink = [];
    private string $_key;
    private $_title;
    private $_href;
    private $_icon;

    public function new(String $key, String $icon) : self
    {
        // slug :   /^[a-z]+(-[a-z]+)*$/

        if(!isset($key)) throw new Exception("Não foi setado um valor chave", 1);
        if(!preg_match('/^[a-z]+(-[a-z]+)*$/', $key)) throw new Exception("Somente é permitido texto", 1);      
        
        $this->_key = $key;
        $this->_icon = $icon;

        if(isset($this->dataLink[$key])) {
            throw new Exception("Já existe item com essa chave", 1);
        }
        
        $this->dataLink[$key] = [["icon" => $this->_icon]];

        return $this;

    }

    public function name(String $key) : self
    {
        if(!isset($this->dataLink[$key])) {
            throw new Exception("Não existe item com essa chave", 1);
        }

        $this->_key = $key;

        return $this;
    }

    public function get(String $key) 
    {
        if(!isset($this->dataLink[$key])) {
            throw new Exception("Não existe item com essa chave", 1);
        }

        return $this->dataLink[$key];
    }

    public function get_all()
    {
        return $this->dataLink;
    }

    public function href(String $title, String $href, String $icon = '-')
    {
        if(!isset($this->_key) ) throw new Exception("Não foi setado um valor chave", 1);
        if(!isset($title) || !isset($href) ) throw new Exception("necessidade de um titulo ou href", 1);

        $this->_title = $title;
        $this->_icon = $icon ?? $icon;
        
        // validar se tem a barra antes no href, ver se é caminho estatico.
        $this->_href = str_contains($href, '/') ? $href : "/". $this->_key . '/' . $href;

        $link = [
            'title' => $this->_title,
            'href' =>  $this->_href,
            'icon' => $this->_icon
        ];

        array_push($this->dataLink[$this->_key], $link);
        
        return $this;
    }

   
}