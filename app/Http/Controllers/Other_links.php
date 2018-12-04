<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ParentController;
use Auth;
use DB;
use Cookie;

class Other_links extends ParentController
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
    public function blog(){
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
        return view ('other_links/blog', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }

    public function blog_post(){
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
        return view ('other_links/blog_post', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }

    public function about_us(){
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
        return view ('other_links/about_us', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats, 
        'nav_links' => $this->navigationData]);
    }

    public function site_map(){
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
        return view ('other_links/site_map', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }

    public function contact_us(){
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
        return view ('other_links/contact_us', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }

    public function faq(){
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
        return view ('other_links/faq', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }

    public function orders(){
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
            $select_data = DB::table('order_contents AS oc')->selectRaw('SUM(total_price) as total_price, order_id,
                (Select created_at from orders where id = oc.order_id) as date,
                (Select first_name from guest_info where session = "'.cookie::get('GI').'") as first_name,
                (Select last_name from guest_info where session = "'.cookie::get('GI').'") as last_name')
            ->groupBy('order_id')
            ->whereRaw('order_id IN (SELECT id from orders where customer_id = (Select id from guest_info where session = "'.cookie::get('GI').'"))')
            ->get();
            // $select_data = DB::table('order_contents as oc')
            // ->selectRaw('quantity, unit_price, total_price, product_id, order_id,
            // (Select product_name from product_core where id = (Select product_id from product_variants where id = oc.product_id )) as name')
            // ->whereRaw('order_id IN (Select id from orders where customer_id = (Select id from guest_info where session = "'.cookie::get('GI').'"))')
            // ->get();
        }else{
            Cookie::queue(  Cookie::forget('GI') );
            $select_data = DB::table('order_contents AS oc')->selectRaw('SUM(total_price) as total_price, order_id,
                (Select created_at from orders where id = oc.order_id) as date,
                (Select first_name from users where id = '.Auth::id().') as first_name,
                (Select last_name from users where id = '.Auth::id().') as last_name')
            ->groupBy('order_id')
            ->whereRaw('order_id IN (SELECT id from orders where customer_id = '.Auth::id().')')
            ->get();
        }
        
        //echo "<pre>";print_r($select_data);die;
        parent::navFunction();
        return view ('other_links/orders', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            'nav_links' => $this->navigationData, 'order_data' => $select_data]);
    }

    public function view_order($order_id){
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
            $select_order_exist = DB::table('orders')
            ->select('customer_id')
            ->whereRaw('customer_id = (Select id from guest_info where session = "'.cookie::get('GI').'") AND id = '.$order_id)
            ->get();
            if($select_order_exist -> isEmpty()){
                return redirect('/account_info');
            }

        }else{
            Cookie::queue(  Cookie::forget('GI') );
            $select_order_exist = DB::table('orders')
            ->select('customer_id')
            ->whereRaw('customer_id = "'.Auth::id().'" AND id = '.$order_id)
            ->get();
            if($select_order_exist -> isEmpty()){
                return redirect('/account_info');
            }
        }

        $select_data = DB::table('order_contents as oc')
            ->selectRaw('quantity, unit_price, total_price, product_id, order_id,
            (Select product_name from product_core where id = (Select product_id from product_variants where id = oc.product_id )) as name')
            ->whereRaw('order_id = '.$order_id)
            ->get();

       // echo "<pre>";print_r($select_data);die;
        parent::navFunction();
        return view ('other_links/view_order', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            'nav_links' => $this->navigationData, 'order_data' => $select_data]);
    }
    
}
