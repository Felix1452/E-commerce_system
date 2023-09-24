<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Staff\StaffService;
use App\Http\Services\User\UserAdminService;
use App\Models\Staff;
use App\Models\staffs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected $staff;
    protected $userAdminService;
    public function __construct(StaffService $staff, UserAdminService $userAdminService)
    {
        $this->staff = $staff;
        $this -> userAdminService = $userAdminService;
    }
    public function index()
    {
        if (session()->get('perr') == 1){
            return view('admin.staffs.list', [
                'title' => 'Danh sách nhân viên',
                'staffs'=>$this -> userAdminService->getStaffAdmin()
            ]);
        }elseif (session()->get('perr') == 2){
            return view('admin.staffs.list', [
                'title' => 'Danh sách nhân viên',
                'staffs'=>$this -> userAdminService->getStaff()
            ]);
        }

    }
    public function intern()
    {
        if (session()->get('perr') == 1 || session()->get('perr') == 2){
            $users = $this -> userAdminService->getIntern();
//            $nhanvienchinhthuc = $staff->created_at;
//            dd($users);
//            foreach ($users as $key => $user){
//                dd($user->created_at);
//            }
            $a = Carbon::now();
            return view('admin.staffs.listIntern', [
                'title' => 'Danh sách nhân viên thực tập',
                'users'=>$users,
                'a'=>$a
            ]);
        }

    }


    public function create()
    {
        return view('admin.users.add', [
            'title' => 'Thêm nhân viên Mới'
        ]);
    }

    public function store(Request $request)
    {
//        dd($request->input());

        $this->validate($request ,[
            'name'=> 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'age'      => 'required|date|before_or_equal:now',
            'sex' => 'required',
            'active' => 'required',
            'address' => 'required',
            'password' => 'required',
            'repass'=>'required|same:password'
        ]);
//        dd($request->input());
        if(session()->get('perr') == 1 || session()->get('perr') == 2){
            $result = $this->userAdminService->create($request);
            if($result){
                return redirect()->route('admin.staffs.list');
            }else
            {
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
