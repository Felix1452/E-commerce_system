<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserAdminService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userAdminService;

    public function __construct(UserAdminService $userAdminService)
    {
        $this -> userAdminService = $userAdminService;
    }
    public function index()
    {
        $result = $this -> userAdminService->getProfile(session()->get('email'));
//        dd($result);
        return view('admin.profiles.list', [
            'title' => 'Thông tin cá nhân ',
            'users'=>$result
        ]);
    }
}
