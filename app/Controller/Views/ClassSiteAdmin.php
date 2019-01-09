<?php 

namespace App\Controller\Views;

use App\Controller\PageAdmin;
use App\Model\User;
use App\Model\Product;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Provider;

class ClassSiteAdmin 
{

    public function index($request, $response, $args)
    {  
        $page = new PageAdmin();
        $page->setTpl('index');
    }

    public function product($request, $response, $args)
    {  
        $product = new Product();
        $page = new PageAdmin();
        $page->setTpl('product',[
            "product" => $product->read()
        ]);
    }

    public function brand($request, $response, $args)
    {  
        $brand = new Brand();
        $page = new PageAdmin();
        $page->setTpl('brand',[
            "brand" => $brand->read()
        ]);
    }

    public function user($request, $response, $args)
    {        
        $user = new User();
        $page = new PageAdmin();
        $page->setDataAssign([
            "user" => $user->read()
        ]);
        $page->setTpl('user');
        
    }

    public function category($request, $response, $args)
    {  
        $category = new Category();
        $page = new PageAdmin();
        $page->setTpl('category',[
            "category" => $category->read()
        ]);
    }

    public function provider($request, $response, $args)
    {  
        $provider = new Provider();
        $page = new PageAdmin();
        $page->setTpl('provider',[
            "provider" => $provider->read()
        ]);
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
        $page->setTpl('create-product');
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
        $page->setTpl('create-brand');
    }

    public function createCategory($request, $response, $args)
    {  
        if($request->isPost()){
            $data = $request->getParsedBody();
            $category = new Category();
            $category->create($data);
            header("Location: /app/admin/category");
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('create-category');
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
        $page->setTpl('create-user');
    }

    public function createProvider($request, $response, $args)
    {
        if($request->isPost()){
            
        }
        $page = new PageAdmin();
        $page->setTpl('create-provider');
    }

    // END Create 

    // Update

    public function updateProduct($request, $response, $args)
    {  
        $page = new PageAdmin();
        $page->setTpl('index');
    }

    public function updateBrand($request, $response, $args)
    {  
        $brand = new Brand();
        if($request->isPost()){
            $brand->update((int)$args['id'],$request->getParsedBody());
            header('Location: /app/admin/brand');
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('update-brand',[    
            "brand" => $brand->read((int)$args['id'])[0]
            
        ]);
    }

    public function updateCategory($request, $response, $args)
    {  
        $page = new PageAdmin();
        $page->setTpl('index');
    }

    public function updateUser($request, $response, $args)
    {
        $user = new User();
        if($request->isPost()){
            $user->update((int)$args['id'],$request->getParsedBody());
            header('Location: /app/admin/user');
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('update-user',[    
            "user" => $user->read((int)$args['id'])[0]
            
        ]);
    }

    public function updateUserPassword($request, $response, $args)
    {
        $user = new User();
        if($request->isPost()){
            $user->update((int)$args['id'],$request->getParsedBody());
            header('Location: /app/admin/user');
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('update-user-password',[
            "user" => ["id_user" => (int)$args['id']]
        ]);
    }

    public function updateProvider($request, $response, $args)
    {
        
        if($request->isPost()){
            
        }
        $page = new PageAdmin();
        $page->setTpl('update-provider',[

        ]);
    }
    // END Update

    // Delete

    public function deleteProduct($request, $response, $args)
    {  
        $product = new Product();
        $product->delete((int)$args['id']);
        header('Location: /app/admin/product');
        exit;
    }

    public function deleteBrand($request, $response, $args)
    {  
        $brand = new Brand();
        $brand->delete((int)$args['id']);
        header('Location: /app/admin/brand');
        exit;
    }

    public function deleteCategory($request, $response, $args)
    {  
        $category = new Category();
        $category->delete((int)$args['id']);
        header('Location: /app/admin/category');
        exit;
    }

    public function deleteUser($request, $response, $args)
    {
        $user= new User();
        $user->delete((int)$args['id']);
        header('Location: /app/admin/user');
        exit;
    }

    public function deleteProvider($request, $response, $args)
    {
        $provider = new Provider();
        $provider->delete((int)$args['id']);
        header('Location: /app/admin/provider');
        exit;
    }
    // END Delete
}