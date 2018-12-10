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
       // Cookie::queue(  Cookie::forget('PP') );
       //proceed to checkout
       setcookie('PP', "", time() - (86400 * 30), "/");
        if(!Auth::id()){
            if(isset($_COOKIE['GI'])){ 
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $request->ip()]
                ]);
                if($insert_token){
                    setcookie('GI', $random_token, time() + (86400 * 30), "/");
                    //Cookie::queue(Cookie::make('GI', $random_token, 10080));
                }
            }
        }else{
            //Cookie::queue(  Cookie::forget('GI') );
            setcookie('GI', "", time() - (86400 * 30), "/");
        }
        parent::navFunction();

        // $latest_items = DB::table('product_core as pc')
        //     ->selectRaw('id, product_name, product_thumbnail, product_discount,
        //         (Select id from product_variants where product_id = pc.id)  as product_id,
        //         (Select AVG(quality) from ratting where product_id = (Select id from product_variants where product_id = pc.id)) as average_rating,
        //         (SELECT count(*) from product_variants where product_id = pc.id) as total_variants,
        //         (Case when (SELECT count(*) from product_variants where product_id = pc.id) = 1 then (Select product_sale_price from product_variants where product_id = pc.id) Else NULL 
        //                 End) as price')
        //     ->limit(4)
        //     ->orderBy('id', 'desc')
        //     ->get();

            $core = DB::table('product_core')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->limit(4)
            ->orderBy('id', 'desc')
            ->get();

            $variants = DB::table('product_variants as pv')
                ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                    (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                ->get();

            $products = array();
            $counter = 0;
            foreach($core as $core_pro){
                $products[$counter]["id"] = $core_pro->id;
                $products[$counter]["name"] = $core_pro->product_name;
                $products[$counter]["discount"] = $core_pro->product_discount;
                $products[$counter]["image"] = $core_pro->product_thumbnail;
                $v_products = array();
                foreach($variants as $variants_pro){
                    if($variants_pro->product_id == $core_pro->id){
                        $v_products[] = array(
                            "variant_id" => $variants_pro->id,
                            "price" => $variants_pro->product_sale_price,
                            "color" => $variants_pro->product_color,
                            "size" => $variants_pro->product_size,
                            "ratting" => $variants_pro->ratting
                        ); 
                    }
                }
                $products[$counter]["variants"] = $v_products;
                $counter ++;
            }
            //echo "<pre>"; print_r($products); die;
         //echo "<pre>"; print_r($this->get_cart_items_detail); die;

        return view ('cart_and_wishlist/cart', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            'nav_links' => $this->navigationData, 'latest_products' => $products]);
    }

    public function wishlist(Request $request){
       // Cookie::queue(  Cookie::forget('PP') );
       //proceed to checkout
       setcookie('PP', "", time() - (86400 * 30), "/");
        if(!Auth::id()){
            $get_wishlist_items = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, 
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_brand from product_core where id = pv.product_id) as brand,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_discount from product_core where id = pv.product_id) as discount')
            ->whereRaw('id IN (Select product_id from wishlist where customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'"))')
            ->get(); 
            if(isset($_COOKIE['GI'])){
                
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $request->ip()]
                ]);
                if($insert_token){
                    setcookie('GI', $random_token, time() + (86400 * 30), "/");
                    //Cookie::queue(Cookie::make('GI', $random_token, 10080));
                }
            }
        }else{
            //Cookie::queue(  Cookie::forget('GI') );
            setcookie('GI', "", time() - (86400 * 30), "/");
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
        if(!isset($_COOKIE['PP'])){
            return redirect('/cart');
        }

        if(!Auth::id()){
            $user_data = DB::table('guest_info')
            ->select('first_name', 'last_name', 'phone', 'city', 'country', 'address', 'secondary_address')
            ->whereRaw(' session = "'.$_COOKIE['GI'].'" ')
            ->first();
            if(isset($_COOKIE['GI'])){
                
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $request->ip()]
                ]);
                if($insert_token){
                    setcookie('GI', $random_token, time() + (86400 * 30), "/");
                    //Cookie::queue(Cookie::make('GI', $random_token, 10080));
                }
            }
        }else{
            setcookie('GI', "", time() - (86400 * 30), "/");
            //Cookie::queue(  Cookie::forget('GI') );
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
