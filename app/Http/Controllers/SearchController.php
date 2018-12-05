<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class SearchController extends ParentController
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

      //Search items FORM
    public function search_items(Request $request){
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
        if ($request->cat == 0 || $request->search_dropdown == ""){
            echo "Please fill both fields";
        }else{
           
            $core = DB::table('product_core')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->whereRaw('product_category_id = "'.$request->cat.'" AND product_name like "%" "'.$request->search_dropdown.'" "%" ')
            ->paginate(6);

            $variants = DB::table('product_variants as pv')
                ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                    (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                ->whereRaw('product_id IN (Select id from product_core where product_category_id = "'.$request->cat.'" )')
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

            $cat_name = DB::table('product_categories')
                ->select('category_name')
                ->whereRaw("id = ". $request->cat)
                ->first();

            
            return view("search_items/search_items", ['cart_detail' => $this->get_cart_items_detail, "core" => $core, "cat" => $cat_name,
            'all_product_cats' => $this->get_all_productCats, 'category_data' => $products, 'nav_links' => $this->navigationData]);
           
        }
    }

}
