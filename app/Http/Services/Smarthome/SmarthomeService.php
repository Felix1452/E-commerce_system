<?php

namespace App\Http\Services\Smarthome;
use App\Models\Dht22;
use App\Models\Beca;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Keypad;

class SmarthomeService
{
    public function create($topic, $temperature, $humidity){
        
        $result = Dht22::create([
            'topic'=>$topic,
            'temperature'=>(double)$temperature,
            'humidity'=>(double)$humidity,
        ]);
        return $result;
    }
    
    public function createAquarium($topic, $nd, $da, $ndn, $tds, $ntu, $distance, $ph){
        
        $result = Beca::create([
            'topic'=>$topic,
            'nd'=>(double)$nd,
            'da'=>(double)$da,
            'ndn'=>(double)$ndn,
            'tds'=>(double)$tds,
            'ntu'=>(double)$ntu,
            'khoangcach'=>(double)$distance,
            'ph'=>(double)$ph
        ]);
        return $result;
    }
    
    public function getDht($mobile){
        
        // $result = Dht22::where('topic',$mobile)->avg('temperature');
        $result =  DB::table('dht22s') 
                ->where('topic',$mobile)->get();
        return $result;
    }
    
    public function getDhtTop1($mobile){
        // $result = Dht22::where('topic',$mobile)->avg('temperature');
        $result =  DB::table('dht22s') 
                ->where('topic',$mobile)-> orderBy('id', 'desc')->first();
        return $result;
    }
    
    public function getUser($mobile){
        $carts = User::select()->where('mobile',$mobile)->get();
        return $carts;
    }
    
    public function getWeather($mobile){
        $morning1 = DB::select('select avg(temperature) as temperature from dht22s where topic ="'.$mobile.'" and Year(thoigian) = Year(Now()) AND Month(thoigian) = Month(Now()) and Day(thoigian) = Day(Now()) and hour(thoigian) >= 4 and hour(thoigian) < 11');
        $everning2 = DB::select('select avg(temperature) as temperature from dht22s where topic ="'.$mobile.'" and Year(thoigian) = Year(Now()) AND Month(thoigian) = Month(Now()) and Day(thoigian) = Day(Now()) and hour(thoigian) >=11  and hour(thoigian) < 13');
        $afternoon3 = DB::select('select avg(temperature) as temperature from dht22s where topic ="'.$mobile.'" and Year(thoigian) = Year(Now()) AND Month(thoigian) = Month(Now()) and Day(thoigian) = Day(Now()) and hour(thoigian) >=13  and hour(thoigian) < 18');
        $morning = $morning1[0];
        $everning = $everning2[0];
        $afternoon = $afternoon3[0];
        $whether = array($morning, $everning, $afternoon);
        return $whether;
    }
    
    public function createKeypad($topic, $password){
        
        $result = Keypad::create([
            'topic'=>$topic,
            'password'=>(string)$password
            ]);
        return $result;
    }
    
    public function getKeypad($topic, $password){
        
        $result =  DB::table('keypads') ->where('topic',$topic)-> orderBy('id', 'desc')->first();
        if($result->password == $password){
            $result1 = true;
        }else{
            $result1=false;
        }
        return $result1;
    }
    
    
    
}
