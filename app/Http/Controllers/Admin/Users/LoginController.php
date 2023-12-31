<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartService;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $userService;
    protected $cartService;
    public function __construct(UserService $userService, CartService $cartService){
        $this->userService = $userService;
        $this->cartService = $cartService;
    }

    public function index(){
        return view('admin.users.login',[
            'title'=>'Đăng nhập Admin'
        ]);
    }
    public function store(Request $request){
        $this->validate($request ,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'active'=>1
        ], $request ->input('remember')
        )){
            session()->put("email", $request->input('email'));
            session()->put("perr", 1);
            $result = $this->userService->getName($request);
            session()->put("name", $result[0]['name']);
            $result2 = $this->cartService->getPhone($request);

            if ($result2!=''){
                session()->put("phone", $result2->phone);
                session()->put("address", $result2->address);

            }

            return redirect()->route('admin');
        }else if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'active'=>2
        ], $request ->input('remember')
        )){
            session()->put("email", $request->input('email'));
            session()->put("perr", 2);
            $result = $this->userService->getName($request);
            session()->put("name", $result[0]['name']);
            $result2 = $this->cartService->getPhone($request);
            if ($result2!=''){
                session()->put("phone", $result2->phone);
                session()->put("address", $result2->address);

            }
            return redirect()->route('admin');
        }else if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'active'=>3
        ], $request ->input('remember')
        )){
            session()->put("email", $request->input('email'));
            session()->put("perr", 3);
            $result = $this->userService->getName($request);
            session()->put("name", $result[0]['name']);
            $result2 = $this->cartService->getPhone($request);
            if ($result2!=''){
                session()->put("phone", $result2->phone);
                session()->put("address", $result2->address);

            }
            return redirect()->route('admin');
        }else if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'active'=>4
        ], $request ->input('remember')
        )){
            session()->put("email", $request->input('email'));
            session()->put("perr", 4);
            $result = $this->userService->getName($request);
            session()->put("name", $result[0]['name']);
            $result2 = $this->cartService->getPhone($request);
            if ($result2!=''){
                session()->put("phone", $result2->phone);
                session()->put("address", $result2->address);

            }
            return redirect()->route('client');
        }
        Session::flash('error','Email hoặc mật khẩu không chính xác!');
        return redirect()->back();
    }
    public function dangxuat(){
        session()->flush();
        return redirect()->route('login');
    }

}
