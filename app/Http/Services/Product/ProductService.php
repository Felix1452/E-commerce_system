<?php


namespace App\Http\Services\Product;


use App\Jobs\SendMail;
use App\Models\Customers_after;
use App\Models\img_products;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Self_;

class ProductService
{

    public function getMenu(){
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request){
        if ($request->input('price')!=0 && $request->input('price_sale')!=0 && $request->input('price_sale')>=$request->input('price'))
        {
            Session::flash('error','Giá giảm phải nhỏ hơn giá gốc! ');
            return false;
        }
        if ($request->input('price')=='')
        {
            Session::flash('error','Vui lòng nhập giá gốc! ');
            return false;
        }
        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice===false)
            return false;

        try {
            $request->except('_token');

            Product::create([
                'name' =>(string)$request->input('name'),
                'menu_id' =>(string)$request->input('menu_id'),
                'description' =>(string)$request->input('description'),
                'systemConfig' =>(string)$request->input('systemConfig'),
                'content' =>(string)$request->input('content'),
                'price' =>$request->input('price'),
                'price_sale' =>$request->input('price_sale'),
                'active' =>(string)$request->input('active'),
                'thumb' =>(string)$request->input('thumb'),
                'quantity' =>(integer)$request->input('quantity')
            ]);

            Session::flash('success','Thêm sản phẩm thành công !');
        } catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;

    }

    public function get(){
        return Product::
            with('menu')
            ->orderByDesc('id')->paginate(10);
    }

    public function update($request, $product){
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice===false)
            return false;

        try{
//            $product->fill($request->input());
            $product->name = (string) $request->input('name');
            $product->menu_id = (string) $request->input('menu_id');
            $product->description = (string) $request->input('description');
            $product->systemConfig = (string) $request->input('systemConfig');
            $product->content = (string) $request->input('content');
            $product->price = $request->input('price');
            $product->price_sale = $request->input('price_sale');
            $product->active = (string) $request->input('active');
            $product->thumb = (string) $request->input('thumb');
            $product->quantity = (integer) $request->input('quantity');
            $product->save();
            Session::flash('success','Cập nhật thành công !');

            if ($request->input('quantity') > 0){
                $buyers = Customers_after::where('product_id', $product->id)->get();
                foreach ($buyers as $buyer){
                    Mail::send('mail.newProduct', ['buyer' => $buyer, 'product' => $product], function ($m) use ($buyer) {
                        $m->from('lethanhuy1005@gmail.com', 'HPSTORE');
                        $m->to($buyer->email, $buyer->name)->subject('Sản phẩm bạn đăng ký hiện đã có tại cửa hàng!');
                        $buyer->delete();
                    });
                }

            }
        }
        catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request){
        $id = (int)$request->input('id');
        $product = Product::where('id', $id)->first();
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

    //Product Main
    const LIMIT = 8;

    public function getmain($page = null)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb','active','quantity', 'created_at', 'systemConfig')
            ->where('active',1)
            ->where('price','>',0)
            ->orderByDesc('created_at')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id){
        return Product::where('id', $id)
            ->where('active', 1)
            ->with('menu')
            ->firstOrFail();
    }

    public function more($product){
        $menu_id = Menu::select('id','parent_id')->where('id',$product->menu_id)->firstOrFail();
        if ($menu_id->parent_id==0){
            $menu = Menu::where('parent_id', $menu_id->id)
                ->where('active',1)
                ->orWhere('id',$menu_id->id)
                ->where('active',1)
                ->pluck('id')->toArray();
        }else
        {
            $menu = Menu::where('parent_id', $menu_id->parent_id)
                ->where('active',1)
                ->orWhere('id',$menu_id->parent_id)
                ->where('active',1)
                ->pluck('id')->toArray();
        }
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb','quantity', 'created_at', 'systemConfig')
            ->where('price','>',0)
            ->where('active', 1)
            ->where('id','!=', $product->id)
            ->whereIn('menu_id', $menu)
            ->orderByDesc('quantity')
            ->limit(4)
            ->get();
    }

    public function showImg($id)
    {
        return img_products::select('id','product_id','thumb1')
            ->where('product_id',$id)
            ->get();
    }

}
