<?php 

namespace App\Controller\Views;

use App\Controller\Page;
use App\Model\Product;
use App\Model\Category;

class ClassSite
{

    public function notFound($request, $response, $args)
    {
        $page = new Page();
        return $page->setTpl('error/404');
    }
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
        
        $product = new Product();
        $page = new Page();
        return $page->setTpl('product',[
            "product" => $product->read(),
        ]);
    }

    public function singleProduct($request, $response, $args)
    {
        $page = new Page();
        $product = new Product();
        $category = new Category();
        // var_dump($category->read($product->read((int)$args['id'])[0]['id_category']));exit;
        return $page->setTpl('single-product',[
            "product" => $product->read((int)$args['id'])[0],
            "category" => $category->read($product->read((int)$args['id'])[0]['id_category'])[0]
        ]);
    }
}