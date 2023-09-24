<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request, $id, $slug){
        $menuAll = $this->menuService->getAllMenus($id);
        $menu_parent = $this->menuService->getIdParent($id);
        $menu_child = $this->menuService->getIdChild($id);
        $product = $this->menuService->getProduct2($menuAll, $request);

        return view('menu', [
            'title' => $menu_parent->name,
            'products' => $product,
            'menu'=>$menu_parent,
            'menus_child' =>$menu_child
        ]);
    }

    public function sendEmailReminder(Request $request, $id)
    {
        $menu = $this->menuService->getIdParent($id);
        $product = $this->menuService->getProduct($menu, $request);
        Mail::send('mail.newProduct', ['menu' => $menu], function ($m) use ($menu) {
            $m->from('lethanhuy1005@gmail.com', 'Your Application');

            $m->to('lethanhuy1005@gmail.com', $menu->name)->subject('Your Reminder!');
        });

        return view('menu', [
            'title' => $menu->name,
            'products' => $product,
            'menu'=>$menu

        ]);
    }

    public function filterPrice(Request $request, $id, $price){

        $menu = $this->menuService->getAllMenus($id);
        $menu_parent = $this->menuService->getIdParent($id);
        $menu_child = $this->menuService->getIdChild($id);
        $product = $this->menuService->getProductFilter($menu, $request, $price);

        return view('menu', [
            'title' => $menu_parent->name,
            'products' => $product,
            'menu'=>$menu_parent,
            'menus_child' =>$menu_child
        ]);
    }

}
