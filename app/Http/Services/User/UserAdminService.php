<?php

namespace App\Http\Services\User;

use App\Models\User;
use App\Models\staffs;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserAdminService
{
    public function create($request){
        $a = DB::select('select email from users where email ="'.$request->input('email').'"');
        try {
            if (sizeof($a) == 0){
                $namsinh = $request->input('birth');
                $time = strtotime($namsinh);
                $newformat = date('Y-m-d',$time);
                $a = Carbon::now();
                $age = $a->diffInYears($newformat);
                if ($request->input('active') == 3){
                    $active = 5;
                }
//                dd($age);
                User::create([
                    'name'=>(string)$request->input('name'),
                    'email'=>(string)$request->input('email'),
                    'mobile'=>(string)$request->input('mobile'),
                    'active'=>(integer)$active,
                    'birth'=>(string)$request->input('birth'),
                    'age'=>(integer)$age,
                    'sex'=>(string)$request->input('sex'),
                    'address'=>(string)$request->input('address'),
                    'img'=>(string)$request->input('img'),
                    'password'=>bcrypt($request->input('password'))
                ]);
                Session::flash("success","Tạo tài khoản thành công");
                return true;
            }else{
                Session::flash("error","Tài khoản tồn tại");
                return false;
            }
        }catch (\Exception $err){
            Session::flash("error",'Lỗi');
            return false;
        }
    }

    public function get(){
        return User::orderByDesc('id')->paginate(10);
    }
    public function getProfile($email){
        return User::where('email',$email)->get();
    }

    public function getStaffAdmin(){
        return User::where('active',1)
            ->orWhere('active',2)
            ->orWhere('active',3)
            ->orWhere('active',5)
            ->orderByDesc('id')
            ->paginate(10);
    }

    public function getStaff(){
        return User::where('active',3)->orderByDesc('id')->paginate(10);

    }

    public function getIntern(){
        return User::where('active',5)->orderByDesc('id')->paginate(10);
    }

    public function update($request, $user){
        try {
            $namsinh = $request->input('birth');
            $time = strtotime($namsinh);
            $newformat = date('Y-m-d',$time);
            $a = Carbon::now();
            $age = $a->diffInYears($newformat);
            //-----------------------
            $user->name = (string) $request->input('name');
            $user->email = (string) $request->input('email');
            $user->birth = (string) $request->input('birth');
            $user->mobile = (string) $request->input('mobile');
            $user->age = $age;
            $user->address = (string) $request->input('address');
            $user->sex = (string) $request->input('sex');
            $user->password = bcrypt($request->input('password'));
            if($request->input('active')==''){
                $user->active  = 4;
            }
            else{
                $user->active = (integer) $request->input('active');
            }
            $user->save();
            Session::flash('success', 'Cập nhật thành công !');
        }
        catch (\Exception $err){
            Session::flash('error','Lỗi');
            return false;
        }
        return true;
    }

    public function updateIntern($user, $active){
        try {
            $user->active = (integer) $active;
            $user->save();
            Session::flash('success', 'Cập nhật thành công !');
        }
        catch (\Exception $err){
            Session::flash('error','Lỗi');
            return false;
        }
        return true;
    }



    public function updatePass($request, $user){
        try {
            $user->password = bcrypt($request->input('repassword'));
            $user->save();
            Session::flash('success', 'Cập nhật thành công !');
        }
        catch (\Exception $err){
            Session::flash('error','Lỗi');
            return false;
        }
        return true;
    }

    public function destroy($request){
        $result2 = User::select('email')->where('id',$request->input('id'))->get();
        if (session()->get('email') == $result2[0]["email"]){
            return false;
        }
        $id = (int)$request->input('id');
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
    
    //--------------API-----------
    public function insertUser($request){
        $a = DB::select('select email from users where email ="'.$request->input('email').'"');
        try {
            if (sizeof($a) == 0){
                $active = $request->input('per');
                $namsinh = $request->input('birth');
                $time = strtotime($namsinh);
                $newformat = date('Y-m-d',$time);
                $a = Carbon::now();
                $age = $a->diffInYears($newformat);
                if ($request->input('per') == 3){
                    $active = 5;
                }
//                dd($age);
                User::create([
                    'name'=>(string)$request->input('username'),
                    'email'=>(string)$request->input('email'),
                    'mobile'=>(string)$request->input('mobile'),
                    'password'=>bcrypt($request->input('pass')),
                    'active'=>$active,
                    'birth'=>$request->input('birth'),
                    'age'=>$age,
                    'sex'=>$request->input('sex'),
                    'address'=>$request->input('address'),
                    'img'=>$request->input('img'),
                    'uid'=>(string)$request->input('uid')
                ]);
                return true;
            }else{
                return false;
            }
        }catch (\Exception $err){
            return false;
        }
    }
    
    //----Update---
    public function updateUserApi($request){
        $a = DB::select('select email from users where email ="'.$request->input('email').'"');
        try {
            if (sizeof($a) == 1 && $request->input('email') != $request->email_old ){
                return false;
            }else{
                $name = $request->input('username');
                $email = $request->input('email');
                $mobile = $request->input('mobile');
                $pass = bcrypt($request->input('pass'));
                $birth = $request->input('birth');
                $sex = $request->input('sex');
                $address = $request->input('address');
                $uid = $request->input('uid');
                $img = $request->input('img');
    
                $active = $request->input('per');
                $namsinh = $request->input('birth');
                $time = strtotime($namsinh);
                $newformat = date('Y-m-d',$time);
                $a = Carbon::now();
                $age = $a->diffInYears($newformat);
                if ($request->input('per') == 3){
                    $active = 5;
                }
//                dd($age);

                $result = DB::update('update users set name ="'.$name.'",email="'.$email.'",mobile="'.$mobile.'",password="'.$pass.'",active='.$active.',birth="'.$birth.'",age='.$age.',sex = "'.$sex.'", address = "'.$address.'", img = "'.$img.'", uid = "'.$uid.'" where id = '.$request->input('id').'');
                return true;
            }
        }catch (\Exception $err){
            return false;
        }
    }
    public function updateUserInternApi($request){
        $intern = DB::select('select * from users where id ='.$request->input('id'));
        try {
            $a = Carbon::now();
            $nam = $a->diffInYears($intern[0]->created_at);
            $thang = $a->diffInMonths($intern[0]->created_at);
            if($nam >= 1){
                $result = DB::update('update users set active = 3 where id = '.$request->input('id'));
                if($result){
                    return true;
                }else{
                    return false;
                }
            }else if($nam ==0 && $thang >=3){
                $result = DB::update('update users set active = 3 where id = '.$request->input('id'));
                if($result){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }catch (\Exception $err){
            return false;
        }
    }
    
    

}
