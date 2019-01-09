<?php 

namespace App\Controller\Views;

use App\Controller\PageAdmin;
use App\Model\User;
use App\Model\Product;
use App\Model\Brand;

class ClassSiteAdmin 
{

    public function index($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function product($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('product');
    }

    public function brand($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('brand');
    }

    public function user($request, $response, $args)
    {        
        $page = new PageAdmin();
        return $page->setTpl('user');
    }

    public function category($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('category');
    }

    public function provider($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('provider');
    }

    // Create

    public function createProduct($request, $response, $args)
    {  
        if($request->isPost()){
            // var_dump($request->getParsedBody());exit;
            $data = $request->getParsedBody();
            $product = new Product();
            $product->create($data);
            header("Location: /app/admin/product");
            exit;
        }
        $page = new PageAdmin();
        return $page->setTpl('create-product');
    }

    public function createBrand($request, $response, $args)
    {  
        if($request->isPost()){
            $data = $request->getParsedBody();
            $brand = new Brand();
            $brand->create($data);
            header("Location: /app/admin/brand");
            exit;
        }
        $page = new PageAdmin();
        return $page->setTpl('create-brand');
    }

    public function createCategory($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }


    public function createUser($request, $response, $args)
    {
        
        if($request->isPost()){
            // var_dump($request->getParsedBody());exit;
            $data = $request->getParsedBody();
            $user = new User();
            $user->create($data);
            header("Location: /app/admin/user");
            exit;
        }
        $page = new PageAdmin();
        return $page->setTpl('create-user');
    }

    public function createProvider($request, $response, $args)
    {
        if($request->isPost()){
            
        }
        $page = new PageAdmin();
        return $page->setTpl('create-provider');
    }

    // END Create 

    // Read

    public function readProduct($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function readBrand($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function readCategory($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function readUser($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function readProvider($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    // END Read

    // Update

    public function updateProduct($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function updateBrand($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function updateCategory($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function updateUser($request, $response, $args)
    {
        if($request->isPost()){
            
        }
        $page = new PageAdmin();
        return $page->setTpl('update-user');
    }

    public function updateProvider($request, $response, $args)
    {
        if($request->isPost()){
            
        }
        $page = new PageAdmin();
        return $page->setTpl('update-provider');
    }
    // END Update

    // Delete

    public function deleteProduct($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function deleteBrand($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function deleteCategory($request, $response, $args)
    {  
        $page = new PageAdmin();
        return $page->setTpl('index');
    }

    public function deleteUser($request, $response, $args)
    {
        if($request->isPost()){
            
        }

        $this->delete((int)$args['id']);
    }

    public function deleteProvider($request, $response, $args)
    {
        if($request->isPost()){
            
        }

        $this->delete((int)$args['id']);
    }
    // END Delete
}