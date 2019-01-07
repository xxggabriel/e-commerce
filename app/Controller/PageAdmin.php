<?php

namespace App\Controller;

use App\Controller\Page;

class PageAdmin extends Page
{
    public function __construct($opts = array(), $tpl_dir = "admin/")
    {
        parent::__construct($opts,$tpl_dir);
    }
}