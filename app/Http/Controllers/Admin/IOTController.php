<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Aquarium\AquariumService;
use Illuminate\Http\Request;

class IOTController extends Controller
{
    protected $becaService;

    public function __construct(AquariumService $becaService){
        $this->becaService = $becaService;

    }

    public function index(){

//        dd(session()->get('phone'));
        $getLast = $this->becaService->getAquariumTop1(session()->get('phone'));
        $getAll = $this->becaService->getAquariumAll(session()->get('phone'));

//        dd($getAll);
//        dd($getLast);
        return view("admin.iots.iot",[
            "title"=>"Smart Home",
            "Aquariums"=>$getLast,
            "AquariumAll"=>$getAll

        ]);
    }
}
