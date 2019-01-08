<?php


$app->get('/', \App\Controller\Views\ClassSite::class . ':index')->setName('index');
$app->get('/about', \App\Controller\Views\ClassSite::class . ':aboutUs')->setName('about');
$app->get('/contact', \App\Controller\Views\ClassSite::class . ':contact')->setName('contact');
$app->get('/product', \App\Controller\Views\ClassSite::class . ':product')->setName('product');
$app->get('/cart', \App\Controller\Views\ClassSite::class . ':cart')->setName('cart');
$app->get('/product/{id}', \App\Controller\Views\ClassSite::class . ':singleProduct')->setName('single-product');
$app->get('/checkout', \App\Controller\Views\ClassSite::class . ':checkout')->setName('checkout');


