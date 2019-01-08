<?php 

namespace App\Controller;
// namespace
use Rain\Tpl;


class Page 
{
    private $default = [
        "header" => true,
        "footer" => true,
        "sidebar" => false
    ];
    private $options = [];
    private $tpl;

    public function __construct($opts = array(), $tpl_dir = "site/")
    {
        $this->options = array_merge($this->default,$opts);
        // config
        $config = array(
            "tpl_dir"       => str_replace('public','app/Views/', $_SERVER['DOCUMENT_ROOT'].$tpl_dir),
            "cache_dir"     => str_replace('public', 'app/Views/cache/', $_SERVER['DOCUMENT_ROOT']),
            "debug"         => false, // set to false to improve the speed
        );
        Tpl::configure( $config );


        // create the Tpl object
        $this->tpl = new Tpl;   
        if($this->options['header'] === true) $this->tpl->draw('header');
    }

    public function setDataAssign($data = array())
    {
        foreach($data as $key => $value){

            $this->tpl->assign($key, $value);
        }
    }

    public function setTpl($tpl, $data = array(), $returnHTML = false)
    {
        $this->setDataAssign($data);

        if($this->options['sidebar'] === true) $this->tpl->draw('sidebar');

        $this->tpl->draw($tpl, $returnHTML);
    }

    public function __destruct()
    {
        if($this->options['footer'] === true)$this->tpl->draw('footer');
    }
}