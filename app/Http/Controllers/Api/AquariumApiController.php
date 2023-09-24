<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Aquarium\AquariumService;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\Smarthome\SmarthomeService;

class AquariumApiController extends Controller
{
    protected $aquariumService;
    public function __construct(AquariumService $aquariumService, SmarthomeService $smarthomeService)
    {
        $this->aquariumService = $aquariumService;
        $this->smarthomeService = $smarthomeService;
    }

    public function insertDHT11AquariumIOT($topic, $nd, $da, $ndn, $tds, $ntu, $distance, $ph){


        ##test
//        if ($ph == null){
//            $arr = [
//                'success' => false,
//                'message' => "ph null",
//            ];
//            return response($arr,200);
//        }


        $result = $this->aquariumService->createAquarium($topic, $nd, $da, $ndn, $tds, $ntu, $distance, $ph);
        $user1 = $this->smarthomeService->getUser($topic);
        $user = $user1[0];

        if($nd > 40){
            $dht11 = $this->aquariumService->getAquariumTop1($topic);
            Mail::send('mail.sendDht11', ['dht11s' => $dht11,'user'=>$user], function ($m) use ($user) {
                        $m->from('phuchuynh1453@gmail.com', 'SMARTHOME');
                        $m->to($user->email, $user->name)->subject('Cảm ơn đã sử dụng dịch vụ từ SMART HOME!');
                    });
            $arr = [
                'success' => true,
                'message' => $dht11,
                'user'=>$user
            ];
            return response($arr,200);
        }

        if($result){
            $arr = [
                'success' => true,
                'message' => "Thanh cong",
                'user'=>$user
            ];
            return response($arr,200);
        }else{
            $arr = [
                'success' => false,
                'message' => "That bai",
                'user'=>$user
            ];
            return response($arr,200);
        }
    }

    public function getAquarium(Request $request){
        $result = $this->aquariumService->getAquarium($request->input('mobile'));
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
        ];
        return response($arr,200);
    }


    public function getAquariumTop1(Request $request){
        $result = $this->aquariumService->getAquariumTop1($request->input('mobile'));
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
        ];
        return response($arr,200);
    }

    public function getWeatheDay(Request $request){

        $result = $this->aquariumService->getWeather($request->input('mobile'));
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
        ];
        return response($arr,200);
    }

}
