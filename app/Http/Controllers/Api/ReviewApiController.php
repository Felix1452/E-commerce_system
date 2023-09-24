<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReviewApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $a = DB::select('select * from reviews where idsp='.$request->idsp);
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
                    'message' => "That bai",
                    'result'=>$a
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
    public function store(Request $request)
    {
        $a = DB::insert('insert into reviews (name,email,content,idsp) VALUES ("'.$request->name.'","'.$request->email.'","'.$request->content.'",'.$request->idsp.')');
        if($a){
            $arr =  [
                    'success' => true,
                    'message' => "Thanh cong",
                ];
            return response($arr,200);
        }else{
            $arr =  [
                    'success' => false,
                    'message' => "That bai"
                ];
            return response($arr,200);
        }
        // if($a){
        //     $arr =  [
        //             'success' => true,
        //             'message' => "Thanh cong",
        //         ];
        //     return response($arr,200);
        // }else{
        //     $arr =  [
        //             'success' => false,
        //             'message' => "That bai"
        //         ];
        //     return response($arr,200);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
