<?php


$app->get('/',function(){
    $page = new \App\Controller\Page(['sidebar'=>false]);
    $page->setTpl('index');
 });

