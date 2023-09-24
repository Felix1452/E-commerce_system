<?php


namespace App\Http\Services\Cart;


use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;

class CartService
{
    public function confirm($customer){
        $i = (int)$customer->status;
        $i +=1;
        try {
            $customer->status = $i;
            $customer->save();
            Session::flash('success','Đã xác nhận');
        }catch (Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return  true;
    }
    public function getWaitForConfirm(){
        return Customer::where('status',1)
            ->orderByDesc('id')->paginate(15);
    }

    public function getPhone($request){
        return Customer::select('id','phone','address')
            ->where('email',$request->input('email'))
            ->orderByDesc('id')
            ->first();
    }

    public function updateCart($request){
        $qty = (int) $request->input('num_product['.product->id.']');
    }

    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (!$carts) return [];

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb','quantity')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request->input('num_product'));
        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

    public function addCartPaypal($request){
        try {
            DB::beginTransaction();
            $carts = Session::get('carts');
            if (is_null($carts))
                return false;

            if (session()->has("email")){
                $customer = Customer::create([
                    'name' => Session::get('nameP'),
                    'phone' => Session::get('phoneP'),
                    'address' => Session::get('addressP'),
                    'email' => Session::get('emailP'),
                    'content' => Session::get('contentP'),
                    'user_email'=>session()->get("emailP"),
                    'payment' => 'Paypal',
                    'pay_stt' => 'paid'
                ]);
            }else{
                $customer = Customer::create([
                    'name' => Session::get('nameP'),
                    'phone' => Session::get('phoneP'),
                    'address' => Session::get('addressP'),
                    'email' => Session::get('emailP'),
                    'content' => Session::get('contentP'),
                ]);
            }
            $this->infoProductCart($carts, $customer->id);

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            #Queue
            $carts = $customer->carts()->with('product')->get();
            // dd($carts);
//            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));
            Mail::send('mail.success', ['customer' => $customer, 'carts' => $carts], function ($m) use ($customer) {
                $m->from('phuchuynh1453@gmail.com', 'HPSTORE');
                $m->to($customer->email, $customer->name)->subject('Cảm ơn đã mua hàng từ HPStore!');
            });

            Session::forget('carts');
        }catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
    public function addCart($request)
    {
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');

            if (is_null($carts))
                return false;

            if (session()->has("email")){
                $customer = Customer::create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'email' => $request->input('email'),
                    'content' => $request->input('content'),
                    'user_email'=>session()->get("email")
                ]);
            }else{
                $customer = Customer::create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'email' => $request->input('email'),
                    'content' => $request->input('content')
                ]);
            }
            $this->infoProductCart($carts, $customer->id);
            DB::commit();

            Session::flash('success', 'Đặt Hàng Thành Công');
            #Queue
            $carts = $customer->carts()->with('product')->get();
            // dd($customer);
//            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));
            Mail::send('mail.success', ['customer' => $customer, 'carts' => $carts], function ($m) use ($customer) {
                $m->from('phuchuynh1453@gmail.com', 'HPSTORE');
                $m->to($customer->email, $customer->name)->subject('Cảm ơn đã mua hàng từ HPStore!');
            });

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    protected function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'pty'   => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price
            ];
            DB::update('update products set quantity = quantity -'.$carts[$product->id].' where id = '.$product->id);
        }

        return Cart::insert($data);
    }

    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(15);
    }
    public function getCustomerHistory()
    {
        return Customer::where('email',session('email'))
            ->where('active',1)
            ->whereBetween('created_at', [Carbon::now()->subDays(60), Carbon::now()])
            ->orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }

    public function getTunoverMonthyNow(){
        $mon = Carbon::now()->month;
        $year = Carbon::now()->year;
         //DB::select('SELECT SUM(carts.price) FROM carts INNER JOIN customers on customers.id = carts.customer_id WHERE MONTH(customers.created_at) = MONTH(NOW())');
        return DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->where('customers.status',3)
            ->whereMonth('customers.created_at',$mon)
            ->whereYear('customers.created_at','=',$year)
            ->selectRaw('SUM(price * pty) as total' )
            ->pluck('total');
    }

    public function getTunoverMonthy($num){
        $b = Carbon::now()->year;
        return DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->where('customers.status',3)
            ->whereMonth('customers.created_at','=',$num)
            ->whereYear('customers.created_at','=',$b)
            ->selectRaw('SUM(price * pty) as total' )
            ->pluck('total');
    }

//    public function getTunoverMonthy1(){
//
//    }
//    public function getTunoverMonthy2(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',2)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy3(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',3)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy4(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',4)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy5(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',5)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy6(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',6)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy7(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',7)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy8(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',8)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy9(){
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',9)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy10(){
//        //DB::select('SELECT SUM(carts.price) FROM carts INNER JOIN customers on customers.id = carts.customer_id WHERE MONTH(customers.created_at) = MONTH(NOW())');
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',10)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy11(){
//        $b = Carbon::now()->year;
//        //DB::select('SELECT SUM(carts.price) FROM carts INNER JOIN customers on customers.id = carts.customer_id WHERE MONTH(customers.created_at) = MONTH(NOW())');
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',11)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
//    public function getTunoverMonthy12(){
//        //DB::select('SELECT SUM(carts.price) FROM carts INNER JOIN customers on customers.id = carts.customer_id WHERE MONTH(customers.created_at) = MONTH(NOW())');
//        $b = Carbon::now()->year;
//        return DB::table('carts')
//            ->join('customers', 'carts.customer_id', '=', 'customers.id')
//            ->where('customers.status',3)
//            ->whereMonth('customers.created_at','=',12)
//            ->whereYear('customers.created_at','=',$b)
//            ->selectRaw('SUM(price * pty) as total' )
//            ->pluck('total');
//    }
    public function task(){
        $b = Carbon::now()->month;
        $b = $b - 1;
        return DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->where('customers.status',3)
            ->whereMonth('customers.created_at','=',$b)
            ->selectRaw('SUM(price * pty) as total')
            ->pluck('total');
    }
    public function customer(){
        $b = getdate()['mon'];
        return DB::table('customers')
            ->select('email')
            ->where('customers.status',3)
            ->whereMonth('customers.created_at','=',$b)
            ->distinct()
            ->count();
    }
    public function getQuaterlyNow(){
        $a = Carbon::now()->month;
        if($a <= 3){
            return $quy =1;
        }else if($a <= 6){
            return $quy =2;
        }else if($a <= 9){
            return  $quy =3;
        }else{
            return $quy =4;
        }
    }
    public function getTunoverQuarterlyNow($quy){
        $b = Carbon::now()->year;
        if ($quy == 1){
            $t1 = 1;
            $t2 = 2;
            $t3 = 3;
        }else if($quy == 2){
            $t1 = 4;
            $t2 = 5;
            $t3 = 6;
        }else if($quy == 3){
            $t1 = 7;
            $t2 = 8;
            $t3 = 9;
        }else{
            $t1 = 10;
            $t2 = 11;
            $t3 = 12;
        }
        $thangdau = DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->whereMonth('customers.created_at',$t1)
            ->where('customers.status',3)
            ->whereYear('customers.created_at','=',$b)
            ->selectRaw('SUM(price * pty) as total' )
            ->pluck('total');

        $thanggiua = DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->whereMonth('customers.created_at',$t2)
            ->where('customers.status',3)
            ->whereYear('customers.created_at','=',$b)
            ->selectRaw('SUM(price * pty) as total' )
            ->pluck('total');

        $thangcuoi = DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->whereMonth('customers.created_at',$t3)
            ->where('customers.status',3)
            ->whereYear('customers.created_at','=',$b)
            ->selectRaw('SUM(price * pty) as total' )
            ->pluck('total');


        return ((int)$thangdau[0] + (int)$thanggiua[0] + (int)$thangcuoi[0]);
    }
    public function updateAdmin($customer, $request){
        try {
            $customer->name = (string)$request->input('name');
            $customer->phone = (string)$request->input('phone');
            $customer->email = (string)$request->input('email');
            $customer->address = (string)$request->input('address');
            $customer->content = (string)$request->input('content');
            $customer->status = (string)$request->input('status');
            if ($request->input('status') == 4 || $request->input('status') == 5){
                $ptys = Cart::select('pty')
                    ->where('customer_id',$customer->id)
                    ->get();
                $id = Cart::select('product_id')
                    ->where('customer_id',$customer->id)
                    ->get();
                $i = 0;
                while ( $i < (sizeof($ptys))  ){
                    if ($i < sizeof($ptys)){
                        DB::update('update products set quantity = quantity +'.$ptys[$i]['pty'].' where id = '.$id[$i]['product_id']);
                        $i++;
                    }
                }
            }
                $customer->save();
            Session::flash('success','Cập nhật thành công !');

        }catch (Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return  true;

    }
    public function deleteHistory($customer){
        try {
            $ptys = Cart::select('pty')
                ->where('customer_id',$customer->id)
                ->get();
            $id = Cart::select('product_id')
                ->where('customer_id',$customer->id)
                ->get();
            $i = 0;
            while ( $i < (sizeof($ptys))  ){
                if ($i < sizeof($ptys)){
                    DB::update('update products set quantity = quantity +'.$ptys[$i]['pty'].' where id = '.$id[$i]['product_id']);
                    $i++;
                }
            }
            $customer->delete();
            Session::flash('success','Bạn đã hủy bỏ đơn hàng thành công !');
        }catch (Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return  true;
    }

    public function shipped($customer){
        try {
            $customer->status = 3;
            $customer->pay_stt = (string) "paid";
            $customer->save();
            Session::flash('success','Cảm ơn bạn đã mua hàng !');
        }catch (Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return  true;
    }

    public function getTunoverYear2(){
        $b = Carbon::now()->year;
        $b = $b - 2;
        return DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->where('customers.status',3)
            ->whereYear('customers.created_at',$b)
            ->selectRaw('SUM(price * pty) as total')
            ->pluck('total');
    }
    public function getTunoverYear1(){
        $b = Carbon::now()->year;
        $b = $b - 1;
        return DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->where('customers.status',3)
            ->whereYear('customers.created_at',$b)
            ->selectRaw('SUM(price * pty) as total')
            ->pluck('total');
    }
    public function getTunoverYearNow(){
        $b = Carbon::now()->year;
        return DB::table('carts')
            ->join('customers', 'carts.customer_id', '=', 'customers.id')
            ->where('customers.status',3)
            ->whereYear('customers.created_at',$b)
            ->selectRaw('SUM(price * pty) as total')
            ->pluck('total');
    }
}
