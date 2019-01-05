<?php 

namespace Config;

require_once "FileConfig.php";

class Config
{

    private $config = [];

    public function setConfig($config = array())
    {
        if(!empty($config)){
            $this->config = $config;
        }
    }


    public function getConfig()
    {
        return $this->config;
    }

   
}