<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartService;
use App\Models\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index(){
        return view('admin.carts.customer',[
            'title' => 'Danh sách đơn đặt hàng ',
            'customers' => $this->cart->getCustomer()
        ]);
    }

    public function show(Customer $customer){

        return view('admin.carts.detail', [
            'title' => 'Chi tiết đơn hàng ' .$customer->name,
            'customer' => $customer,
            'carts' => $customer->carts()->with('product')->get()
        ]);
    }
    public function edit(Customer $customer){

        return view('admin.carts.edit', [
            'title' => 'Chỉnh sửa đơn hàng ' .$customer->name,
            'customer' => $customer
        ]);
    }
    public function update(Customer $customer, Request $request){
        $result = $this->cart->updateAdmin($customer, $request);
        if($result){
            return redirect('/admin/customers/list');
        }
        return redirect()->back();
    }
    public function waitForConfirm(){
        return view('admin.carts.status',[
            'title' => 'Danh sách đơn đặt hàng chờ xác nhận ',
            'customers' => $this->cart->getWaitForConfirm(),
        ]);
    }
    public function confirm(Customer $customer){
        $result = $this->cart->confirm($customer);
        return redirect()->back();
    }
}
