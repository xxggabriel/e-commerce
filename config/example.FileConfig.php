<?php 

namespace Config;

use Config\Config;

class FileConfig
{
    private $config;
    private $data = [
        "database" => [
            "DB_NAME" => "test",
            "HOST" => "localhost",
            "USER" => "root",
            "PASSWORD" => "",
            "PORT" => "3306",
            "CHARSET" => "UTF-8",
        ],
        "email" => [
            "STMT" => "smtp.gmail.com",
            "PORT" => "465",
            "USER" => "example@gmail.com",
            "PASSWORD" => "password",
        ]
    ];

    public function __construct(){
        $this->config = new Config();
        $this->config->setConfig();

    }

    public function getDatabase($key = null)
    {
        if($key === NULL){
            return $this->data['database'];
        }else {
            
            return (!empty($this->data['database'][$key]))? $this->data['database'][$key] : NULL;
        }
    }

    public function getEmail($key = null)
    {
        if($key === NULL){
            return $this->data['email'];
        }else {

            return (!empty($this->data['email'][$key]))? $this->data['email'][$key] : NULL;
        }
    }

    
}
