<?php 


$app->group('/admin',function (\Slim\App $app){

    $app->group('/user',function (\Slim\App $app){

        $app->get('', \App\Controller\Views\ClassUser::class.':index');
    
        $app->get('/create', \App\Controller\Views\ClassUser::class.':create');
        $app->post('/create', \App\Controller\Views\ClassUser::class.':create');
    
        $app->get('/update/{id}', \App\Controller\Views\ClassUser::class.':update');
        $app->post('/update/{id}', \App\Controller\Views\ClassUser::class.':update');
    
        $app->get('/delete/{id}', \App\Controller\Views\ClassUser::class.':delete');
        $app->post('/delete/{id}', \App\Controller\Views\ClassUser::class.':delete');
    });
});