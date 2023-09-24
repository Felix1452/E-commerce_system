<?php

namespace App\Http\Services\Salary;
use App\Models\salarys;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class SalaryService
{

    public function get(){
        return DB::table('salarys')
            ->join('users', 'users.id', '=', 'salarys.user_id')
            ->select('*')
            ->get();
    }

    public function getCheck($id){
        return DB::table('salarys')
            ->where('user_id',$id)
            ->join('users', 'users.id', '=', 'salarys.user_id')
            ->select('*')
            ->get();
    }


    public function create($request){
        $a = DB::select('select * from salarys where user_id ="'.$request->input('user_id').'" and Year(month) = Year("'.$request->input('month').'") and Month(month) = Month("'.$request->input('month').'")');
//        dd($request->input('user_id'));
//        dd(salarys::all());
        try {
            if (sizeof($a) == 0){
                $users = User::where('id',$request->input('user_id'))->get();
//                dd($users[0]->active);
                if ($users[0]->active == 1){
                    $coefficients_salary = 2;
                }elseif ($users[0]->active == 2){
                    $coefficients_salary = 1.5;
                }elseif ($users[0]->active == 3){
                    $coefficients_salary = 1;
                }else{
                    $coefficients_salary = 0.8;
                }
                $overtime = $request->input('overtime');
                $office_hours = $request->input('office_hours');
                $basic_salary = $request->input('basic_salary');
                $salary = ($basic_salary * $office_hours * $coefficients_salary) + ($overtime * $basic_salary * ( $coefficients_salary + ($coefficients_salary * 50 /100 )));

//                dd($salary);
//                setlocale(LC_MONETARY, 'en_IN');
                $salary2 = number_format($salary, 0, '', ',');;
                salarys::create([
                    'user_id'=>$request->input('user_id'),
                    'basic_salary'=>$basic_salary,
                    'office_hours'=>$office_hours,
                    'coefficients_salary'=>$coefficients_salary,
                    'overtime'=>$overtime,
                    'active'=>$users[0]->active,
                    'salary'=>$salary,
                    'month'=>$request->input('month')
                ]);
                Session::flash("success","Thêm thành công");
                return true;
            }else{
                Session::flash("error","Đã thêm nhân viên ở tháng này");
                return false;
            }
        }catch (\Exception $err){
            Session::flash("error",'Lỗi');
            return false;
        }
    }

    public function update($request, $salarys){
        $a = DB::select('select * from salarys where user_id ="'.$request->input('user_id').'" and Year(month) = Year("'.$request->input('month').'") and Month(month) = Month("'.$request->input('month').'")');
        try {
            if (sizeof($a) == 0){
                $users = User::where('id',$request->input('user_id'))->get();
//                dd($users[0]->active);
                if ($users[0]->active == 1){
                    $coefficients_salary = 2;
                }elseif ($users[0]->active == 2){
                    $coefficients_salary = 1.5;
                }elseif ($users[0]->active == 3){
                    $coefficients_salary = 1;
                }else{
                    $coefficients_salary = 0.8;
                }
                $overtime = $request->input('overtime');
                $office_hours = $request->input('office_hours');
                $basic_salary = $request->input('basic_salary');
                $salary = ($basic_salary * $office_hours * $coefficients_salary) + ($overtime * $basic_salary * ( $coefficients_salary + ($coefficients_salary * 50 /100 )));

//                dd($salary);
//                setlocale(LC_MONETARY, 'en_IN');
//                $salary2 = number_format($salary, 0, '', ',');

                $salarys->user_id = (string) $request->input('user_id');
                $salarys->basic_salary = $request->input('basic_salary');
                $salarys->office_hours = $request->input('office_hours');
                $salarys->coefficients_salary = $coefficients_salary;
                $salarys->overtime = $overtime;
                $salarys->active = $users[0]->active;
                $salarys->salary = $salary;
                $salarys->month = $request->input('month');
                $salarys->save();
                Session::flash('success', 'Cập nhật thành công !');
            }else{
                Session::flash("error","Đã thêm nhân viên ở tháng này");
                return false;
            }
        }
        catch (\Exception $err){
            Session::flash('error','Lỗi');
            return false;
        }
        return true;
    }
    
    public function insertSalary($request){
        $a = DB::select('select * from salarys where user_id ="'.$request->input('user_id').'" and Year(month) = Year("'.$request->input('month').'") and Month(month) = Month("'.$request->input('month').'")');
//        dd($request->input('user_id'));
//        dd(salarys::all());
        try {
            if (sizeof($a) == 0){
                $users = User::where('id',$request->input('user_id'))->get();
//                dd($users[0]->active);
                if ($users[0]->active == 1){
                    $coefficients_salary = 2;
                }elseif ($users[0]->active == 2){
                    $coefficients_salary = 1.5;
                }elseif ($users[0]->active == 3){
                    $coefficients_salary = 1;
                }else{
                    $coefficients_salary = 0.8;
                }
                $overtime = $request->input('overtime');
                $office_hours = $request->input('office_hours');
                $basic_salary = $request->input('basic_salary');
                $salary = ($basic_salary * $office_hours * $coefficients_salary) + ($overtime * $basic_salary * ( $coefficients_salary + ($coefficients_salary * 50 /100 )));
//                dd($salary);
//                setlocale(LC_MONETARY, 'en_IN');
                $salary2 = number_format($salary, 0, '', ',');
                $time = strtotime($request->input('month'));
                $newformat = date('Y-m-d',$time);
                salarys::create([
                    'user_id'=>$request->input('user_id'),
                    'basic_salary'=>$basic_salary,
                    'office_hours'=>$office_hours,
                    'coefficients_salary'=>$coefficients_salary,
                    'overtime'=>$overtime,
                    'active'=>$users[0]->active,
                    'salary'=>$salary,
                    'month'=>$newformat
                ]);
                return true;
            }else{
                Session::flash("error","Đã thêm nhân viên ở tháng này");
                return false;
            }
        }catch (\Exception $err){
            Session::flash("error",'Lỗi');
            return false;
        }
    }
    
    
    public function updateSalaryApi($request){
        $a = DB::select('select * from salarys where user_id ='.$request->input('user_id').' and Year(month) = Year("'.$request->input('month').'") and Month(month) = Month("'.$request->input('month').'")');
//        dd($request->input('user_id'));
//        dd(salarys::all());
        try {
            if (sizeof($a) == 0){
                $users = User::where('id',$request->input('user_id'))->get();
//                dd($users[0]->active);
                if ($users[0]->active == 1){
                    $coefficients_salary = 2;
                }elseif ($users[0]->active == 2){
                    $coefficients_salary = 1.5;
                }elseif ($users[0]->active == 3){
                    $coefficients_salary = 1;
                }else{
                    $coefficients_salary = 0.8;
                }
                $overtime = $request->input('overtime');
                $office_hours = $request->input('office_hours');
                $basic_salary = $request->input('basic_salary');
                $salary = ($basic_salary * $office_hours * $coefficients_salary) + ($overtime * $basic_salary * ( $coefficients_salary + ($coefficients_salary * 50 /100 )));
//                dd($salary);
//                setlocale(LC_MONETARY, 'en_IN');
                $salary2 = number_format($salary, 0, '', ',');
                $time = strtotime($request->input('month'));
                $newformat = date('Y-m-d',$time);
                
                $updateSalary = DB::Update('update salarys set user_id = '.$request->input('user_id').',basic_salary= '.$basic_salary.',office_hours = '.$office_hours.',coefficients_salary = '.$coefficients_salary.',
                active = '.$users[0]->active.',salary='.$salary.',month = "'.$newformat.'" where id = '.$request->input('id'));
                
                // salarys::create([
                //     'user_id'=>$request->input('user_id'),
                //     'basic_salary'=>$basic_salary,
                //     'office_hours'=>$office_hours,
                //     'coefficients_salary'=>$coefficients_salary,
                //     'overtime'=>$overtime,
                //     'active'=>$users[0]->active,
                //     'salary'=>$salary,
                //     'month'=>$newformat
                // ]);
                return true;
            }else{
                Session::flash("error","Đã thêm nhân viên ở tháng này");
                return false;
            }
        }catch (\Exception $err){
            Session::flash("error",'Lỗi');
            return false;
        }
    }


}
