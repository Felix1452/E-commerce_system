<?php

namespace App\Http\Services\Aquarium;
use App\Models\Beca;
use Illuminate\Support\Facades\DB;

class AquariumService
{
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

    public function getAquarium($mobile){

        // $result = Dht22::where('topic',$mobile)->avg('temperature');
        $result =  DB::table('becas')
                ->where('topic',$mobile)->get();
        return $result;
    }

    public function getAquariumTop1($mobile){
        // $result = Beca::where('topic',$mobile)->avg('temperature');
        $result =  DB::table('becas')->where('topic',$mobile)->orderBy('id', 'desc')->first();
        return $result;
    }

    public function getAquariumAll($mobile){
        // $result = Beca::where('topic',$mobile)->avg('temperature');
        $result =  DB::table('becas')->where('topic',$mobile)->get();
        return $result;
    }

    public function getWeather($mobile){
        $morning1 = DB::select('select avg(nd) as nd from becas where topic ="'.$mobile.'" and Year(thoigian) = Year(Now()) AND Month(thoigian) = Month(Now()) and Day(thoigian) = Day(Now()) and hour(thoigian) >= 4 and hour(thoigian) < 11');
        $everning2 = DB::select('select avg(nd) as nd from becas where topic ="'.$mobile.'" and Year(thoigian) = Year(Now()) AND Month(thoigian) = Month(Now()) and Day(thoigian) = Day(Now()) and hour(thoigian) >=11  and hour(thoigian) < 13');
        $afternoon3 = DB::select('select avg(nd) as nd from becas where topic ="'.$mobile.'" and Year(thoigian) = Year(Now()) AND Month(thoigian) = Month(Now()) and Day(thoigian) = Day(Now()) and hour(thoigian) >=13  and hour(thoigian) < 18');
        $morning = $morning1[0];
        $everning = $everning2[0];
        $afternoon = $afternoon3[0];
        $whether = array($morning, $everning, $afternoon);
        return $whether;
    }


}
