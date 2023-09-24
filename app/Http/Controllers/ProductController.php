<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index($id = '', $slug =''){

        $product = $this->productService->show($id);
        $productsMore = $this->productService->more($product);
        $productImg = $this->productService->showImg($id);
        $day = Carbon::now()->dayOfYear;
        return view('products.content',[
            'title' =>$product->name,
            'product' => $product,
            'productImg' => $productImg,
            'products' => $productsMore,
            'day' => $day
        ]);
    }
}
