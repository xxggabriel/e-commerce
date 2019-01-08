<?php 


$app->group('/app/admin',function (\Slim\App $app){
    $app->get('', \App\Controller\Views\ClassSiteAdmin::class.':index')->setName('index-admin');
    $app->group('/user',function (\Slim\App $app){

        $app->get('', \App\Controller\Views\ClassSiteAdmin::class.':user')->setName('index-user-admin');
    
        $app->get('/create', \App\Controller\Views\ClassSiteAdmin::class.':createUser')->setName('create-user-admin');
        $app->post('/create', \App\Controller\Views\ClassSiteAdmin::class.':createUser');
    
        $app->get('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readUser')->setName('read-user-admin');
        $app->post('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':read');

        $app->get('/update/{id}', \App\Controller\Views\ClassSiteAdmin::class.':updateUser')->setName('update-user-admin');
        $app->post('/update/{id}', \App\Controller\Views\ClassSiteAdmin::class.':update');
    
        $app->get('/delete/{id}', \App\Controller\Views\ClassSiteAdmin::class.':deleteUser')->setName('delete-user-admin');
    });

    $app->group('/product',function(\Slim\App $app){
        $app->get('', \App\Controller\Views\ClassSiteAdmin::class.':product')->setName('product-admin');

        $app->get('/create', \App\Controller\Views\ClassSiteAdmin::class.':createProduct')->setName('product-create-admin');
        $app->post('/create', \App\Controller\Views\ClassSiteAdmin::class.':createProduct');

        $app->get('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readProduct')->setName('product-read-admin');
        $app->post('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readProduct');

        $app->get('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateProduct')->setName('product-update-admin');
        $app->post('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateProduct');

        $app->get('/delete/{id}', \App\Controller\Views\ClassSiteAdmin::class.':deleteProduct')->setName('product-delete-admin');
        
    });

    $app->group('/brand',function (\Slim\App $app){

        $app->get('', \App\Controller\Views\ClassSiteAdmin::class.':brand')->setName('brand-admin');

        $app->get('create', \App\Controller\Views\ClassSiteAdmin::class.':createBrand')->setName('brand-create-admin');
        $app->post('create', \App\Controller\Views\ClassSiteAdmin::class.':createBrand');

        $app->get('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readBrand')->setName('brand-read-admin');
        $app->post('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readBrand');

        $app->get('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateBrand')->setName('brand-update-admin');
        $app->post('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateBrand');

        $app->get('/delete/{id}', \App\Controller\Views\ClassSiteAdmin::class.':deleteBrand')->setName('brand-delete-admin');
    });


    $app->group('/category',function (\Slim\App $app){

        $app->get('', \App\Controller\Views\ClassSiteAdmin::class.':category')->setName('category-admin');

        $app->get('create', \App\Controller\Views\ClassSiteAdmin::class.':createBrand')->setName('category-create-admin');
        $app->post('create', \App\Controller\Views\ClassSiteAdmin::class.':createBrand');

        $app->get('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readBrand')->setName('category-read-admin');
        $app->post('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readBrand');

        $app->get('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateBrand')->setName('category-update-admin');
        $app->post('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateBrand');

        $app->get('/delete/{id}', \App\Controller\Views\ClassSiteAdmin::class.':deleteBrand')->setName('category-delete-admin');
    });

    $app->group('/provider',function (\Slim\App $app){

        $app->get('', \App\Controller\Views\ClassSiteAdmin::class.':provider')->setName('provider-admin');

        $app->get('create', \App\Controller\Views\ClassSiteAdmin::class.':createProvider')->setName('provider-create-admin');
        $app->post('create', \App\Controller\Views\ClassSiteAdmin::class.':createProvider');

        $app->get('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readProvider')->setName('provider-read-admin');
        $app->post('/{id}', \App\Controller\Views\ClassSiteAdmin::class.':readProvider');

        $app->get('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateProvider')->setName('provider-update-admin');
        $app->post('/{id}/update', \App\Controller\Views\ClassSiteAdmin::class.':updateProvider');

        $app->get('/delete/{id}', \App\Controller\Views\ClassSiteAdmin::class.':deleteProvider')->setName('provider-delete-admin');
    });
});