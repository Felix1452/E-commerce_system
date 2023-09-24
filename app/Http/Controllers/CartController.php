<?php

namespace App\Http\Controllers;

use App\Http\Services\Cart\CartService;
use App\Http\Services\Paypal\PaypalService;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function show()
    {
        return view('carts.list', [
            'title' => 'Giỏ Hàng',
            'products' => $this->cartService->getProduct(),
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }

    public function addCart(Request $request)
    {
        Session::put('nameP',$request->input('name'));
        Session::put('phoneP',$request->input('phone'));
        Session::put('addressP',$request->input('address'));
        Session::put('emailP',$request->input('email'));
        Session::put('contentP',$request->input('content'));

        if ($_POST['action'] == "Thanh Toán Bằng Paypal") {
            return redirect()->action(
                [PayPalController::class, 'processTransaction']
            );
        }
        else if ($_POST['action'] == "Thanh Toán Khi Nhận Hàng") {
            $this->cartService->addCart($request);
            return redirect()->back();
        }
    }

    public function history(){
        return view('carts.history',[
            'title' => 'Danh sách đơn đặt hàng ',
            'customers' => $this->cartService->getCustomerHistory()
        ]);
    }
    public function checkHistory(Customer $customer){
        return view('carts.detail', [
            'title' => 'Chi tiết đơn hàng ' .$customer->name,
            'customer' => $customer,
            'carts' => $customer->carts()->with('product')->get()
        ]);
    }
    public function deleteHistory(Customer $customer){
        $result = $this->cartService->deleteHistory($customer);
        if($result){
            return redirect()->route('history');
        }
        else
            return redirect()->back();
    }

    public function shipped(Customer $customer){
        $result = $this->cartService->shipped($customer);
        return redirect()->back();
    }
}
