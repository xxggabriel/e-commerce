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

    // Auxilia a criação de variaveis nas views
    private function requiredForProducts($id = null)
    {
        $brand = new Brand();
        $provider = new Provider();
        $category = new Category();
        $product = new Product();

        if(!empty($id)){
            return [
                "product" => $product->read($id)[0],
                "brand" => $brand->read($product->read($id)[0]['id_brand'])[0],
                "provider" => $provider->read($product->read($id)[0]['id_provider'])[0],
                "category" => $category->read($product->read($id)[0]['id_category'])[0],
                "list_category" => $category->read(), 
                "list_brand" => $brand->read(), 
                "list_provider" => $provider->read(), 
            ];
        } else {
            return [
                "brand" => $brand->read(),
                "provider" => $provider->read(),
                "category" => $category->read(),
                "list_category" => $category->read(), 
                "list_brand" => $brand->read(), 
                "list_provider" => $provider->read(), 
            ];
        }
    }

    public function savePhotoProduct($request, $response, $args)
    {
        $user = new User();
        $user->verifyLogin();
        if($request->isPost()){

            $data = $request->getParsedBody();

            $product = new Product();
            $product->savePhotoProduct((int)$args['id']);
            header("Location: /app/admin/product");
            exit;
        }

        $page = new PageAdmin();
        $page->setTpl('save-photo-product',[
            "product" => [
                "id" => (int)$args['id']
                ]
        ]);
    }

    public function updatePhotoProduct($request, $response, $args)
    {
        $user = new User();
        $user->verifyLogin();
        if($request->isPost()){

            $data = $request->getParsedBody();

            $product = new Product();
            $product->savePhotoProduct((int)$args['id']);
            header("Location: /app/admin/product");
            exit;
        }

        $page = new PageAdmin();
        $page->setTpl('update-photo-product',[
            "product" => [
                "id" => (int)$args['id']
                ]
        ]);
    }

    public function login($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin('/app/admin',false);
        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);
        
        if($request->isPost()){
            $data = $request->getParsedBody();
            $user = new User();
            $result = $user->login($data, 3);

            if(!empty($result)){
                $page->setDataAssign([
                    "error" => [
                        "message" => $result['msg']
                    ]
                ]);
            }
        }
        
        $page->setTpl('login');
    }

    public function register($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin('/app/admin',false);
        $page = new PageAdmin([
            "header" => false,
            "footer" => false
        ]);
        if($request->isPost()){
            // var_dump($request->getParsedBody());exit;
            $data = $request->getParsedBody();
            $user = new User();
            $result = $user->create($data);
            if($result == false){
                $page->setDataAssign([
                    "error" => [
                        "message" => "Email já cadastrado."
                        ]
                ]);
                $page->setTpl('register');
                exit;
            }
            header('Location: /app/login');
            exit;
        }
        
        $page->setTpl('register');

    }

    public function logout($request, $response, $args)
    {
        $user = new User();
        $user->logout();
        header('Location: /app/login');
        exit;
    }

    public function index($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $page = new PageAdmin();
        $page->setTpl('index');
    }

    public function product($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $product = new Product();
        $page = new PageAdmin();
        $page->setTpl('product',[
            "product" => $product->read()
        ]);
    }

    public function brand($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $brand = new Brand();
        $page = new PageAdmin();
        $page->setTpl('brand',[
            "brand" => $brand->read()
        ]);
    }

    public function user($request, $response, $args)
    {      
        $user = new User();
        $user->verifyLogin(); 
        $page = new PageAdmin();
        $page->setDataAssign([
            "user" => $user->read()
        ]);
        $page->setTpl('user');
        
    }

    public function category($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $category = new Category();
        $page = new PageAdmin();
        $page->setTpl('category',[
            "category" => $category->read()
        ]);
    }

    public function provider($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $provider = new Provider();
        $page = new PageAdmin();
        $page->setTpl('provider',[
            "provider" => $provider->read()
        ]);
    }

    // Create

    public function createProduct($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        if($request->isPost()){

            $data = $request->getParsedBody();

            $product = new Product();
            $id = $product->create($data);
            
            header("Location: /app/admin/product/create/photo/".$id['LAST_INSERT_ID()']);
            exit;
        }

        $page = new PageAdmin();
        $page->setTpl('create-product',
            $this->requiredForProducts()
        );
    }

    public function createBrand($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
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
        $user = new User();
        $user->verifyLogin();
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
        
        $user = new User();
        $user->verifyLogin();
        if($request->isPost()){
            // var_dump($request->getParsedBody());exit;
            $data = $request->getParsedBody();
            $user->create($data);
            header("Location: /app/admin/user");
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('create-user');
    }

    public function createProvider($request, $response, $args)
    {
        $user = new User();
        $user->verifyLogin();
        if($request->isPost()){
            $data = $request->getParsedBody();
            $provider = new Provider();
            $provider->create($data);
            header("Location: /app/admin/provider");
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('create-provider');
    }

    // END Create 

    // Update

    public function updateProduct($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();

        if($request->isPost()){
            $product = new Product();
            $product->update((int)$args['id'],$request->getParsedBody());
            header('Location: /app/admin/product');
            exit;
        }
        $page = new PageAdmin();
        // var_dump($this->requiredForProducts((int)$args['id']));exit;
        $page->setTpl('update-product',
            $this->requiredForProducts((int)$args['id'])
        );
    }

    public function updateBrand($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
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
        $user = new User();
        $user->verifyLogin();
        $category = new Category();
        if($request->isPost()){
            $category->update((int)$args['id'],$request->getParsedBody());
            header('Location: /app/admin/category');
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('update-category',[    
            "category" => $category->read((int)$args['id'])[0]
            
        ]);
    }

    public function updateUser($request, $response, $args)
    {
        $user = new User();
        $user->verifyLogin();
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
        $user->verifyLogin();
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
        $user = new User();
        $user->verifyLogin();
        $provider = new Provider();
        if($request->isPost()){
            $provider->update((int)$args['id'],$request->getParsedBody());
            header('Location: /app/admin/provider');
            exit;
        }
        $page = new PageAdmin();
        $page->setTpl('update-provider',[
            "provider" => $provider->read((int)$args['id'])[0]
        ]);
    }
    // END Update

    // Delete

    public function deleteProduct($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $product = new Product();
        $product->delete((int)$args['id']);
        header('Location: /app/admin/product');
        exit;
    }

    public function deleteBrand($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $brand = new Brand();
        $brand->delete((int)$args['id']);
        header('Location: /app/admin/brand');
        exit;
    }

    public function deleteCategory($request, $response, $args)
    {  
        $user = new User();
        $user->verifyLogin();
        $category = new Category();
        $category->delete((int)$args['id']);
        header('Location: /app/admin/category');
        exit;
    }

    public function deleteUser($request, $response, $args)
    {
        $user = new User();
        $user->verifyLogin();
        $user->delete((int)$args['id']);
        header('Location: /app/admin/user');
        exit;
    }

    public function deleteProvider($request, $response, $args)
    {
        $user = new User();
        $user->verifyLogin();
        $provider = new Provider();
        $provider->delete((int)$args['id']);
        header('Location: /app/admin/provider');
        exit;
    }
    // END Delete

    /**
     * Get the value of verify
     */ 
    public function getVerify()
    {
        return $this->verify;
    }

    /**
     * Set the value of verify
     *
     * @return  self
     */ 
    public function setVerify($verify)
    {
        $this->verify = $verify;

    }
}