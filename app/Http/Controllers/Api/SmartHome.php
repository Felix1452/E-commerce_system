<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Mail;
use App\Models\Dht22;
use App\Http\Services\Smarthome\SmarthomeService;

class SmartHome extends Controller
{
    protected $smarthomeService;
    public function __construct(SmarthomeService $smarthomeService){
        $this->smarthomeService = $smarthomeService;
    }
    public function ChangeCamera(Request $request){
        $mqtt = MQTT::connection();
        $mqtt->publish($request->input('mobile'),$request->input('status'),1);
        $mqtt->disconnect();
    }

    public function ChangeMotor(Request $request){
        $mqtt = MQTT::connection();
        $mqtt->publish($request->input('mobile'),$request->input('status'),1);
        $mqtt->disconnect();

        $arr = [
            'error' => false,
            'success' => true,
            'message' => "Send data successfully"
        ];
        return response($arr,200);
    }

    public function ChangeAutoMotor(Request $request){
        $mqtt = MQTT::connection();
        $mqtt->publish($request->input('mobile'),$request->input('status'),1);
        $mqtt->disconnect();

        $arr = [
            'error' => false,
            'success' => true,
            'message' => "Send data successfully"
        ];
        return response($arr,200);
    }


    public function aquariumIOT($topic, $nd, $da, $ndn, $tds, $ntu, $distance, $ph){
        $result = $this->smarthomeService->createAquarium($topic, $nd, $da, $ndn, $tds, $ntu, $distance, $ph);
        if($nd > 40){
            $user1 = $this->smarthomeService->getUser($topic);
            $user = $user1[0];
            $dht22 = $this->smarthomeService->getDhtTop1($topic);
            Mail::send('mail.sendDht22', ['dht22s' => $dht22,'user'=>$user], function ($m) use ($user) {
                        $m->from('phuchuynh1453@gmail.com', 'SMARTHOME');
                        $m->to($user->email, $user->name)->subject('Cảm ơn đã sử dụng dịch vụ từ SMART HOME!');
                    });
            $arr = [
                'success' => true,
                'message' => $dht22
            ];
            return response($arr,200);
        }

        if($result){
            $arr = [
                'success' => true,
                'message' => "Thanh cong"
            ];
            return response($arr,200);
        }else{
            $arr = [
                'success' => false,
                'message' => "That bai"
            ];
            return response($arr,200);
        }
    }

    public function insertDht22($topic, $nd, $da){
        $result = $this->smarthomeService->create($topic, $nd, $da);
        if($nd > 40){
            $user1 = $this->smarthomeService->getUser($topic);
            $user = $user1[0];
            $dht22 = $this->smarthomeService->getDhtTop1($topic);
            Mail::send('mail.sendDht22', ['dht22s' => $dht22,'user'=>$user], function ($m) use ($user) {
                        $m->from('phuchuynh1453@gmail.com', 'SMARTHOME');
                        $m->to($user->email, $user->name)->subject('Cảm ơn đã sử dụng dịch vụ từ SMART HOME!');
                    });
            $arr = [
                'success' => true,
                'message' => $dht22
            ];
            return response($arr,200);
        }

        if($result){
            $arr = [
                'success' => true,
                'message' => "Thanh cong"
            ];
            return response($arr,200);
        }else{
            $arr = [
                'success' => false,
                'message' => "That bai"
            ];
            return response($arr,200);
        }
    }

    public function getDht22(Request $request){

        $result = $this->smarthomeService->getDht($request->input('mobile'));
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
        ];
        return response($arr,200);
    }

    public function getDht22Top1(Request $request){

        $result = $this->smarthomeService->getDhtTop1($request->input('mobile'));
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
        ];
        return response($arr,200);
    }

    public function getWeatheDay(Request $request){

        $result = $this->smarthomeService->getWeather($request->input('mobile'));
        $arr = [
            'success' => true,
            'message' => "Thanh cong",
            'result'=>$result
        ];
        return response($arr,200);
    }

    public function LockKeyPad($topic, $password){
        $result = $this->smarthomeService->createKeypad($topic, $password);
        if($result){
            $mqtt = MQTT::connection();
            $mqtt->publish($topic,"khoa");
            $mqtt->disconnect();
        }else{

        }
    }

    public function UnLockKeyPad($topic, $password){
        $result = $this->smarthomeService->getKeypad($topic, $password);
        if($result){
            $mqtt = MQTT::connection();
            $mqtt->publish($topic,"dung");
            $mqtt->disconnect();
        }else{
            $mqtt = MQTT::connection();
            $mqtt->publish($topic,"sai");
            $mqtt->disconnect();
        }


    }

}
