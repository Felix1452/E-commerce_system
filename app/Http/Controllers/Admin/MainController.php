<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Cart\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){
        $doanhthunam2 = $this->cartService->getTunoverYear2();
        $doanhthunam1 = $this->cartService->getTunoverYear1();
        $doanhthunamhientai = $this->cartService->getTunoverYearNow();
        if ($doanhthunam2[0] ==  null){
            $doanhthunam2[0] = 0;
        }
        if ($doanhthunam1[0] ==  null){
            $doanhthunam1[0] = 0;
        }
        if ($doanhthunamhientai[0] ==  null){
            $doanhthunamhientai[0] = 0;
        }
        $doanhthuthanghientai = $this->cartService->getTunoverMonthyNow();
        $quy = $this->cartService->getQuaterlyNow();
        $doanhthutheoquyhientai= $this->cartService->getTunoverQuarterlyNow($quy);
        $task = $this->cartService->task();
        if ($task[0] == null){
            $task[0] = 1;
        }
        $mission = 110 * $task[0] / 100;
        $taskNow = ($doanhthuthanghientai[0] / $mission) * 100;
        $customer = $this->cartService->customer();
        $thang1 =   $this->cartService->getTunoverMonthy(1);
        $thang2 =   $this->cartService->getTunoverMonthy(2);
        $thang3 =   $this->cartService->getTunoverMonthy(3);
        $thang4 =   $this->cartService->getTunoverMonthy(4);
        $thang5 =   $this->cartService->getTunoverMonthy(5);
        $thang6 =   $this->cartService->getTunoverMonthy(6);
        $thang7 =   $this->cartService->getTunoverMonthy(7);
        $thang8 =   $this->cartService->getTunoverMonthy(8);
        $thang9 =   $this->cartService->getTunoverMonthy(9);
        $thang10 =  $this->cartService->getTunoverMonthy(10);
        $thang11 =  $this->cartService->getTunoverMonthy(11);
        $thang12 =  $this->cartService->getTunoverMonthy(12);
        if($thang1[0] == null){
            $thang1[0] = 0;
        }
        if($thang2[0] == null){
            $thang2[0] = 0;
        }
        if($thang3[0] == null){
            $thang3[0] = 0;
        }
        if($thang4[0] == null){
            $thang4[0] = 0;
        }
        if($thang5[0] == null){
            $thang5[0] = 0;
        }
        if($thang6[0] == null){
            $thang6[0] = 0;
        }
        if($thang7[0] == null){
            $thang7[0] = 0;
        }
        if($thang8[0] == null){
            $thang8[0] = 0;
        }
        if($thang9[0] == null){
            $thang9[0] = 0;
        }
        if($thang10[0] == null){
            $thang10[0] = 0;
        }
        if($thang11[0] == null){
            $thang11[0] = 0;
        }
        if($thang12[0] == null){
            $thang12[0] = 0 ;
        }
        return view('admin.statistics.statistic', [
            'nam2'=>$doanhthunam2[0],
            'nam1'=>$doanhthunam1[0],
            'hientai'=>$doanhthunamhientai[0],
            'title' => 'Trang quản trị Admin',
            'doanhthuthanghientai'=>$doanhthuthanghientai[0],
            'doanhthutheoquyhientai'=>$doanhthutheoquyhientai,
            'quy'=>$quy,
            'task'=>$taskNow,
            'customer'=>$customer,
            'thang1'=>$thang1[0],
            'thang2'=>$thang2[0],
            'thang3'=>$thang3[0],
            'thang4'=>$thang4[0],
            'thang5'=>$thang5[0],
            'thang6'=>$thang6[0],
            'thang7'=>$thang7[0],
            'thang8'=>$thang8[0],
            'thang9'=>$thang9[0],
            'thang10'=>$thang10[0],
            'thang11'=>$thang11[0],
            'thang12'=>$thang12[0],
        ]);

    }

}
