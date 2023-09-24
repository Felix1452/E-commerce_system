<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class OrderApiController extends Controller
{
    public function index(Request $request)
    {
        $sdt = $request->sdt;
        $email = $request->email;
        $tongtien = $request->tongtien;
        $iduser = $request->iduser;
        $diachi = $request->diachi;
        $soluong = $request->soluong;
        $chitiet = $request->chitiet;
        $name = $request->username;

        $data = DB::insert('insert into customers (name,phone,address,email,totalitem,tongtien,user_email,iduser) VALUES ("'.$name.'","'.$sdt.'","'.$diachi.'","'.$email.'",'.$soluong.','.$tongtien.',"'.$email.'",'.$iduser.')');
        if( $data == true ){
            $iddonhang = DB::select('select id as customer_id from customers where email= "'.$email.'" order by id desc limit 1 ');
        
            if(!empty($iddonhang)){
                //co don hang
                $chitiet = json_decode($chitiet, true);
                foreach ($chitiet as $key => $value) {
                    $data = DB::insert('insert into carts (customer_id,product_id,pty,price) VALUES ('.$iddonhang[0]->customer_id.','.$value["idsp"].','.$value["soluong"].','.$value["giasp"].')');
                    DB::update('update products set quantity = quantity -'.$value["soluong"].' where id = '.$value["idsp"]);
                    $slcart = DB::select('select * from carts  where customer_id ='.$iddonhang[0]->customer_id);
                }
                if($data == true){
                    $carts = Cart::select()->where('customer_id',$iddonhang[0]->customer_id)->get();
                    $customer1 = Customer::select()->where('id',$iddonhang[0]->customer_id)->orderBy('id', 'desc')->limit(1)->get();
                    $customer = $customer1[0];
                    Mail::send('mail.success', ['customer' => $customer, 'carts' => $carts], function ($m) use ($customer) {
                        $m->from('phuchuynh1453@gmail.com', 'HPSTORE');
                        $m->to($customer->email, $customer->name)->subject('Cảm ơn đã mua hàng từ HPStore!');
                    });
                    $arr = [
                        'success' => true,
                        'message' => "Thanh cong"
                    ];
                }else{
                    $arr = [
                        'success' => false,
                        'message' => "Khong thanh cong"
                    ];
                }
                return response($arr,200);

            }
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong"
            ];
            return response($arr,200);
        }
    }

    public function showAll(Request $request)
    {
        $email = $request->email;
        $active = $request->active;
        $result = array();
        if($active == 1){
            $result = DB::select('select * from customers order by id desc');
        }else{
            $result = DB::select('select * from customers where email= "'.$email.'"order by id desc');
        }
        $i = 0;
        $result2 = array();
        while ((sizeof($result) - 1) - $i >= 0){
            $truyvan = DB::select('SELECT * FROM carts inner join products on carts.product_id = products.id  WHERE carts.customer_id = '.$result[$i]->id);
            $item = array();
            $j=0;
            while ((sizeof($truyvan)-1)-$j >= 0 ){
                $item[] = $truyvan;
                $j++;
            }
            $result[$i]->item=$item[0];
            $result2[] = ($result);
            $i++;
        }


        if(!empty($result2)){
            $arr = [
                'success' => false,
                'message' => "Thanh cong",
                'result'=>$result2[0]
            ];
            return response($arr,200);
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'=>$result2
            ];
        }
        return response($arr,200);
    }

    public function getOder(Request $request){
        $id = $request->id;

        $query = DB::select('SELECT * FROM customers WHERE `id` ='.$id);
        if($query){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $query
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong"

            ];
        }
        return response($arr,200);
    }
    public function getToken(Request $request){
        $id = $request->id;
        $query = DB::select('SELECT * FROM users WHERE `id` ='.$id);
        if($query){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $query
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong"

            ];
        }
        return response($arr,200);
    }

    public function updateOrder(Request $request){
        $id = $request->id;
        $status = $request->status;

        $query = DB::update('update customers set status = "'.$status.'" where id = '.$id);
        if($query){
            $arr = [
                'success' => true,
                'message' => "Thanh cong"
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong"

            ];
        }
        return response($arr,200);
    }

}
