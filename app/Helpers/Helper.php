<?php


namespace App\Helpers;


use App\Models\Menu;
use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id=0, $char=''){
        $html='';
        foreach ($menus as $key => $menu){
            if ($menu->parent_id == $parent_id){

                $html .='
                    <tr>
                        <td>' . $menu->id  .'</td>
                        <td>' . $char . $menu->name  .'</td>
                        <td>' . self::active($menu->active)  .'</td>
                        <td>' . $menu->parent_id  .'</td>
                        <td>' . $menu->updated_at  .'</td>
                        <td>
                            <a style="margin-right: 5px" class="button btn-outline-warning btn-sm" href="/admin/menus/edit/'. $menu->id .'">
                                <i class="fa fa-edit"></i> <i>Edit</i>
                            </a>
                            <a class="button btn-outline-danger btn-sm" href="#"
                            onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                                <i class="fa fa-trash"></i> <i>Delete</i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menu[$key]);
                $html.= self::menu($menus, $menu->id, $char .'_ ');
            }
        }
        return $html;
    }

    public static function active($active){
        if ($active==1){
            return '<span class="btn btn-light btn-xs">YES</span>';
        }
        else{
            return '<span class="btn btn-dark btn-xs">NO</span>';
        }
    }

    public static function menus($menus, $parent_id=0){
        $html ='';
        foreach ($menus as $key =>$menu){
            if ($menu->parent_id==$parent_id){
                $html .='
                    <li>
                        <a href="/danh-muc/' . $menu->id . '-'. Str::slug($menu->name, '-') .'.html">
                            '. $menu->name .'
                        </a>';
                if(self::isChild($menus, $menu->id)){
                    $html.= '<ul class="sub-menu">';
                    $html.= self::menus($menus, $menu->id);
                    $html.= '</ul>';
                }
                $html.='   </li>
                ';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id){
        foreach ($menus as $menu){
            if($menu->parent_id==$id){
                return true;
            }
        }
        return false;
    }

    public static function isDeleted($id){
        if ($menu = Menu::where('id',$id)->first()){
            return $menu->name;
        }
        else{
            return '';
        }
    }
    public static function isSale($price =0, $price_sale =0){
        if($price_sale!=0){
            $sale = 1 - ($price_sale/$price);
            return  '<p style="text-decoration: line-through; font-size: small">'.number_format($price). ' VND'.'</p><p style="color:red">'.number_format($price_sale).' VND <small style="color: #eb5757;
    background: #fff0e9;
    border-radius: 4px;
    padding: 1px 2px 2px 2px;
    margin-left: 7px;
    font-size: 14px;"> -'.number_format($sale*100).'%</small></p>';
        }
        if($price!=0){
            return number_format($price).' VND';
        }
        return '<p>NGỪNG KINH DOANH</p><a href="/contact.html">Liên Hệ</a>';
    }

    public static function OutQuantiy($price =0, $price_sale =0){
        if($price_sale!=0){
            $sale = 1 - ($price_sale/$price);
            return  '<p style="text-decoration: line-through; font-size: small">'.number_format($price_sale). ' VND'.'</p>';
        }
        if($price!=0){
            return '<p style="text-decoration: line-through; font-size: small">'.number_format($price). ' VND'.'</p>';
        }
        return '<a href="/contact.html">Liên Hệ</a>';
    }

    public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) return number_format($priceSale);
        if ($price != 0)  return number_format($price);
        return '<a href="/lien-he.html">Liên Hệ</a>';
    }
}
