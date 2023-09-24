<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductService;
use Illuminate\Http\Request;
use App\Models\Product;
use function Psr\Log\error;
use function Spatie\Ignition\ErrorPage\title;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this -> productService = $productService;
    }


    public function index()
    {
        return view('admin.products.list', [
            'title' => 'Danh sách sản phẩm mới nhất ',
            'products' => $this->productService->get()
        ]);
    }

    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'menus' =>$this -> productService ->getMenu()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $result = $this->productService->insert($request);
        if($result){
            return redirect('/admin/products/list');
        }
        else
        {
            return redirect()->back();
        }

    }

    public function show(Product $product)
    {
        return view('admin.products.edit',[
            'title' => 'Chỉnh sửa sản phẩm: '. $product->name,
            'products' => $product,
            'menus' =>$this -> productService ->getMenu()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if($result){
            return redirect('/admin/products/list');
        }
        else
            return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' => 'Xóa sản phẩm thành công!'
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
