<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class FormsController extends Controller
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
    public function contact_info(Request $request){
        if(Auth::id()){
            $update = DB::table('users')
            ->whereRaw('id = "'.Auth::id().'" ')
            ->update(['first_name' => $request->contact_info_firstname,
                'last_name' => $request->contact_info_lastname,
                'email' => $request->contact_info_email
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
        }else{
            $update = DB::table('guest_info')
            ->whereRaw(' session = "'.cookie::get('GI').'" ')
            ->update(['first_name' => $request->contact_info_firstname,
                'last_name' => $request->contact_info_lastname,
                'email' => $request->contact_info_email
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }   
        }
    }  
    
    public function billing_address(Request $request){
        if(Auth::id()){
            $update = DB::table('users')
            ->whereRaw('id = "'.Auth::id().'" ')
            ->update(['email' => $request->billling_address_email,
                'country' => $request->billling_address_country,
                'address' => $request->billling_address_address,
                'city' => $request->billling_address_city,
                'phone' => $request->billling_address_phone
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
        }else{
            $update = DB::table('guest_info')
            ->whereRaw('session = "'.cookie::get('GI').'"')
            ->update(['email' => $request->billling_address_email,
                'country' => $request->billling_address_country,
                'address' => $request->billling_address_address,
                'city' => $request->billling_address_city,
                'phone' => $request->billling_address_phone
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
        }
    }

    public function manage_address(Request $request){
        $update = DB::table('users')
            ->whereRaw('id = "'.Auth::id().'" ')
            ->update(['address' => $request->primary_add,
                'secondary_address' => $request->secondary_add
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
    }

    public function save_address_checkout(Request $request){
        if(Auth::id()){
            $select_p_address = DB::table('users')->select('address')->whereRaw('id = "'.Auth::id().'" ')->first();
            if(empty($select_p_address)){
                $update = DB::table('users')
                ->whereRaw('id = "'.Auth::id().'" ')
                ->update(['secondary_address' => $request->secondary_address,
                    'secondary_email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }else{
                $update = DB::table('users')
                ->whereRaw('id = "'.Auth::id().'" ')
                ->update(['address' => $request->secondary_address,
                    'email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }
            
        }else{
            $select_p_address = DB::table('guest_info')->select('address')->whereRaw('session = "'.cookie::get('GI').'" ')->first();
            if(empty($select_p_address)){
                $update = DB::table('guest_info')
                ->whereRaw('session = "'.cookie::get('GI').'" ')
                ->update(['secondary_address' => $request->secondary_address,
                    'secondary_email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }else{
                $update = DB::table('guest_info')
                ->whereRaw('session = "'.cookie::get('GI').'" ')
                ->update(['address' => $request->secondary_address,
                    'email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }
           
        }
       
    }

    // public function place_order(Request $request){
    //     if(!Auth::id()){

    //         $select_cart = DB::table('cart')
    //             ->whereRaw('customer_id = (Select id from guest_info where session = "'.cookie::get('GI').'") AND is_active = "1" ')
    //             ->get();

    //             foreach($select_cart as $items){
    //                 $update_products = DB::table('product_variants')
    //                 ->whereRaw('id = "'.$items->product_id.'"')
    //                 ->update(['product_quantity' => DB::raw('(Select product_quantity where id = "'.$items->product_id.'") - '.$items->quantity)]);
    
    //                 $insert_to_order_content = DB::table('order_contents')
    //                     ->insert([
    //                         ['product_id' => $items->product_id,
    //                         'quantity' => $items->quantity,
    //                         'unit_price' =>  DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") 
    //                             Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'"))
    //                             End)'),
    //                         'total_price' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") * "'.$items->quantity.'"
    //                             Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'")) * "'.$items->quantity.'"
    //                             End)'),
    //                         'discount_applied' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then 0
    //                             Else (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'"))
    //                             End)'), 
    //                         'order_id' => 1 ]
    //                     ]);
    
    //                 $update_cart = DB::table('cart')
    //                     ->whereRaw('customer_id = (Select id from guest_info where session = "'.cookie::get('GI').'")')
    //                     ->update(['is_active' => '0']);
    //             }
    //             if($update_products){
    //                 //Cookie::queue(  Cookie::forget('PP') );
    //                 return redirect()->back()->with('success', 'Order placed successfully!'); 
    //             }else{
    //                 return redirect()->back()->with('failed', 'Unable to place order, try again!');
    //             }
                

    //     }else{
    //         $select_cart = DB::table('cart')
    //             ->whereRaw('customer_id = "'.Auth::id().'" AND is_active = "1" ')
    //             ->get();

    //         foreach($select_cart as $items){
    //             $update_products = DB::table('product_variants')
    //             ->whereRaw('id = "'.$items->product_id.'"')
    //             ->update(['product_quantity' => DB::raw('(Select product_quantity where id = "'.$items->product_id.'") - '.$items->quantity)]);

    //             $insert_to_order_content = DB::table('order_contents')
    //                 ->insert([
    //                     ['product_id' => $items->product_id,
    //                     'quantity' => $items->quantity,
    //                     'unit_price' =>  DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") 
    //                         Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'"))
    //                         End)'),
    //                     'total_price' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then (Select product_sale_price from product_variants where id = "'.$items->product_id.'") * "'.$items->quantity.'"
    //                         Else (Select product_sale_price from product_variants where id = "'.$items->product_id.'") - (((Select product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) / 100) * (Select product_sale_price from product_variants where id = "'.$items->product_id.'")) * "'.$items->quantity.'"
    //                         End)'),
    //                     'discount_applied' => DB::raw('(Case when (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'")) IS NULL then 0
    //                         Else (SELECT product_discount from product_core where id = (Select product_id from product_variants where id = "'.$items->product_id.'"))
    //                         End)'), 
    //                     'order_id' => 1 ]
    //                 ]);

    //             $update_cart = DB::table('cart')
    //                 ->whereRaw('customer_id = "'.Auth::id().'"')
    //                 ->update(['is_active' => '0']);

    //         }

    //         if($update_products){
    //             //Cookie::queue(  Cookie::forget('PP') );
    //             return redirect()->back()->with('success', 'Order placed successfully!'); 
    //         }else{
    //             return redirect()->back()->with('failed', 'Unable to place order, try again!');
    //         }
           
    //     }
    // }
 
}
