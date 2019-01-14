<?php


$app->get('/', \App\Controller\Views\ClassSite::class . ':index')->setName('index');

$app->get('/404', \App\Controller\Views\ClassSite::class . ':notFound')->setName('404');

$app->get('/about', \App\Controller\Views\ClassSite::class . ':aboutUs')->setName('about');

$app->get('/contact', \App\Controller\Views\ClassSite::class . ':contact')->setName('contact');

$app->get('/product', \App\Controller\Views\ClassSite::class . ':product')->setName('product');

$app->get('/cart', \App\Controller\Views\ClassSite::class . ':cart')->setName('cart');

$app->get('/product/details/{id}', \App\Controller\Views\ClassSite::class . ':singleProduct')->setName('pagination-product');

$app->post('/product/details/{id}', \App\Controller\Views\ClassSite::class . ':singleProduct')->setName('single-product');

$app->get('/checkout', \App\Controller\Views\ClassSite::class . ':checkout')->setName('checkout');


