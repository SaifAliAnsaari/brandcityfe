<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // parent::__construct();
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     //Ajax delete one item from wishlist
     public function response_delete_one_item_wishlist(Request $request){
        if(!Auth::id()){
            $delete_item = DB::table('wishlist')->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND product_id = '.$request->id)->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
         }else{
            $delete_item = DB::table('wishlist')->where('product_id', '=', $request->id)->where('customer_id', '=', Auth::id())->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }
     }

    //Ajax Add item to Cart
    public function response_add_to_cart(Request $request){
        
        if($request->user_id == "guest_user"){
            //echo json_encode("Please register first to add this product to your favourites");
            $check_product_active = DB::table('product_variants')->select('is_active')->whereRaw ('id ="'.$request->product_id.'" AND product_quantity >= '.$request->quantity)->first();
            if(empty($check_product_active)){
                echo json_encode("limit exceed");
            }else{

                if($check_product_active->is_active > 0){
                    //check if product already exist
                    $check_if_product_exist = DB::table('cart')->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND is_active = 1 AND product_id ='.$request->product_id )->first(); 
                    $guest_user = DB::table('guest_info')->select('id')->whereRaw('session = "'.$_COOKIE['GI'].'"')->first();
                    if(empty($check_if_product_exist)){
                        $insert_to_cart = DB::table('cart')->insert([
                        ['customer_id' => $guest_user->id, 'customer_type' => 'Guest user', 'product_id' => $request->product_id,
                        'quantity' => $request->quantity, 'is_active' => 1]
                        ]);
                        if($insert_to_cart){
                            echo json_encode("success");
                        }else{
                            echo json_encode("failed");
                        }  
                    }else{
                       $new_quantity = $check_if_product_exist->quantity + $request->quantity;
                       $check_limit_exceed = DB::table('product_variants as pv')
                        ->select('product_quantity')
                        ->where('id', '=', $request->product_id)
                        ->first();

                        if($new_quantity > $check_limit_exceed->product_quantity){
                            echo json_encode('limit exceed');
                        }else{
                            $update_cart = DB::table('cart')
                            ->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND product_id ='.$request->product_id)
                            ->update(['quantity' => $new_quantity]);
                            if($update_cart){
                                 echo json_encode('update success');
                            }else{
                                echo json_encode('failed');
                            }
                        }

                       
                    }
                }else{
                    //Sorry this item is no longer available.
                    echo json_encode("sorry message");
                }
            }
            

        }else{
            //first check product is active or not.
            $check_product_active = DB::table('product_variants')->select('is_active')->whereRaw ('id ="'.$request->product_id.'" AND product_quantity >= '.$request->quantity)->first();
            if(empty($check_product_active)){
                echo json_encode("limit exceed");
            }else{

                if($check_product_active->is_active > 0){
                    //check if product already exist
                    $check_if_product_exist = DB::table('cart')->whereRaw('customer_id = "'.$request->user_id.'" AND is_active = 1 AND product_id = '.$request->product_id)->first(); 
                    if(empty($check_if_product_exist)){
                        $insert_to_cart = DB::table('cart')->insert([
                        ['customer_id' => $request->user_id, 'customer_type' => 'logged in user', 'product_id' => $request->product_id,
                        'quantity' => $request->quantity, 'is_active' => 1]
                        ]);
                        if($insert_to_cart){
                            echo json_encode("success");
                        }else{
                            echo json_encode("failed");
                        }  
                    }else{
                       $new_quantity = $check_if_product_exist->quantity + $request->quantity;
                       $update_cart = DB::table('cart')
                       ->where('customer_id', $request->user_id)->where('product_id', $request->product_id)
                       ->update(['quantity' => $new_quantity]);
                       if($update_cart){
                            echo json_encode('update success');
                       }else{
                           echo json_encode('failed');
                       }
                    }
                }else{
                    //Sorry this item is no longer available.
                    echo json_encode("sorry message");
                }

            }
             
        }
    }

    //AJAX Add item to wishlist
    public function response_add_to_wishlist(Request $request){
        //echo json_encode($_COOKIE['GI']); die;
        $check_product_active = DB::table('product_variants')->select('is_active')->where ('id', '=', $request->product_id)->first();
        if($request->user_id == "guest_user"){
           //echo json_encode("Please register first to add this product to your favourites");
           if($check_product_active){
               $check_if_product_exist = DB::table('wishlist')->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND product_id = '.$request->product_id)->first(); 
               $guest_user = DB::table('guest_info')->select('id')->whereRaw('session = "'.$_COOKIE['GI'].'"')->first();
              // echo json_encode($_COOKIE['GI']); die;
               //print_r(json_encode($guest_user)); die;
               if(empty($check_if_product_exist)){
                   $insert_to_wishlist = DB::table('wishlist')->insert([
                       ['customer_id' => $guest_user->id, 'customer_type' => 'Guest user', 'product_id' => $request->product_id]
                       ]);
                       if($insert_to_wishlist){
                           echo json_encode("success");
                       }else{
                           echo json_encode("failed");
                       }  
               }else{
                   echo json_encode("already exist");
               }

           }else{
               echo json_encode("sorry message");
           }

        }else{
            if($check_product_active){

                $check_if_product_exist = DB::table('wishlist')->where('customer_id', '=', $request->user_id)->where('product_id', '=', $request->product_id)->first(); 
                if(empty($check_if_product_exist)){

                    $insert_to_wishlist = DB::table('wishlist')->insert([
                        ['customer_id' => $request->user_id, 'customer_type' => 'logged in user', 'product_id' => $request->product_id]
                        ]);
                        if($insert_to_wishlist){
                            echo json_encode("success");
                        }else{
                            echo json_encode("failed");
                        }  
                }else{
                    echo json_encode("already exist");
                }

            }else{
                echo json_encode("sorry message");
            }
        }
    }

    //AJAX Delete one item from cart
    public function response_delete_one_item(Request $request){
        if(!Auth::id()){
            $delete_item = DB::table('cart')->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND product_id ='.$request->id)->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }else{
            $delete_item = DB::table('cart')->where('product_id', '=', $request->id)->where('customer_id', '=', Auth::id())->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }
        
    }

    //AJAX Clear whole cart
    public function response_clear_cart(Request $request){
        if(!Auth::id()){
            $delete_item = DB::table('cart')->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")')->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }else{
            $delete_item = DB::table('cart')->where('customer_id', '=', Auth::id())->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }
    }

    public function response_update_cart(Request $request){
        $data = array();
        $counter = 0;
        foreach (json_decode($request->data) as $val) {
            $data[] = array('id' => $val->id, 'quantity' => $val->quantity);
        }

        foreach($data as $data){
            $update = DB::table('cart')
            ->where('id', $data['id'])->update(['quantity' => $data['quantity']]);
        }
            echo json_encode('success');
    }

    //AJAX Search box dropdown
    public function response_search_dropdown(Request $request){
        //echo json_encode($request->query_val);
        $output = "";
        $query = DB::table('product_core')
            ->select('product_name')
            ->Where('product_name', 'like', '%' . $request->query_val . '%')
            ->where('product_category_id', '=', $request->category)
            //->whereRaw('product_name LIKE "'.$request->query_val.'"')
            ->get(); 
        $output = '<ul class = "list-unstyled">';
        if(count($query) > 0){

            foreach($query as $data){
                $output .= '<li class = "dropdown_listitems">'.$data->product_name.'</li>';
            }

        }else{
            $output .= '<li>Product Not Found</li>';
        }
        $output .= '</ul>';
        echo json_encode($output);
    }

    //Ajax clear whole wishlist
    public function clear_wishlist(Request $request){
        if(!Auth::id()){
            $delete_item = DB::table('wishlist')->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")')->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }else{
            $delete_item = DB::table('wishlist')->where('customer_id', '=', Auth::id())->delete();
            if($delete_item){
                echo json_encode("successs");
            }else{
                echo json_encode("failed");
            }
        }
    }

    //Ajax save filter cookie
    public function set_filter_cookie(Request $request){
        $minutes = 300;
        $filter_val = $request->id;
        //Cookie::queue(Cookie::make('filter', $filter_val, 30));
        setcookie('filter', $filter_val, time() + (86400 * 30), "/");
            echo json_encode('success');
        
    }

    public function response_get_quickView_data(Request $request){
        //echo json_encode($request->id);
        // $get_data = DB::table('product_core as pc')
        //     ->selectRaw('id, product_name, product_brand, product_description, product_discount, product_thumbnail,
        //     (Select is_active from product_variants where product_id = pc.id) as active,
        //     (Select id from product_variants where product_id = pc.id) as product_id,
        //     (Select COUNT(*) from ratting where product_id = (Select id from product_variants where product_id = pc.id)) as rate_counts,
        //     (Select AVG(quality) from ratting where product_id = (Select id from product_variants where product_id = pc.id)) as average_rating,
        //     (Case when (SELECT count(*) from product_variants where product_id = pc.id) = 1 
        //     then (Select product_sale_price from product_variants where product_id = pc.id) 
        //     Else (Select product_size from product_variants where product_id = pc.id)  
        //     End) as price')
        //     ->whereRaw('id ='.$request->id)
        //     ->get();

        $pCore = DB::table('product_core')
        ->selectRaw('id, product_name, product_brand, product_discount, product_thumbnail, product_description, 
            (Select AVG(quality) from ratting where product_id = "'.$request->id.'") as average_rating,
            (Select COUNT(*) from ratting where product_id = "'.$request->id.'") as rate_counts')
        ->where('id', '=', $request->id)
        ->first();

        $variant = DB::table('product_variants as pv')
            ->selectRaw('id, product_quantity, product_sale_price, product_color, product_size, is_active')
            ->whereRaw('product_id ='.$request->id)
            ->get();
        $result = array();
        $result[] = array('core' => $pCore, 'variant' => $variant);

        // $products = array();
        // $counter = 0;
        // foreach($pCore as $core_pro){
        //     $products[$counter]["id"] = $core_pro->id;
        //     $products[$counter]["name"] = $core_pro->product_name;
        //     $products[$counter]["discount"] = $core_pro->product_discount;
        //     $products[$counter]["image"] = $core_pro->product_thumbnail;
        //     $v_products = array();
        //     foreach($variants as $variants_pro){
        //         if($variants_pro->product_id == $core_pro->id){
        //             $v_products[] = array(
        //                 "variant_id" => $variants_pro->id,
        //                 "price" => $variants_pro->product_sale_price,
        //                 "color" => $variants_pro->product_color,
        //                 "size" => $variants_pro->product_size,
        //                 "ratting" => $variants_pro->ratting
        //             ); 
        //         }
        //     }
        //     $products[$counter]["variants"] = $v_products;
        //     $counter ++;
        // }

        print_r(json_encode($result));
    }

    public function resonse_deactivate_subscription(Request $request){
       
        $remove_subscription = DB::table('subscription')
        ->whereRaw('email = (Select email from users where id = "'.Auth::id().'")')
        ->delete();
        if($remove_subscription){
            echo json_encode('success');
        }else{
            echo json_encode('failed');
        }
    }

    public function compare_products(Request $request){

        if(isset($_COOKIE['cp'])){
            $check_spec_type = DB::table('product_core as pc')
            ->selectRaw('product_type_id')
            ->whereRaw('id = (Select product_id from product_variants where id = "'.$_COOKIE['cp'].'") AND
                pc.product_type_id = (Select product_type_id from product_core where id = (Select product_id from product_variants where id = "'.$request->id.'"))')
            ->first();
    
            if($check_spec_type){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
       
       
    }

    public function resonse_proceed_to_checkout(){
        if(Auth::id()){
            $select_product_quantity = DB::table('cart')
            ->select('quantity', 'product_id')
            ->whereRaw('customer_id = "'.Auth::id().'" AND is_active = 1')
            ->get();
        }else{
            $select_product_quantity = DB::table('cart')
            ->select('quantity', 'product_id')
            ->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND is_active = 1')
            ->get();
        }
        
        
        if($select_product_quantity->isEmpty()){
            echo json_encode('unavailable');
        }else{
            setcookie('PP', "active", time() + 1800, "/");
            //Cookie::queue(Cookie::make('PP', "active", 30));

            foreach($select_product_quantity as $items){
                $check_quantity = DB::table('product_variants')
                    ->selectRaw('product_quantity >= '.$items->quantity)
                    ->whereRaw('id = '.$items->product_id)
                    ->get();
            }
            if($check_quantity){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }

        
    }

    public function resonse_place_order(Request $request){
        //echo json_encode($request->address. " - " .$request->shipping_charges ." - " .$request->payment_method);
        if(Auth::id()){
            $insert = DB::table('orders')->insertGetId([
                'customer_id' => Auth::id(),
                'delivery_address' => $request->address,
                'customer_type' => "registered",
                'delivery_charges' => $request->shipping_charges,
                'payment_method' => $request->payment_method
            ]);
            if($insert){
                //echo json_encode($insert); die;
                $select_cart = DB::table('cart')
                ->whereRaw('customer_id = "'.Auth::id().'" AND is_active = "1" ')
                ->get();
                if($select_cart->isEmpty()){
                    echo json_encode('failed');
                }else{
                    foreach($select_cart as $items){
                        $update_products = DB::table('product_variants')
                        ->whereRaw('id = "'.$items->product_id.'"')
                        ->update(['product_quantity' => DB::raw('(Select product_quantity where id = "'.$items->product_id.'") - '.$items->quantity)]);

                        $insert_to_order_content = DB::table('order_contents')
                            ->insert([
                                ['product_id' => $items->product_id,
                                'quantity' => $items->quantity,
                                'unit_price' =>  DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") 
                                    Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'"))
                                    End)'),
                                'total_price' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") * "'.$items->quantity.'"
                                    Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'")) * "'.$items->quantity.'"
                                    End)'),
                                'discount_applied' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then 0
                                    Else (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'"))
                                    End)'), 
                                'order_id' => $insert ]
                            ]);

                        $update_cart = DB::table('cart')
                            ->whereRaw('customer_id = "'.Auth::id().'"')
                            ->update(['is_active' => '0']);

                    }
                }

                if($update_products){
                    echo json_encode('success');
                    //Cookie::queue(  Cookie::forget('PP') );
                    //return redirect()->back()->with('success', 'Order placed successfully!'); 
                }else{
                    echo json_encode('failed');
                    //return redirect()->back()->with('failed', 'Unable to place order, try again!');
                }
            }else{
                echo json_encode('failed');
            }
        }else{
            $insert = DB::table('orders')->insertGetId([
                'customer_id' => DB::raw('(Select id from guest_info where session = "'.$_COOKIE['GI'].'")'),
                'delivery_address' => $request->address,
                'customer_type' => "guest",
                'delivery_charges' => $request->shipping_charges,
                'payment_method' => $request->payment_method
            ]);
            if($insert){
                //$insert->id;
                $select_cart = DB::table('cart')
                ->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'") AND is_active = "1" ')
                ->get();
                if($select_cart->isEmpty()){
                    echo json_encode('failed');
                }else{
                    foreach($select_cart as $items){
                        $update_products = DB::table('product_variants')
                        ->whereRaw('id = "'.$items->product_id.'"')
                        ->update(['product_quantity' => DB::raw('(Select product_quantity where id = "'.$items->product_id.'") - '.$items->quantity)]);
        
                        $insert_to_order_content = DB::table('order_contents')
                            ->insert([
                                ['product_id' => $items->product_id,
                                'quantity' => $items->quantity,
                                'unit_price' =>  DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") 
                                    Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'"))
                                    End)'),
                                'total_price' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") * "'.$items->quantity.'"
                                    Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'")) * "'.$items->quantity.'"
                                    End)'),
                                'discount_applied' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then 0
                                    Else (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'"))
                                    End)'), 
                                'order_id' => $insert ]
                            ]);
        
                        $update_cart = DB::table('cart')
                            ->whereRaw('customer_id = (Select id from guest_info where session = "'.$_COOKIE['GI'].'")')
                            ->update(['is_active' => '0']);
                    }
                }
                if($update_products){
                    echo json_encode('success');
                    //Cookie::queue(  Cookie::forget('PP') );
                    //return redirect()->back()->with('success', 'Order placed successfully!'); 
                }else{
                    echo json_encode('failed');
                    //return redirect()->back()->with('failed', 'Unable to place order, try again!');
                }
            }else{
                echo json_encode('failed');
            }
        }
    }

}
