<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\User\UserAdminService;
use App\Models\staffs;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;
use App\Http\Services\User\UserService;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $userService;
    protected $userAdminService;
    public function __construct(UserService $userService, UserAdminService $userAdminService){
        $this->userService = $userService;
        $this->userAdminService = $userAdminService;
    }
    public function index(Request  $request)
    {
        // $data = $request->input();
        // $arr = [
        //     'success' => true,
        //     'message' => "Thanh cong",
        //     'email'=>$request->email
        // ];

        // return response($arr,200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        $data = $request;
        if($data["email"] != null && $data["password"] != null){
            $user = User::where('email',$data["email"])->first();
            if(!$user || !Hash::check($data["password"], $user->password)){
                $arr = [
                    'success' => false,
                    'message' => "That bai",
                ];
                return response($arr,200);
            }else{
                $a = DB::select('select * from users where email ="'.$data["email"].'"');
                $arr = [
                    'success' => true,
                    'message' => "Thanh cong",
                    'result'=>$a
                ];
                return response($arr,200);
            }
        }else{
            $arr = [
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
    public function dangki(Request $request)
    {
        $data = $request;
        $mobi = DB::select('select * from users where mobile='.$data["mobile"]);
        $email = DB::select('select * from users where email="'.$data["email"].'"');
        if($mobi){
            $arr = [
                    'success' => false,
                    'message' => "Sdt ton tai"
                ];
                return response($arr,200);
        }else if($email){
            $arr = [
                    'success' => false,
                    'message' => "Email ton tai"
                ];
                return response($arr,200);
        }else{
            if($data["email"] != null && $data["password"] != null && $data["name"] != null && $data["mobile"] != null && $data["uid"] != null){
                $result = $this->userService->create($request);
                if ($result){
                    $arr = [
                        'success' => true,
                        'message' => "Thanh cong"
                    ];
                }else{
                    $arr = [
                        'success' => false,
                        'message' => "That bai"
                    ];
                }
                return response($arr,200);
            }else{
                $arr = [
                        'success' => false,
                        'message' => "That bai"
                    ];
                    return response($arr,200);
            }
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateToken(Request $request)
    {
        $result = DB::update('update users set token = "'.$request->token.'" where id = '.$request->id);
        if($result){
            $arr = [
                'success' => true,
                'message' => "Thanh cong"
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "That bai",
                'token'=>$request->token,
                'id'=>$request->id
            ];
        }
        return response($arr,200);
    }

    public function getTokenAdmin(Request $request)
    {
        $per = $request->per;
        $user = DB::select('select * from users where id='.$per);
        if( !empty($user) ){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $user
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'  => $user

            ];
        }
        return response($arr,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function getUser(){
        $user = DB::select('select * from users');
        if( !empty($user) ){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $user
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'  => $user

            ];
        }
        return response($arr,200);
    } 
    public function getUserStaff(){
        $user = DB::select('select * from users where active != 4');
        if( !empty($user) ){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $user
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'  => $user

            ];
        }
        return response($arr,200);
    } 
    
    public function getUserIntern(){
        $user = DB::select('select * from users where active = 5');
        if( !empty($user) ){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $user
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'  => $user

            ];
        }
        return response($arr,200);
    }
    
    
    
    
    
    public function insertUser(Request $request)
    {
//        dd($request->input());
        $this->validate($request ,[
            'username'=> 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'birth'      => 'required|date|before_or_equal:now',
            'sex' => 'required',
            'per' => 'required',
            'address' => 'required',
            'pass' => 'required'
        ]);
//        dd($request->input());
        // $result = true;
        $result = $this->userAdminService->insertUser($request);
        if($result){
            $arr = [
            'success' => true,
            'message' => "Thanh cong"
            ];
            return response($arr,200);
        }else
        {
            $arr = [
            'success' => true,
            'message' => "That bai"
            ];
            return response($arr,200);
        }
    }
    
    public function updateUser(Request $request)
    {
//        dd($request->input());
        $this->validate($request ,[
            'username'=> 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'birth'      => 'required|date|before_or_equal:now',
            'sex' => 'required',
            'per' => 'required',
            'address' => 'required',
            'pass' => 'required',
            'email_old'=>'required'
        ]);
//        dd($request->input());
        // $result = true;
        $result = $this->userAdminService->updateUserApi($request);
        if($result){
            $arr = [
            'success' => true,
            'message' => "Thanh cong"
            ];
            return response($arr,200);
        }else
        {
            $arr = [
            'success' => true,
            'message' => "That bai"
            ];
            return response($arr,200);
        }
    }
    public function updateIntern(Request $request)
    {
        if($request->input('id') == ""){
            $arr = [
            'success' => true,
            'message' => "That bai"
            ];
            return response($arr,200);
        }
        // $result = true;
        $result = $this->userAdminService->updateUserInternApi($request);
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
            ];
            return response($arr,200);
        if($result){
            $arr = [
            'success' => true,
            'message' => "Thanh cong"
            ];
            return response($arr,200);
        }else
        {
            $arr = [
            'success' => true,
            'message' => "That bai"
            ];
            return response($arr,200);
        }
    }
    
   
     
     
    public function destroyUser(Request $request)
    {
        $id = (int)$request->input('id');
        // $user = true;
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
            $arr = [
                'success' => true,
                'message' => "Thanh cong"
            ];
            return response($arr,200);
        }
        $arr = [
            'success' => false,
            'message' => "That bai"
        ];
        return response($arr,200);
    }
}
