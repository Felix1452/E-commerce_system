<?php

namespace App\Http\Controllers;

use App\Models\Customers_after;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomersAfterController extends Controller
{
    public function send(Request $request){
        try {
            if ((Customers_after::where('email', $request->input('email'))
                ->where('product_id', $request->input('product_id'))
                ->first())!==null){
                Session::flash('error','Bạn đã đăng kí nhận thông tin về sản phẩm rồi!');
            }
            else
            {
                Customers_after::create([
                    'name' =>(string)$request->input('name'),
                    'email' =>(string)$request->input('email'),
                    'phone' =>(string)$request->input('phone'),
                    'product_id' =>(int) $request->input('product_id')
                ]);
                Session::flash('success','Cảm ơn bạn đã để lại thông tin! chúng tôi sẽ liên hệ lại bạn sớm nhất sau khi hàng về');
            }
        }
        catch (\Exception $err){
            Session::flash('error',$err->getMessage());
        }
        return redirect()->back();
    }
}
