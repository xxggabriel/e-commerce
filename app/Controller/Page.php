<?php 

namespace App\Controller;
// namespace
use Rain\Tpl;


class Page 
{
    private $default = [
        "header" => true,
        "footer" => true,
        "sidebar" => true
    ];
    private $options = [];
    private $tpl;

    public function __construct($opts = array(), $tpl_dir = "site/")
    {
        $this->options = array_merge($this->default,$opts);
        // config
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT']."/../app/Views/".$tpl_dir,
            "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/../app/Views/cache/",
            "debug"         => false, // set to false to improve the speed
        );

        Tpl::configure( $config );


        // create the Tpl object
        $this->tpl = new Tpl;   
        if($this->options['header'] === true) $this->tpl->draw('header');
    }

    private function setData($data = array())
    {
        foreach($data as $key => $value){

            $this->tpl->assign($key, $value);
        }
    }

    public function setTpl($tpl, $data = array(), $returnHTML = false)
    {
        $this->setData($data);

        if($this->options['sidebar'] === true) $this->tpl->draw('sidebar');

        $this->tpl->draw($tpl, $returnHTML);
    }

    public function __destruct()
    {
        if($this->options['footer'] === true)$this->tpl->draw('footer');
    }
}