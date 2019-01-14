<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cookie;

class ParentController extends Controller
{

    public $get_all_productCats;
    public $get_cart_items_detail;
    public $user_name;
    public $get_cart_items;
    public $navigationData;

    public function __construct(){
    }

    public function navFunction(){

        //echo $_SERVER['REMOTE_ADDR']; die;
      
        if(!Auth::id()){


            if(isset($_COOKIE['GI'])){ 
                $queryParam = '(SELECT product_id from cart where customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") and is_active = 1)';

                $this->get_cart_items_detail = DB::table('product_variants AS pc')->selectRaw('id, product_sale_price, product_quantity,
                    (Select product_thumbnail from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_thumbnail,
                    (Select id from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_core_id,
                    (Select product_discount from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_discount,
                    (Select product_name from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_name,
                    (Select quantity from cart where product_id = pc.id and is_active = 1 and customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")) as quantity,
                    (Select id from cart where product_id = pc.id and is_active = 1 and customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")) as cart_id
                    ')->whereRaw('id IN (SELECT product_id from cart where customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") and is_active = 1)')->get();

                $this->get_all_productCats = DB::table('product_categories')
                ->select('category_name', 'id')
                ->get(); 
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $_SERVER['REMOTE_ADDR']]
                ]);
                if($insert_token){
                    setcookie('GI', $random_token, time() + (86400 * 30), "/");
                    $queryParam = '(SELECT product_id from cart where customer_id = (Select id from guest_info where session = "'.$random_token.'") and is_active = 1)';

            $this->get_cart_items_detail = DB::table('product_variants AS pc')->selectRaw('id, product_sale_price, product_quantity,
                (Select product_thumbnail from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_thumbnail,
                (Select id from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_core_id,
                (Select product_discount from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_discount,
                (Select product_name from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_name,
                (Select quantity from cart where product_id = pc.id and is_active = 1 and customer_id = (Select id from guest_info where session = "'.$random_token.'")) as quantity,
                (Select id from cart where product_id = pc.id and is_active = 1 and customer_id = (Select id from guest_info where session = "'.$random_token.'")) as cart_id
                ')->whereRaw('id IN (SELECT product_id from cart where customer_id = (Select id from guest_info where session = "'.$random_token.'") and is_active = 1)')->get();

            $this->get_all_productCats = DB::table('product_categories')
            ->select('category_name', 'id')
            ->get(); 
                    //return redirect('/login');
                   // die;
                }
            }

            // $queryParam = '(SELECT product_id from cart where customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") and is_active = 1)';

            // $this->get_cart_items_detail = DB::table('product_variants AS pc')->selectRaw('id, product_sale_price, product_quantity,
            //     (Select product_thumbnail from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_thumbnail,
            //     (Select id from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_core_id,
            //     (Select product_discount from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_discount,
            //     (Select product_name from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_name,
            //     (Select quantity from cart where product_id = pc.id and is_active = 1 and customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")) as quantity,
            //     (Select id from cart where product_id = pc.id and is_active = 1 and customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")) as cart_id
            //     ')->whereRaw('id IN (SELECT product_id from cart where customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") and is_active = 1)')->get();

            // $this->get_all_productCats = DB::table('product_categories')
            // ->select('category_name', 'id')
            // ->get(); 

        }else{
        
        $queryParam = '(SELECT product_id from cart where customer_id = '.Auth::id().' and is_active = 1)';

        $this->get_cart_items_detail = DB::table('product_variants AS pc')->selectRaw('id, product_sale_price, product_quantity,
            (Select product_thumbnail from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_thumbnail,
            (Select id from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_core_id,
            (Select product_discount from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_discount,
            (Select product_name from product_core where id = (Select product_id from product_variants where id = pc.id)) as product_name,
            (Select quantity from cart where product_id = pc.id and is_active = 1 and customer_id = '.Auth::id().') as quantity,
            (Select id from cart where product_id = pc.id and is_active = 1 and customer_id = '.Auth::id().') as cart_id
            ')->whereRaw('id IN (SELECT product_id from cart where customer_id = '.Auth::id().' and is_active = 1)')->get();

        $this->get_all_productCats = DB::table('product_categories')
        ->select('category_name', 'id')
        ->get(); 
        }

        $this->navigationData = array();

        $mainCategories = DB::table('main_categories')->get();

        $subCategories = DB::table('sub_categories')->get();

        $productCategories = DB::table('product_categories')->get();
        
        $mainCounter = 0;

        foreach($mainCategories as $main){
            $this->navigationData[$mainCounter] = array('id' => $main->id, 'name' => $main->category_name, 'image' => $main->category_image);
            $subData = array();
            $subCounter = 0;
            foreach($subCategories as $sub){
                if($sub->main_category_id == $main->id){
                    $subData[$subCounter] = array('id' => $sub->id, 'name' => $sub->category_name);
                    $prodData = array();
                    $prodCounter = 0;
                    foreach($productCategories as $prod){
                        if($prod->sub_category_id == $sub->id){
                            $prodData[$prodCounter] = array('id' => $prod->id, 'name' => $prod->category_name);
                            $prodCounter++;
                        }
                    }
                    $subData[$subCounter]["product_categories"] = $prodData;
                    $prodCounter = 0;
                    $subCounter++;
                }
            }
            $this->navigationData[$mainCounter]["sub_category"] = $subData;
            $subCounter = 0;
            $mainCounter++;
        }
        //echo "<pre>"; print_r($this->navigationData); die;

    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }

}
