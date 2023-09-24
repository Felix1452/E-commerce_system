<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ReviewApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\SalaryApiController;
use App\Http\Controllers\Api\SmartHome;
use App\Http\Controllers\Api\AquariumApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post("/dangnhap",[UserApiController::class,"store"]);
Route::post("/dangki",[UserApiController::class,"dangki"]);
Route::post("/update-token",[UserApiController::class,"updateToken"]);
Route::post("/them-binh-luan",[ReviewApiController::class,"store"]);
Route::post("/binh-luan",[ReviewApiController::class,"index"]);
Route::post("/create-oder",[OrderApiController::class,"index"]);
Route::post("/showall-order",[OrderApiController::class,"showAll"]);
Route::post("/get-order",[OrderApiController::class,"getOder"]);
Route::post("/get-token",[OrderApiController::class,"getToken"]);
Route::post("/gettoken-admin",[UserApiController::class,"getTokenAdmin"]);
Route::post("/update-order",[OrderApiController::class,"updateOrder"]);
Route::get("/slidebar",[ProductApiController::class,"slidebar"]);
Route::get("/new-product",[ProductApiController::class,"getProductNew"]);
Route::post("/loai-san-pham",[ProductApiController::class,"kindProduct"]);

//User
Route::get("/get-user",[UserApiController::class,"getUser"]);
Route::get("/get-user-staff",[UserApiController::class,"getUserStaff"]);
Route::get("/get-user-intern",[UserApiController::class,"getUserIntern"]);
Route::post("/insert-user",[UserApiController::class,"insertUser"]);
Route::post("/update-user",[UserApiController::class,"updateUser"]);
Route::post("delete-user", [UserApiController::class,"destroyUser"]);
Route::post("/update-intern",[UserApiController::class,"updateIntern"]);


//Salary
Route::get("/get-salary",[SalaryApiController::class,"getSalary"]);
Route::post("/insert-salary",[SalaryApiController::class,"insertSalary"]);
Route::post("/update-salary",[SalaryApiController::class,"updateSalary"]);

//Smart_home
Route::post("/turn-on-off-camera",[SmartHome::class,"ChangeCamera"]);
Route::post("/turn-on-off-motor",[SmartHome::class,"ChangeMotor"]);
Route::post("/auto-turn-on-off-motor",[SmartHome::class,"ChangeAutoMotor"]);
Route::get("/nhietdo_doam/{topic}/{nd}/{da}",[SmartHome::class,"insertDht22"]);
Route::post("/get-dht22",[SmartHome::class,"getDht22"]);
Route::post("/get-dht22-top1",[SmartHome::class,"getDht22Top1"]);
Route::post("/get-dht22-weatherDay",[SmartHome::class,"getWeatheDay"]);


//----------------------------------------------------Aquarium-----------------------------------------
Route::get("/be_ca/{topic}/{nd}/{da}/{ndn}/{tds}/{ntu}/{distance}/{ph}",[AquariumApiController::class,"insertDHT11AquariumIOT"]);
Route::post("/get-aquarium",[AquariumApiController::class,"getAquarium"]);
Route::post("/get-aquarium-top1",[AquariumApiController::class,"getAquariumTop1"]);
Route::post("/get-dht11-weatherDay",[AquariumApiController::class,"getWeatheDay"]);

//Keypad
Route::get("/keypad/{topic}/{password}",[SmartHome::class,"LockKeyPad"]);
Route::get("/Unkeypad/{topic}/{password}",[SmartHome::class,"UnLockKeyPad"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

});
//Route::get("/dangnhap",[UserApiController::class,"store"]);


