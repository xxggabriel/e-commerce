<?php 

namespace App\Controller\Views;

use App\Model\User;
use App\Controller\PageAdmin;

class ClassUser extends User
{

    public function index($request, $response, $args)
    {
        
        $page = new PageAdmin();
        return $page->setTpl('user');
    }

    public function create($request, $response, $args)
    {
        if(!empty($_SERVER['REQUEST_METHOD'] === 'POST')){
            
        }
        $page = new PageAdmin();
        return $page->setTpl('create-user');
    }

    public function update($request, $response, $args)
    {
        if(!empty($_SERVER['REQUEST_METHOD'] === 'POST')){
            
        }
        $page = new PageAdmin();
        return $page->setTpl('update-user');
    }

    public function delete($args)
    {
        if(!empty($_SERVER['REQUEST_METHOD'] === 'POST')){
            
        }
        $this->delete($args['id']);
    }
}