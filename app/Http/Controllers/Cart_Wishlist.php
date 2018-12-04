<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class Cart_Wishlist extends ParentController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart(Request $request){
        Cookie::queue(  Cookie::forget('PP') );
        if(!Auth::id()){
            if(cookie::get('GI')){
                
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $request->ip()]
                ]);
                if($insert_token){
                    Cookie::queue(Cookie::make('GI', $random_token, 10080));
                }
            }
        }else{
            Cookie::queue(  Cookie::forget('GI') );
        }
        parent::navFunction();

        $latest_items = DB::table('product_core as pc')
            ->selectRaw('id, product_name, product_thumbnail, product_discount,
                (Select id from product_variants where product_id = pc.id)  as product_id,
                (Select AVG(quality) from ratting where product_id = (Select id from product_variants where product_id = pc.id)) as average_rating,
                (SELECT count(*) from product_variants where product_id = pc.id) as total_variants,
                (Case when (SELECT count(*) from product_variants where product_id = pc.id) = 1 then (Select product_sale_price from product_variants where product_id = pc.id) Else NULL 
                        End) as price')
            ->limit(4)
            ->orderBy('id', 'desc')
            ->get();
        // echo "<pre>"; print_r($this->get_cart_items_detail); die;

        return view ('cart_and_wishlist/cart', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            'nav_links' => $this->navigationData, 'latest_products' => $latest_items]);
    }

    public function wishlist(Request $request){
        Cookie::queue(  Cookie::forget('PP') );
        if(!Auth::id()){
            $get_wishlist_items = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, 
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_brand from product_core where id = pv.product_id) as brand,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_discount from product_core where id = pv.product_id) as discount')
            ->whereRaw('id IN (Select product_id from wishlist where customer_id = (Select id from guest_info where session = "'.cookie::get('GI').'"))')
            ->get(); 
            if(cookie::get('GI')){
                
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $request->ip()]
                ]);
                if($insert_token){
                    Cookie::queue(Cookie::make('GI', $random_token, 10080));
                }
            }
        }else{
            Cookie::queue(  Cookie::forget('GI') );
            $get_wishlist_items = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, 
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_brand from product_core where id = pv.product_id) as brand,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_discount from product_core where id = pv.product_id) as discount')
            ->whereRaw('id IN (Select product_id from wishlist where customer_id = '.Auth::id().')')
            ->get(); 
        }
        parent::navFunction();
        
        //echo "<pre>"; print_r($get_wishlist_items); die;

        return view ('cart_and_wishlist/wishlist', ['cart_detail' => $this->get_cart_items_detail, 'nav_links' => $this->navigationData,
                    'wishlist_data' => $get_wishlist_items, 'all_product_cats' => $this->get_all_productCats]);
               
    }

    public function checkout(Request $request){ 
        if(!cookie::get('PP')){
            return redirect('/cart');
        }

        if(!Auth::id()){
            $user_data = DB::table('guest_info')
            ->select('first_name', 'last_name', 'phone', 'city', 'country', 'address', 'secondary_address')
            ->whereRaw(' session = "'.cookie::get('GI').'" ')
            ->first();
            if(cookie::get('GI')){
                
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $request->ip()]
                ]);
                if($insert_token){
                    Cookie::queue(Cookie::make('GI', $random_token, 10080));
                }
            }
        }else{
            Cookie::queue(  Cookie::forget('GI') );
            $user_data = DB::table('users')
            ->select('first_name', 'last_name', 'phone', 'city', 'country', 'address', 'secondary_address')
            ->whereRaw('id = '.Auth::id())
            ->first();

            //$select_order
        }
        parent::navFunction();

        return view ('cart_and_wishlist/checkout', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData, 'user_data' => $user_data]);
          
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
