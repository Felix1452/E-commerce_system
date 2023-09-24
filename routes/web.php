<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\salarys;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\MainController as HomeController;
use App\Http\Controllers\MenuController as MenuControlController;
use App\Http\Controllers\ProductController as ProductControlController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CartController as AdminCart;
use App\Http\Middleware\CheckLoginPerrmission;
use App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\ProductImgController;
use App\Http\Middleware\CheckLoginPerrmissionAdmin;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\IOTController;

Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login');
Route::get('/admin/users/register', [RegisterController::class, 'index'])->name('register');

Route::post('admin/users/login/store', [LoginController::class, 'store']);
Route::post('admin/users/register/store', [RegisterController::class, 'store']);
Route::get('/dang-xuat',[LoginController::class,'dangxuat'])->name('dangxuat');

Route::middleware(['auth'])->group(function(){
    Route::middleware(checkLoginPerrmission::class)->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/', [MainController::class, 'index'])->name('admin');

            #salary
            Route::prefix('salarys')->group(function () {
                Route::get('add', [SalaryController::class, 'create'])->name('salary_add');
                Route::post('add', [SalaryController::class, 'store']);
                Route::get('list', [SalaryController::class, 'index'])->name('salary');
                Route::get('check/{user}', [SalaryController::class, 'check'])->name('salary_detail');
                Route::get('edit/{salarys}', [SalaryController::class, 'show']);
                Route::post('edit/{salarys}', [SalaryController::class, 'update']);
            });

            #profile
            Route::prefix('profile')->group(function () {
                Route::get('list', [ProfileController::class, 'index'])->name('profile');
                Route::get('edit/{menu}', [ProfileController::class, 'show']);
                Route::post('edit/{menu}', [ProfileController::class, 'update']);
                Route::DELETE('destroy', [ProfileController::class, 'destroy']);
            });

            #staff
            Route::prefix('staffs')->group(function () {
                Route::get('list', [StaffController::class, 'index'])->name('staff');
                Route::get('listIntern', [StaffController::class, 'intern'])->name('listIntern');
                Route::get('edit/{menu}', [StaffController::class, 'show']);
                Route::post('edit/{menu}', [StaffController::class, 'update']);
                Route::DELETE('destroy', [StaffController::class, 'destroy']);
            });

            #menu
            Route::prefix('menus')->group(function () {
                Route::get('add', [MenuController::class, 'create']);
                Route::post('add', [MenuController::class, 'store']);
                Route::get('list', [MenuController::class, 'index']);
                Route::get('edit/{menu}', [MenuController::class, 'show']);
                Route::post('edit/{menu}', [MenuController::class, 'update']);
                Route::DELETE('destroy', [MenuController::class, 'destroy']);
            });

            #product
            Route::prefix('products')->group(function () {
                Route::get('add', [ProductController::class, 'create']);
                Route::post('add', [ProductController::class, 'store']);
                Route::get('list', [ProductController::class, 'index']);
                Route::get('edit/{product}', [ProductController::class, 'show']);
                Route::post('edit/{product}', [ProductController::class, 'update']);
                Route::DELETE('destroy', [ProductController::class, 'destroy']);


                Route::get('addimg/{product}', [ProductImgController::class, 'createImg']);
                Route::post('addimg/{product}', [ProductImgController::class, 'storeImg']);
                Route::get('imglist', [ProductImgController::class, 'imgList']);
                Route::DELETE('destroyImg', [ProductImgController::class, 'destroyImg']);
            });

            #upload
            Route::post('upload/services', [UploadController::class, 'store']);

            #slider
            Route::prefix('sliders')->group(function () {
                Route::get('add', [SliderController::class, 'create']);
                Route::post('add', [SliderController::class, 'store']);
                Route::get('list', [SliderController::class, 'index']);
                Route::get('edit/{slider}', [SliderController::class, 'show']);
                Route::post('edit/{slider}', [SliderController::class, 'update']);
                Route::DELETE('destroy', [SliderController::class, 'destroy']);
            });

            #cart
            Route::prefix('customers')->group(function () {
                Route::get('list', [AdminCart::class, 'index']);
                Route::get('check/{customer}', [AdminCart::class, 'show']);
                Route::get('edit/{customer}', [AdminCart::class, 'edit'])->name('admin.customers.edit');
                Route::post('edit/{customer}', [AdminCart::class, 'update']);
                Route::get('waitForConfirm', [AdminCart::class, 'waitForConfirm']);
                Route::get('confirm/{customer}', [AdminCart::class, 'confirm']);
            });

            #user
            Route::middleware(CheckLoginPerrmissionAdmin::class)->group(function (){
                Route::prefix('users')->group(function () {
                    Route::get('/add', [UserController::class, 'create'])->name('admin.users.add');
                    Route::post('/add',[UserController::class,'store']);
                    Route::get('/list', [UserController::class, 'index'])->name('admin.users.list');
                    Route::get('/edit/{user}', [UserController::class, 'show']);
                    Route::post('/edit/{user}', [UserController::class, 'update']);
                    Route::get('/editIntern/{user}/{active}', [UserController::class, 'updateIntern']);
                    Route::DELETE('/destroy', [UserController::class, 'destroy']);
                    Route::get('/forgot/{user}', [UserController::class, 'forgotpass'])->name('admin.users.forgotpasss');
                    Route::post('/forgot/{user}', [UserController::class, 'updatePass']);
                });
            });

            #IOT
            Route::prefix('iots')->group(function () {
                Route::get('statistics', [IOTController::class, 'index'])->name("admin.iots.statistics");
                Route::get('changelights', [IOTController::class, 'changeLight'])->name("admin.iots.changeLight");
            });

        });
    });
});

Route::get('/', [HomeController::class, 'index'])->name('client');
Route::get('/search/', [HomeController::class, 'search'])->name('search');
Route::get('/timkiem.html', [HomeController::class, 'viewSearch']);
Route::post('/services/load-products', [HomeController::class, 'loadProduct']);
Route::get('danh-muc/{id}-{slug}.html',[MenuControlController::class, 'index']);

#test mail
//Route::get('send/{id}.html',[MenuControlController::class, 'sendEmailReminder']);
Route::get('san-pham/{id}-{slug}.html',[ProductControlController::class, 'index']);

Route::post('/review/{id}',[ProductControlController::class, 'comment']);

Route::get('danh-muc/{id}/filter={price}',[MenuControlController::class, 'filterPrice']);

Route::get('/about.html', [HomeController::class, 'about']);
Route::get('/contact.html', [HomeController::class, 'contact']);
// Route::post('/contact.html', [HomeController::class, 'sendMess']);

Route::post('buy-after', [\App\Http\Controllers\CustomersAfterController::class, 'send']);
Route::post('add-cart', [CartController::class, 'index']);
Route::post('update-cart-client', [CartController::class, 'update-cart']);
Route::get('carts', [CartController::class, 'show'])->name('cart');

Route::get('carts/create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('carts/process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('carts/success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('carts/cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

Route::post('update-cart', [CartController::class, 'update']);
Route::get('carts/delete/{id}', [CartController::class, 'remove']);
Route::post('carts', [CartController::class, 'addCart'])->name('buyCart');
Route::get('/history', [CartController::class, 'history'])->name('history');
Route::get('history/check/{customer}', [CartController::class, 'checkHistory'])->name('checkHistory');
Route::get('history/delete/{customer}', [CartController::class, 'deleteHistory'])->name('deleteHistory');
Route::get('history/shipped/{customer}', [CartController::class, 'shipped']);
Route::middleware(\App\Http\Middleware\checkLoginPerrmission::class)->group(function (){
    Route::get('/test',[HomeController::class,'test']);
});



