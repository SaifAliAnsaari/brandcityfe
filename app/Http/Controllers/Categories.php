<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class Categories extends ParentController
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
    public function categories($category_name)
    {
        //Cookie::queue(  Cookie::forget('PP') );
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
        $array = array();
 
        $core = DB::table('product_core')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->whereRaw('product_category_id = (SELECT id FROM product_categories WHERE category_name = "'.$category_name.'")')
            ->paginate(6);

        $variants = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_category_id = (Select id from product_categories where category_name = "'.$category_name.'") )')
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

       // echo "<pre>"; print_r($products); die;

        $product_cat  = $category_name;

        $categories_name = DB::table('sub_categories AS sc')
        ->selectRaw('id, category_name, (Select category_name from main_categories where id = (Select main_category_id From sub_categories where id = sc.id)) as main_category')
        ->whereRaw('id = (Select sub_category_id from  product_categories where category_name = "'.$category_name.'")')
        ->first();

        //Filters data
        $get_brands = DB::table('product_core')->select('product_brand')->orderBy('id', 'desc')->groupBy('product_brand')->limit(3)->get(); 
        $get_colors = DB::table('product_variants')->select('product_color')->groupBy('product_color')->orderBy('id', 'desc')->limit(5)->get(); 

        return view ('categories', ["category_data" => $products, "product_category" => $product_cat, "core" => $core,
                "categories" => $categories_name, 'cart_detail' => $this->get_cart_items_detail, "brands" => $get_brands, 
                "colors" => $get_colors, 'all_product_cats' => $this->get_all_productCats, 'nav_links' => $this->navigationData]);
    }

    public function categories_list($category_name){
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
        $array = array();

        $core = DB::table('product_core')
        ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
        ->whereRaw('product_category_id = (SELECT id FROM product_categories WHERE category_name = "'.$category_name.'")')
        ->paginate(6);

        $variants = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_category_id = (Select id from product_categories where category_name = "'.$category_name.'") )')
            ->get();

        $products = array();
        $counter = 0;
        foreach($core as $core_pro){
            $products[$counter]["id"] = $core_pro->id;
            $products[$counter]["name"] = $core_pro->product_name;
            $products[$counter]["discount"] = $core_pro->product_discount;
            $products[$counter]["image"] = $core_pro->product_thumbnail;
            $products[$counter]["description"] = $core_pro->product_description;
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

        $product_cat  = $category_name;

        $categories_name = DB::table('sub_categories AS sc')
        ->selectRaw('id, category_name, (Select category_name from main_categories where id = (Select main_category_id From sub_categories where id = sc.id)) as main_category')
        ->whereRaw('id = (Select sub_category_id from  product_categories where category_name = "'.$category_name.'")')
        ->first();

        //Filters data
        $get_brands = DB::table('product_core')->select('product_brand')->orderBy('id', 'desc')->groupBy('product_brand')->limit(3)->get(); 
        $get_colors = DB::table('product_variants')->select('product_color')->groupBy('product_color')->orderBy('id', 'desc')->limit(5)->get(); 

        return view ('categories_list', ["category_data" => $products, "product_category" => $product_cat, "core" => $core,
                "categories" => $categories_name, 'cart_detail' => $this->get_cart_items_detail, "brands" => $get_brands, 
                "colors" => $get_colors, 'all_product_cats' => $this->get_all_productCats, 'nav_links' => $this->navigationData]);
    }

    public function compare_products(Request $request){
        //Cookie::queue(  Cookie::forget('PP') );
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


        if(!$_COOKIE['cp'] && !$_COOKIE['cp_2']){
            return Redirect::back();
        }
        
        $compare_data_one = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_size, product_color, product_sale_price, 
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_discount from product_core where id = pv.product_id) as discount,
                (Select product_description from product_core where id = pv.product_id) as description,
                (Select product_brand from product_core where id = pv.product_id) as brand,
                (Select type_name from product_types where id = (Select product_type_id from product_core where id = pv.product_id)) as product_type')
            ->whereRaw('id ='.$_COOKIE["cp"])
            ->get();

        // $spec_one = DB::table('product_spec_sheet as ps')
        //     ->selectRaw('spec_id, description, (Select specification from product_type_specs where id = ps.spec_id) as spec_type')
        //     ->whereRaw('product_id = (Select product_id from product_variants where id = "'.$request->cookie('cp').'")')
        //     ->get();
        $spec_one = DB::table('product_type_specs as pts')
            ->selectRaw('id, specification, IFNULL((SELECT description from product_spec_sheet where spec_id = pts.id and product_id = (Select product_id from product_variants where id = "'.$request->cookie('cp').'")), "NA") as description')->get();

        // echo "<pre>"; print_r($test); die;
       
        $compare_data_two = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_size, product_color, product_sale_price, 
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_discount from product_core where id = pv.product_id) as discount,
                (Select product_description from product_core where id = pv.product_id) as description,
                (Select product_brand from product_core where id = pv.product_id) as brand,
                (Select type_name from product_types where id = (Select product_type_id from product_core where id = pv.product_id)) as product_type')
            ->whereRaw('id ='.$_COOKIE["cp_2"])
            ->get();

        // $spec_two = DB::table('product_spec_sheet as ps')
        //     ->selectRaw('spec_id, description, (Select specification from product_type_specs where id = ps.spec_id) as spec_type')
        //     ->whereRaw('product_id = (Select product_id from product_variants where id = "'.$request->cookie('cp_2').'")')
        //     ->get();
        $spec_two = DB::table('product_type_specs as pts')
            ->selectRaw('id, specification, IFNULL((SELECT description from product_spec_sheet where spec_id = pts.id and product_id = (Select product_id from product_variants where id = "'.$request->cookie('cp_2').'")), "NA") as description')->get();
        //echo "<pre>";print_r($compare_data_two); die;

        return view ('compare_products', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            'nav_links' => $this->navigationData, 'product1_detai' => $compare_data_one, "product2_detail" => $compare_data_two,
            'spec_one' => $spec_one, 'spec_two' => $spec_two]);
    }

    public function filter(Request $request){
        //Cookie::queue(  Cookie::forget('PP') );
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
        //echo cookie::get('filter');die;
        $filter_val = $_COOKIE['filter'];
        $split_val = explode('-', $filter_val, 2);
       // echo $split_val[1]; die;
        $get_brands = DB::table('product_core')->select('product_brand')->orderBy('id', 'desc')->groupBy('product_brand')->limit(3)->get(); 
        $get_colors = DB::table('product_variants')->select('product_color')->groupBy('product_color')->orderBy('id', 'desc')->limit(5)->get(); 
        
       

        if($split_val[0] == 'price'){
            //echo 'price'; die;
            if($split_val[1] == '999.99'){

                $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail')
                ->whereRaw('id IN (Select product_id from product_variants where product_sale_price  <= "'.$split_val[1].'" AND is_active > 0)  ')
                ->paginate(6);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_sale_price  <= "'.$split_val[1].'" AND is_active > 0')
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

            }else{
                $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail')
                ->whereRaw('id IN (Select product_id from product_variants where product_sale_price  >= "'.$split_val[1].'" AND is_active > 0)  ')
                ->paginate(3);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_sale_price  >= "'.$split_val[1].'" AND is_active > 0')
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
            }
           
        }else if($split_val[0] == 'brand'){
            $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail')
                ->whereRaw('id IN (Select product_id from product_variants where is_active > 0) AND product_brand = "'.$split_val[1].'" ')
                ->paginate(3);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_id IN (Select id from product_core where product_brand = "'.$split_val[1].'") AND is_active > 0')
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

        }else if($split_val[0] == 'color'){
            $core = DB::table('product_core as pc')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->whereRaw('id IN (Select product_id from product_variants where product_color = "'.$split_val[1].'" AND is_active > 0) ')
            ->paginate(3);

            $variants = DB::table('product_variants as pv')
                ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                    (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                ->whereRaw('product_color = "'.$split_val[1].'" AND is_active > 0')
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
            $get_filter_data = DB::table('product_variants AS pv')
                ->selectRaw('id, product_id, product_color, product_sale_price,
                (Select AVG(quality) from ratting where product_id = pv.id) as average_rating,
                (Select product_thumbnail from product_core where id = pv.product_id) as product_thumbnail,
                (Select id from product_core where id = pv.product_id) as button_id, 
                (Select product_name from product_core where id = pv.product_id) as product_name,
                (Select count(*) from product_core where id = pv.product_id) as total_variants,
                (Select product_discount from product_core where id = pv.product_id) as product_discount,
                (Select product_description from product_core where id = pv.product_id) as description,
                (Select id from product_variants where id = pv.id)as wishlist_id
                ')
                ->whereRaw ('(Select is_active from product_variants where product_id = (Select id from product_core where id = pv.product_id)) = 1 AND product_color = "'.$split_val[1].'" AND is_active > 0')
                ->paginate(6);
                // return view("filter/filter_layout", ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
                //  "brands" => $get_brands, "colors" => $get_colors, 'filter_data' => $get_filter_data, 'nav_links' => $this->navigationData]);
            //echo "<pre>"; print_r($get_filter_data); die;
        }else if($split_val[0] == 'discount'){
            $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail')
                ->whereRaw('id IN (Select product_id from product_variants where is_active > 0) AND product_discount <= "'.$split_val[1].'" ')
                ->paginate(3);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_id IN (Select id from product_core where product_discount <= "'.$split_val[1].'") AND is_active > 0')
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
            
        }
        return view("filter/filter_layout", ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            "brands" => $get_brands, "colors" => $get_colors, 'category_data' => $products, 'nav_links' => $this->navigationData,
            "core" => $core]);
         
    }

    public function filter_list(Request $request){
        //Cookie::queue(  Cookie::forget('PP') );
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
        //echo cookie::get('filter');die;
        $filter_val = cookie::get('filter');
        $split_val = explode('-', $filter_val, 2);
       // echo $split_val[1]; die;
        $get_brands = DB::table('product_core')->select('product_brand')->orderBy('id', 'desc')->groupBy('product_brand')->limit(3)->get(); 
        $get_colors = DB::table('product_variants')->select('product_color')->groupBy('product_color')->orderBy('id', 'desc')->limit(5)->get(); 
        
       

        if($split_val[0] == 'price'){
            //echo 'price'; die;
            if($split_val[1] == '999.99'){

                $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
                ->whereRaw('id IN (Select product_id from product_variants where product_sale_price  <= "'.$split_val[1].'" AND is_active > 0)  ')
                ->paginate(6);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_sale_price  <= "'.$split_val[1].'" AND is_active > 0')
                    ->get();
        
                $products = array();
                $counter = 0;
                foreach($core as $core_pro){
                    $products[$counter]["id"] = $core_pro->id;
                    $products[$counter]["name"] = $core_pro->product_name;
                    $products[$counter]["discount"] = $core_pro->product_discount;
                    $products[$counter]["image"] = $core_pro->product_thumbnail;
                    $products[$counter]["description"] = $core_pro->product_description;
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

            }else{
                $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
                ->whereRaw('id IN (Select product_id from product_variants where product_sale_price  >= "'.$split_val[1].'" AND is_active > 0)  ')
                ->paginate(3);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_sale_price  >= "'.$split_val[1].'" AND is_active > 0')
                    ->get();
        
                $products = array();
                $counter = 0;
                foreach($core as $core_pro){
                    $products[$counter]["id"] = $core_pro->id;
                    $products[$counter]["name"] = $core_pro->product_name;
                    $products[$counter]["discount"] = $core_pro->product_discount;
                    $products[$counter]["image"] = $core_pro->product_thumbnail;
                    $products[$counter]["description"] = $core_pro->product_description;
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
            }
           
        }else if($split_val[0] == 'brand'){
            $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
                ->whereRaw('id IN (Select product_id from product_variants where is_active > 0) AND product_brand = "'.$split_val[1].'" ')
                ->paginate(3);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_id IN (Select id from product_core where product_brand = "'.$split_val[1].'") AND is_active > 0')
                    ->get();
        
                $products = array();
                $counter = 0;
                foreach($core as $core_pro){
                    $products[$counter]["id"] = $core_pro->id;
                    $products[$counter]["name"] = $core_pro->product_name;
                    $products[$counter]["discount"] = $core_pro->product_discount;
                    $products[$counter]["image"] = $core_pro->product_thumbnail;
                    $products[$counter]["description"] = $core_pro->product_description;
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

        }else if($split_val[0] == 'color'){
            $core = DB::table('product_core as pc')
            ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
            ->whereRaw('id IN (Select product_id from product_variants where product_color = "'.$split_val[1].'" AND is_active > 0) ')
            ->paginate(3);

            $variants = DB::table('product_variants as pv')
                ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                    (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                ->whereRaw('product_color = "'.$split_val[1].'" AND is_active > 0')
                ->get();
    
            $products = array();
            $counter = 0;
            foreach($core as $core_pro){
                $products[$counter]["id"] = $core_pro->id;
                $products[$counter]["name"] = $core_pro->product_name;
                $products[$counter]["discount"] = $core_pro->product_discount;
                $products[$counter]["image"] = $core_pro->product_thumbnail;
                $products[$counter]["description"] = $core_pro->product_description;
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
           
        }else if($split_val[0] == 'discount'){
            $core = DB::table('product_core as pc')
                ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
                ->whereRaw('id IN (Select product_id from product_variants where is_active > 0) AND product_discount <= "'.$split_val[1].'" ')
                ->paginate(3);
    
                $variants = DB::table('product_variants as pv')
                    ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                        (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                    ->whereRaw('product_id IN (Select id from product_core where product_discount <= "'.$split_val[1].'") AND is_active > 0')
                    ->get();
        
                $products = array();
                $counter = 0;
                foreach($core as $core_pro){
                    $products[$counter]["id"] = $core_pro->id;
                    $products[$counter]["name"] = $core_pro->product_name;
                    $products[$counter]["discount"] = $core_pro->product_discount;
                    $products[$counter]["image"] = $core_pro->product_thumbnail;
                    $products[$counter]["description"] = $core_pro->product_description;
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
            
        }
        return view("filter/filter_ListView", ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
            "brands" => $get_brands, "colors" => $get_colors, 'category_data' => $products, 'nav_links' => $this->navigationData,
            "core" => $core]);
         
    }
}
