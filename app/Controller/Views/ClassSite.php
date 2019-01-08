<?php 

namespace App\Controller\Views;

use App\Controller\Page;

class ClassSite
{
    public function index($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('index');
    }

    public function aboutUs($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('about');
    }

    public function contact($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('contact');
    }

    public function cart($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('cart');
    }

    public function checkout($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('checkout');
    }

    public function product($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('product');
    }

    public function singleProduct($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('single-product');
    }
}