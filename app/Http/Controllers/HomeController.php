<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class HomeController extends ParentController
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
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function index()
    {
        setcookie('C-D', "", time() - (86400 * 30), "/");
       //proceed to checkout
       setcookie('PP', "", time() - (86400 * 30), "/");
        //Cookie::queue(  Cookie::forget('PP') );
        if(!Auth::id()){
            if(isset($_COOKIE['GI'])){ 
                
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $_SERVER['REMOTE_ADDR']]
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
        $get_campaign = DB::table('campaign_management')->select()->orderBy('id', 'desc')->limit(2)->get();  
        //echo "<pre>"; print_r($get_campaign); die;
    
        $get_hot_deal = DB::table('product_core as pc')
            ->selectRaw('id, product_thumbnail, product_name, product_discount, 
                (Select product_sale_price from product_variants where product_id = pc.id limit  1) as product_sale_price,
                (Select AVG(quality) from ratting where product_id = (Select id from product_variants where product_id = pc.id)) as average_rating,
                (Select id from product_variants where product_id = pc.id limit  1) as product_variant_id')
            ->limit(1)
            ->whereRaw('hot_deal = 1 AND (Select is_active from product_variants where product_id = pc.id) = 1 AND is_approved = 1')
            ->first();
        //echo "<pre>";print_r($get_hot_deal); die;
        
       
        $featured_core = DB::table('product_core as pc')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->whereRaw('product_sku IN (Select sku from featured_products) AND (Select is_active from product_variants where product_id = pc.id) = 1 AND is_approved = 1')
            ->get(); 
        $featured_variants = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_sku IN (Select sku from featured_products) )')
            ->get(); 
        $featured_products = array();
        $counter = 0;
        foreach($featured_core as $core_pro){
            $featured_products[$counter]["id"] = $core_pro->id;
            $featured_products[$counter]["name"] = $core_pro->product_name;
            $featured_products[$counter]["discount"] = $core_pro->product_discount;
            $featured_products[$counter]["image"] = $core_pro->product_thumbnail;
            $v_products = array();
            foreach($featured_variants as $variants_pro){
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
            $featured_products[$counter]["variants"] = $v_products;
            $counter ++;
        }
        //echo "<pre>"; print_r($featured_products); die;

        $top_three_products = DB::table('quick_products as qp')
        ->selectRaw('custom_banner, product_id')
        ->limit(3)
        ->get();

        
        $custom_categories = DB::table('home_new_products_categories')->first();


        if(!empty($custom_categories)){

            $custom_cat_names = DB::table('product_categories')
                ->select('category_name')
                ->whereRaw('id IN ("'.$custom_categories->category_1.'", "'.$custom_categories->category_2.'", "'.$custom_categories->category_3.'", "'.$custom_categories->category_4.'")')
                ->get();

            $custom_cat_one = DB::table('product_variants as pv')
            ->selectRaw('id, product_sale_price, product_id, product_color,
                (Select id from product_core where id = pv.product_id) as core_id,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_discount from product_core where id = pv.product_id) as discount,
                (Select AVG(quality) from ratting where product_id = pv.id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_category_id = "'.$custom_categories->category_1.'" AND is_approved = 1) AND is_active = 1')
            ->orderby('id', 'desc')
            ->limit(4)
            ->get();

            $custom_cat_two = DB::table('product_variants as pv')
            ->selectRaw('id, product_sale_price, product_id, product_color,
                (Select id from product_core where id = pv.product_id) as core_id,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_discount from product_core where id = pv.product_id) as discount,
                (Select AVG(quality) from ratting where product_id = pv.id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_category_id = "'.$custom_categories->category_2.'" AND is_approved = 1) AND is_active = 1')
            ->orderby('id', 'desc')
            ->limit(4)
            ->get();

            $custom_cat_three = DB::table('product_variants as pv')
            ->selectRaw('id, product_sale_price, product_id, product_color,
                (Select id from product_core where id = pv.product_id) as core_id,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_discount from product_core where id = pv.product_id) as discount,
                (Select AVG(quality) from ratting where product_id = pv.id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_category_id = "'.$custom_categories->category_3.'" AND is_approved = 1) AND is_active = 1')
            ->orderby('id', 'desc')
            ->limit(4)
            ->get();

            $custom_cat_four = DB::table('product_variants as pv')
            ->selectRaw('id, product_sale_price, product_id, product_color,
                (Select id from product_core where id = pv.product_id) as core_id,
                (Select product_thumbnail from product_core where id = pv.product_id) as image,
                (Select product_name from product_core where id = pv.product_id) as name,
                (Select product_discount from product_core where id = pv.product_id) as discount,
                (Select AVG(quality) from ratting where product_id = pv.id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_category_id = "'.$custom_categories->category_4.'" AND is_approved = 1) AND is_active = 1')
            ->orderby('id', 'desc')
            ->limit(4)
            ->get();

        }else{
            $custom_cat_names = array();
            $custom_cat_one = array();
            $custom_cat_two = array();
            $custom_cat_three = array();
            $custom_cat_four = array();
        }

        //echo "<pre>"; print_r($custom_cat_names); die;
 
        $featured_banner = DB::table('product_core as pc')
            ->selectRaw('id, product_name, (Select new_product_banner_img from home_misc) as image')
            ->whereRaw('product_sku = (Select new_product_banner_sku from home_misc) AND is_approved = 1')
            ->first();
            //echo "<pre>"; print_r($featured_banner); die;
         
        return view('home', ['campaigns' => $get_campaign, 'hot_deal' => $get_hot_deal, 'top_products' => $top_three_products,
            'cart_detail' => $this->get_cart_items_detail, 'featured_products' => $featured_products, 
            'all_product_cats' => $this->get_all_productCats, 'nav_links' => $this->navigationData, "custom_cat_1" => $custom_cat_one,
            "custom_cat_2" => $custom_cat_two,  "custom_cat_3" => $custom_cat_three,  "custom_cat_4" => $custom_cat_four,
            "custom_cat_names" => $custom_cat_names, 'featured_banner' => $featured_banner
            // 'new_products' => $data
            ]);
    }

    function my_array_merge($array1, $array2) {
        $result = Array();
        foreach($array1 as $key => &$value) {
            $result[$key] = array_merge($value, $array2[$key]);
        }
        return $result;
    }

    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }

    public function product_detail($product_id){
        setcookie('C-D', "", time() - (86400 * 30), "/");
        //Cookie::queue(  Cookie::forget('PP') );
        //proceed to checkout
        setcookie('PP', "", time() - (86400 * 30), "/");
        if(!Auth::id()){
            if(isset($_COOKIE['GI'])){ 
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $_SERVER['REMOTE_ADDR']]
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

        $categories = DB::table('product_categories')
            ->selectRaw('id, category_name, 
            (Select category_name from sub_categories where id = (Select sub_category_id from  product_categories where id = (Select product_category_id from product_core where id = '.$product_id.'))) as sub_category,
            (Select category_name from main_categories where id = (Select main_category_id From sub_categories where id = (Select sub_category_id From product_categories where id = (Select product_category_id from product_core where id = '.$product_id.')))) as main_category')
            ->whereRaw('id = (SELECT product_category_id FROM product_core WHERE id = "'.$product_id.'")')
            ->first();

        //Selected product_detail
        $pCore = DB::table('product_core')
            ->selectRaw('id, product_name, product_brand, product_discount, product_thumbnail, product_description, product_type_id,
                (Select AVG(quality) from ratting where product_id = "'.$product_id.'") as average_rating,
                (Select COUNT(*) from ratting where product_id = "'.$product_id.'") as rate_counts')
            ->whereRaw('id = "'.$product_id.'" AND is_approved = 1')
            ->first();
    
        $variant = DB::table('product_variants as pv')
                ->selectRaw('id, product_quantity, product_sale_price, product_color, product_size')
                ->whereRaw('product_id ='.$product_id)
                ->get();

        //echo "<pre>"; print_r($pCore); die;


        //Agar Core khali nae hai to related products ani chaiya warna error page
        if($pCore){
            $related_core = DB::table('product_core')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->whereRaw('is_approved= 1 AND product_category_id ='.$categories->id)
            ->get();

            $related_variants = DB::table('product_variants as pv')
                ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                    (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
                ->whereRaw('product_id IN (Select id from product_core where product_category_id = "'.$categories->id.'" )')
                ->get();

            $products = array();
            $counter = 0;
            foreach($related_core as $core_pro){
                $products[$counter]["id"] = $core_pro->id;
                $products[$counter]["name"] = $core_pro->product_name;
                $products[$counter]["discount"] = $core_pro->product_discount;
                $products[$counter]["image"] = $core_pro->product_thumbnail;
                $v_products = array();
                foreach($related_variants as $variants_pro){
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
        

        //echo "<pre>"; print_r($products); die;

        $specs = DB::table('product_spec_sheet as pss')
            ->selectRaw('id, (SELECT specification from product_type_specs where id = pss.spec_id) as specification, IFNULL(description, "NA") as description')->where('product_id', $product_id)->get();

        // echo "<pre>"; print_r($specs); die;

        $product_images = DB::table('product_images')->where ('product_id', '=', $product_id)->get(); 

        //foreach($variant as $data){
        if(Auth::id()){
            $select_my_rate = DB::table('ratting')
                ->selectRaw('nick_name, summary, review, price, value, quality, created_at, 
                    (Select AVG(quality) from ratting where product_id = '.$product_id.') as average_rating')
                ->whereRaw('product_id = '.$product_id.' And user_id = '.Auth::id())
                ->get();
       
            $product_reviews = DB::table('ratting')
                ->whereRaw('product_id = '.$product_id.' And user_id != '.Auth::id())
                ->limit(3)
                ->get();
            }else{
                $select_my_rate = "";
                $product_reviews = DB::table('ratting')
                ->whereRaw('product_id = '.$product_id)
                ->limit(3)
                ->get();
            }
        //}
       // echo "<pre>"; print_r($pCore); die;

       if(empty($pCore) || !$pCore){
            return redirect('/error');
       }else{
        return view('product_detail', ["product_core" => $pCore, "product_images" => $product_images, "specs" => $specs,
        "availability" => $variant, "categories" => $categories, "product_core_id" => $product_id,
        "related_products" => $products, 'cart_detail' => $this->get_cart_items_detail,
        'all_product_cats' => $this->get_all_productCats, 'my_rating' => $select_my_rate, 'product_reviews' => $product_reviews, 'nav_links' => $this->navigationData]);
       }

        

        
        // $product_core = DB::table('product_variants as pv')
        // ->selectRaw('id, product_quantity, 
        // (Select product_thumbnail from product_core where id = '.$product_id.') as product_thumbnail, 
        // (Select AVG(quality) from ratting where product_id = pv.id) as average_rating,
        // (Select COUNT(*) from ratting where product_id = pv.id) as rate_counts,
        // (Select product_name from product_core where id = '.$product_id.') as product_name, 
        // (Select product_description from product_core where id = '.$product_id.') as product_description,
        // (Select product_discount from product_core where id = '.$product_id.') as product_discount')
        // ->where ('product_id', '=', $product_id)->first(); 
     //echo "<pre>"; print_r($product_core); die;
        // if(empty($product_core)){
        //     echo "No item found OR this item has no information in Product Variants";
        // }else{
        //     $product_images = DB::table('product_images')->where ('product_id', '=', $product_id)->get(); 

        //    $product_availability = DB::table('product_variants')
        //    ->selectRaw('id, product_quantity, product_sale_price, product_size')
        //    ->where('product_id', $product_id)->get();

        //     $related_products = DB::table('product_core AS pc')->selectRaw('`id`, `product_name`, `product_brand`, `product_discount`, `product_thumbnail`, `product_description`,  
        //     (SELECT count(*) from product_variants where product_id = pc.id) as total_variants,
        //     (Case when (SELECT count(*) from product_variants where product_id = pc.id) = 1 then (Select product_sale_price from product_variants where product_id = pc.id) Else NULL 
        //             End) as price,
        //     (Select AVG(quality) from ratting where product_id = (Select id from product_variants where product_id = pc.id)) as average_rating,
        //     (Case when (SELECT count(*) from product_variants where product_id = pc.id) = 1 then 
        //     (Select id from product_variants where product_id = pc.id) Else NULL 
        //             End) as wishlist_id')
        //     ->whereRaw ('(Select is_active from product_variants where product_id = pc.id) = 1 AND product_category_id ='.$categories->id)
        //     ->get();
        //     //echo "<pre>"; print_r($related_products); die;

        //     foreach($product_availability as $data){
        //         if(Auth::id()){
        //         $select_my_rate = DB::table('ratting')
        //             ->selectRaw('nick_name, summary, review, price, value, quality, created_at, 
        //                 (Select AVG(quality) from ratting where product_id = '.$data->id.') as average_rating')
        //             ->whereRaw('product_id = '.$data->id.' And user_id = '.Auth::id())
        //             ->get();
           
        //         $product_reviews = DB::table('ratting')
        //             ->whereRaw('product_id = '.$data->id.' And user_id != '.Auth::id())
        //             ->limit(3)
        //             ->get();
        //         }else{
        //             $select_my_rate = "";
        //             $product_reviews = DB::table('ratting')
        //             ->whereRaw('product_id = '.$data->id)
        //             ->limit(3)
        //             ->get();
        //         }
        //     //echo "<pre>"; print_r($select_my_rate); die;
            
        //     }

            // return view('product_detail', ["product_core" => $product_core, "product_images" => $product_images, 
            //         "availability" => $product_availability, "categories" => $categories, 
            //         "related_products" => $related_products, 'cart_detail' => $this->get_cart_items_detail,
            //         'all_product_cats' => $this->get_all_productCats, 'my_rating' => $select_my_rate, 'product_reviews' => $product_reviews, 'nav_links' => $this->navigationData]);

        //}

    }

    public function account_info(){
        setcookie('C-D', "", time() - (86400 * 30), "/");
        if(!Auth::id()){
            return redirect('/login');
            // $account_info = DB::table('guest_info')->select()->where('session', '=', cookie::get('GI'))->first();
            // $check_subscription = DB::table('subscription')
            // ->select()
            // ->whereRaw ('email = (SELECT email FROM guest_info WHERE session = "'.cookie::get('GI').'") ')
            // ->first(); 
            // if(cookie::get('GI')){
            // }else{
            //     $random_token = $this->random_string(50);
            //     $insert_token = DB::table('guest_info')->insert([
            //         ['session' => $random_token,
            //         'guest_ip' => $request->ip()]
            //     ]);
            //     if($insert_token){
            //         Cookie::queue(Cookie::make('GI', $random_token, 10080));
            //     }
            // }
        }else{
            //Cookie::queue(  Cookie::forget('GI') );
            setcookie('GI', "", time() - (86400 * 30), "/");
            
            $orders = DB::table('order_contents AS oc')->selectRaw('SUM(total_price) as total_price, order_id,
                (Select created_at from orders where id = oc.order_id) as date,
                (Select first_name from users where id = '.Auth::id().') as first_name,
                (Select last_name from users where id = '.Auth::id().') as last_name')
            ->groupBy('order_id')
            ->whereRaw('order_id IN (SELECT id from orders where customer_id = '.Auth::id().')')
            ->limit(2)
            ->orderBy('id', 'desc')
            ->get();
            //echo "<pre>"; print_r($orders); die;

            $account_info = DB::table('users')->select()->where('id', '=', Auth::id())->first();
            $check_subscription = DB::table('subscription')
            ->select()
            ->whereRaw ('email = (SELECT email FROM users WHERE id = "'.Auth::id().'") ')
            ->first(); 
        }
        parent::navFunction();
       

        return view('account_info', ['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
                     'account_info' => $account_info, 'subscription' => $check_subscription, 'nav_links' => $this->navigationData,
                     'orders_detail' => $orders]);
    }

    //Campaigns layout
    public function campaigns($campaign_id){
        setcookie('C-D', "", time() - (86400 * 30), "/");
        //Cookie::queue(  Cookie::forget('PP') );
       //proceed to checkout
       setcookie('PP', "", time() - (86400 * 30), "/");
            if(!Auth::id()){
                if(isset($_COOKIE['GI'])){ 
                }else{
                    $random_token = $this->random_string(50);
                    $insert_token = DB::table('guest_info')->insert([
                        ['session' => $random_token,
                        'guest_ip' => $_SERVER['REMOTE_ADDR']]
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
        $get_brands = DB::table('product_core')->select('product_brand')->orderBy('id', 'desc')->groupBy('product_brand')->limit(3)->get(); 
        $get_colors = DB::table('product_variants')->select('product_color')->groupBy('product_color')->orderBy('id', 'desc')->limit(5)->get(); 

        $core = DB::table('product_core as pc')
            ->selectRaw('id, product_name, product_discount, product_thumbnail')
            ->whereRaw('product_sku IN (Select sku from campaign_products where campaign_id = "'.$campaign_id.'")  AND id IN (Select product_id from product_variants where is_active = 1) AND is_approved = 1')
            ->paginate(6);

        $variants = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_sku IN (Select sku from campaign_products where campaign_id = "'.$campaign_id.'") )')
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

        return view ('campaigns/campaigns', ['cart_detail' => $this->get_cart_items_detail, "brands" => $get_brands, 
                "colors" => $get_colors, 'all_product_cats' => $this->get_all_productCats, 'nav_links' => $this->navigationData,
                'campaign_data' => $products, 'campaign_id' => $campaign_id, 'core' => $core]);

    }

    //Campaigns list layout
    public function campaigns_list($campaign_id){
        setcookie('C-D', "", time() - (86400 * 30), "/");
       // Cookie::queue(  Cookie::forget('PP') );
       //proceed to checkout
        setcookie('PP', "", time() - (86400 * 30), "/");
       if(!Auth::id()){
            if(isset($_COOKIE['GI'])){ 
            }else{
                $random_token = $this->random_string(50);
                $insert_token = DB::table('guest_info')->insert([
                    ['session' => $random_token,
                    'guest_ip' => $_SERVER['REMOTE_ADDR']]
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
        $get_brands = DB::table('product_core')->select('product_brand')->orderBy('id', 'desc')->groupBy('product_brand')->limit(3)->get(); 
        $get_colors = DB::table('product_variants')->select('product_color')->groupBy('product_color')->orderBy('id', 'desc')->limit(5)->get(); 

        $core = DB::table('product_core')
        ->selectRaw('id, product_name, product_discount, product_thumbnail, product_description')
        ->whereRaw('product_sku IN (Select sku from campaign_products where campaign_id = "'.$campaign_id.'") AND id IN (Select product_id from product_variants where is_active = 1) AND is_approved = 1')
        ->paginate(6);

        //echo "<pre>"; print_r($core); die;

        $variants = DB::table('product_variants as pv')
            ->selectRaw('id, product_id, product_sale_price, product_color, product_size,
                (Select AVG(quality) from ratting where product_id = pv.product_id) as ratting')
            ->whereRaw('product_id IN (Select id from product_core where product_sku IN (Select sku from campaign_products where campaign_id = "'.$campaign_id.'") )')
            ->get();

           // echo "<pre>"; print_r($variants); die;

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

        //echo "<pre>"; print_r($products); die;

        return view ('campaigns/campaigns_list', ['cart_detail' => $this->get_cart_items_detail, "brands" => $get_brands, 
                "colors" => $get_colors, 'all_product_cats' => $this->get_all_productCats, 'nav_links' => $this->navigationData,
                'campaign_data' => $products, 'campaign_id' => $campaign_id, 'core' => $core]);


    }

    //Subscribe to newsletter
    public function newsletter(Request $request){
        //echo $request->email;die;
        $check_email = DB::table('subscription')->select()->where('email', '=', $request->email)->first();
        if($check_email){
            return redirect()->back()->with('message', 'Email already exist');
        }else{
            $insert_to_newsletter = DB::table('subscription')->insert([
                ['email' => $request->email]
                ]);
                if($insert_to_newsletter){
                    return redirect()->back()->with('message', 'Subscribed successfully');
                }
        }
        
            
    }

    //Add Review
    public function add_update_review(Request $request){
       //echo $request->product_id; die;
        if(!Auth::id()){
            echo "Please login to add review";
        }else{
            $check_review = DB::table('ratting')
                ->select('id')
                ->whereRaw('user_id = "'.Auth::id().'" AND product_id ='.$request->product_id)
                ->first();
            
            if($check_review){
                echo "Review Exist";
            }else{
               $insert_review = DB::table('ratting')->insert([
                    ['nick_name' => $request->nickname,
                    'summary' => $request->title,
                    'review' => $request->detail,
                    'price' => $request->radio_price,
                    'value' => $request->radio_value,
                    'quality' => $request->radio_quality,
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id]
                ]);
                if($insert_review){
                    return redirect()->back()->with('success', 'Review submited successfully!'); 
                }
            }
        }

    }

    //Update Review
    public function only_update_review(Request $request){
        $update = DB::table('ratting')
            ->whereRaw('user_id = "'.Auth::id().'" AND product_id ='.$request->product_id)
            ->update(['nick_name' => $request->nickname,
                'summary' => $request->title,
                'review' => $request->detail,
                'price' => $request->radio_price,
                'value' => $request->radio_value,
                'quality' => $request->radio_quality,
                'user_id' => Auth::id()]);
        if($update){
            return redirect()->back()->with('update_success', 'Review updated successfully!'); 
        }
    }
}
