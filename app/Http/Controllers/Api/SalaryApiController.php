<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Salary\SalaryService;
use App\Http\Services\User\UserAdminService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\salarys;
use Illuminate\Support\Facades\Session;

class SalaryApiController extends Controller
{
    protected $userAdminService;
    protected $salary;

    public function __construct(UserAdminService $userAdminService, SalaryService $salary)
    {
        $this -> userAdminService = $userAdminService;
        $this -> salary = $salary;
    }
    
    public function getSalary(){
        $salary = $this->salary->get();
        if( !empty($salary) ){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'result'  => $salary
            ];
        }else{
            $arr = [
                'success' => false,
                'message' => "Khong thanh cong",
                'result'  => $salary

            ];
        }
        return response($arr,200);
    } 
    public function insertSalary(Request $request){
        $salary = $this->salary->insertSalary($request);
        if(!empty($salary) ){
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
    
    public function updateSalary(Request $request)
    {

//        dd($request->input());
        // $result = true;
        $result = $this->salary->updateSalaryApi($request);
        if($result){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'request'=>$result
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
    
    
}
