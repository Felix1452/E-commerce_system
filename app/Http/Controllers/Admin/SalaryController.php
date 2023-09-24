<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Salary\SalaryService;
use App\Http\Services\User\UserAdminService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\salarys;
use Illuminate\Support\Facades\Session;


class SalaryController extends Controller
{
    protected $userAdminService;
    protected $salary;

    public function __construct(UserAdminService $userAdminService, SalaryService $salary)
    {
        $this -> userAdminService = $userAdminService;
        $this -> salary = $salary;
    }
    public function index()
    {
        return view('admin.salarys.list', [
            'title' => 'Danh sách tài khoản',
            'salarys' => $this->salary->get()
        ]);
    }



    public function check(User $user)
    {
//        dd($user->id);

        $salarys = $this->salary->getCheck($user->id);
//        dd($salarys);
        return view('admin.salarys.detail', [
            'title' => 'Chi tiết lương',
            'users'=>$user,
            'salarys'=>$salarys
        ]);
    }
    public function create()
    {
//        dd($this->salary->get());
        return view('admin.salarys.add', [
            'title' => 'Thêm bảng lương',
            'users' => $this->userAdminService->get()
        ]);
    }
    public function store(Request $request)
    {
//        dd($request->input());
        $this->validate($request ,[
            'user_id' => 'required',
            'basic_salary' => 'required',
            'office_hours' => 'required',
            'overtime' => 'required',
            'month' => 'required|date|before_or_equal:now'
        ]);
//        dd($request->input());
        if(session()->get('perr') == 1 || session()->get('perr') == 2){
            $result = $this->salary->create($request);
            if($result){
                return redirect()->route('salary');
            }else
            {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function show(salarys $salarys){
//        dd($salarys);
        $users = $this->salary->getCheck($salarys->user_id);
//        dd($users);
        return view('admin.salarys.edit',[
            'title' => 'Chỉnh sửa lương: '. $salarys->user_id,
            'users' => $users
        ]);
    }
    public function update(salarys $salarys, Request $request){
//        dd($salarys);
//        dd($request->input());
        if (session()->has('perr')){
            if (session()->get('perr') == 1 || session()->get('perr') == 2){
                $this->validate($request ,[
                    'user_id' => 'required',
                    'basic_salary' => 'required',
                    'office_hours' => 'required',
                    'overtime' => 'required',
                    'month' => 'required|date|before_or_equal:now'
                ]);
                $result = $this->salary->update($request, $salarys);
                if($result){
                    return redirect()->route('salary');
                }
                else
                    return redirect()->back();
            }
        }
    }



}
