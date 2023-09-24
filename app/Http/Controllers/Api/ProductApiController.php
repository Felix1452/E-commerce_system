<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slidebarapp;
use App\Models\Product;
use App\Http\Services\Product\ProductService;

class ProductApiController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this -> productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slidebar()
    {
        $a = DB::select('select * from slidebarapps');
        if($a){
            $arr =  [
                    'success' => true,
                    'message' => "Thanh cong",
                    'result'=>$a
                ];
            return response($arr,200);
        }else{
            $arr =  [
                    'success' => false,
                    'message' => "That bai"
                ];
            return response($arr,200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProductNew()
    {
        $a = DB::select('select * from products order by id desc limit 20');
        if($a){
            $arr =  [
                    'success' => true,
                    'message' => "Thanh cong",
                    'result'=>$a
                ];
            return response($arr,200);
        }else{
            $arr =  [
                    'success' => false,
                    'message' => "That bai"
                ];
            return response($arr,200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kindProduct(Request $request)
    {
        $page = $request->page;
        $loai = $request->loai;
    
        $total = 5; //can lay 5 sp tren 1 trang
        $pos = ($page - 1) * $total; //neu truyen vao trang 1 thi se lay tu 0 - 4, 2 thi 5 - 9
    
        $query = 'SELECT * FROM `spmoi` WHERE `loai` = '.$loai.' LIMIT '.$pos.','.$total.'';
        $a = DB::select('select * from products where loai= "'.$loai.'" LIMIT '.$pos.','.$total.'');
        if( !empty($a) ){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $a
            ];
    
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'  => $a
            ];
        }
        return response($arr,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
