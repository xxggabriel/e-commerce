<?php 

use Slim\App;
use App\Controller\Page;

$c = new \Slim\Container(); //Create Your container

//Override the default Not Found Handler before creating App

$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $page = new Page(['sidebar'=>false]);
        $page->setTpl('404');
        return $response->withStatus(404);
    };
};

$app = new App($c);
include_once "Admin.php";
include_once "Web.php";

$app->run();    