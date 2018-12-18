@extends('layouts.master')

@section('content')

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>

<!-- features box -->
<div class="our-features-box hidden-xs">
    <div class="container">
        <div class="features-block">
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="feature-box first"> <span class="fa fa-truck">&nbsp;</span>
                    <div class="content">
                        <h3>FREE SHIPPING WORLDWIDE</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="feature-box"> <span class="fa fa-headphones">&nbsp;</span>
                    <div class="content">
                        <h3>24X7 CUSTOMER SUPPORT</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="feature-box"> <span class="fa fa-dollar">&nbsp;</span>
                    <div class="content">
                        <h3>MONEY BACK GUARANTEE</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-6">
                <div class="feature-box last"> <span class="fa fa-mobile">&nbsp;</span>
                    <div class="content">
                        <h3>Hotline +(888) 123-4567</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Slider -->
<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
                    <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
                        <ul>

                            <?php 
                            if(!$campaigns->isEmpty()){

                           
                            foreach($campaigns as $campaign){ ?>

                            <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb="
                                    <?= Config::get('constants.options.campaign_img_host_url').$campaign->banner?>
                                        "><img
                                    src="
                                    <?= Config::get('constants.options.campaign_img_host_url').$campaign->banner?>
                                        "
                                    alt="slide-img" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat' />
                                <div class="info">
                                    <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-endspeed='500'
                                        data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none'
                                        data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;white-space:nowrap;'><span>
                                            {{-- Latest Campaigns --}}
                                        </span> </div>
                                     <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-endspeed='500' data-speed='500'
                                        data-start='1300' data-easing='Linear.easeNone' data-splitin='none'
                                        data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;white-space:nowrap;'>
                                        <span>
                                            {{-- Latest Collection --}}
                                            </span> </div>
                                    {{-- <div class='tp-caption Title sft  tp-resizeme ' data-endspeed='500' data-speed='500'
                                        data-start='1450' data-easing='Power2.easeInOut' data-splitin='none'
                                        data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'>In
                                        augue urna, nunc, tincidunt, augue, augue facilisis.</div> --}}
                                    <div class='tp-caption sfb  tp-resizeme ' data-endspeed='500' data-speed='500'
                                        data-start='1500' data-easing='Linear.easeNone' data-splitin='none'
                                        data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;white-space:nowrap;'><a
                                            href='/campaigns/<?= $campaign->id ?>' class="buy-btn"><?= $campaign->button_text ?></a> </div>
                                </div>
                            </li>


                            <?php }
                             }
                                ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3 hot-deal">
                <?php if(empty($hot_deal)){
                    echo "No hot deal";
                }else{
                     ?>

                <ul class="products-grid">
                    <li class="right-space two-height item">
                        <div class="item-inner">
                            <div class="item-img">
                                <div class="item-img-info">

                                    <a href="/product_detail/<?= $hot_deal->id ?>" title="Retis lapen casen" class="product-image">
                                        <img src="
                                        <?= Config::get('constants.options.product_img_host_url').$hot_deal->product_thumbnail?>
                                        "
                                            alt="Retis lapen casen"> </a>
                                    <div class="hot-label hot-top-left">Hot Deal</div>
                                    <div class="box-hover">
                                        <ul class="add-to-links">
                                            <li><a class="link-quickview quickViewModal" id = "<?= $hot_deal->id ?>">Quick View</a> </li>
                                            <li><a class="link-wishlist wishlist" id = "<?= $hot_deal->product_variant_id ?>">Wishlist</a> </li>
                                            <li><a class="link-compare compare_product" id = "<?= $hot_deal->product_variant_id ?>">Compare</a> </li>
                                        </ul>
                                    </div>
                                    <div class="box-timer">
                                        <div class="countbox_1 timer-grid"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-info">
                                <div class="info-inner">
                                    <div class="item-title"> <a href="/product_detail/<?= $hot_deal->id ?>" title="Retis lapen casen">
                                            <?= $hot_deal->product_name ?> </a> </div>
                                    <div class="item-content">
                                        <div class="rating">
                                            <div class="ratings">
                                                <div class="rating-box">
                                                        <?php
                                                        if($hot_deal->average_rating == ""){
                                                            echo "0";
                                                        }else{ 
                                                            //obtained / total * 100
                                                            $rating = ($hot_deal->average_rating / 5) * 100;
                                                            ?>
                                                           <div style="width:<?= $rating ?>%" class="rating"></div>
                                                        <?php }
                                                        ?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="item-price">
                                            <?php 
                                            if (empty($hot_deal->product_discount)){ ?>
                                            <div class="price-box"> <span class="regular-price"> <span class="price">PKR: 
                                                        <?= number_format($hot_deal->product_sale_price) ?></span>
                                                </span>
                                            </div>
                                            <?php }else{
                                                 $total_price = $hot_deal->product_sale_price;
                                                 $discount = $total_price - $hot_deal->product_discount; ?>
                                            <div class="price-box"> <span class="price">PKR: 
                                                    <strike>
                                                        <?= number_format($total_price) ?> </strike>
                                                </span>

                                            </div>
                                            <div class="price-box"> <span class="regular-price"> <span class="price">PKR: 
                                                        <?= number_format($discount) ?></span>
                                                </span>
                                            </div>
                                            <?php }
                                        ?>

                                        </div>
                                        <div class="action">
                                            <a href="/product_detail/<?= $hot_deal->id ?>"><button data-original-title="Add to Cart"
                                                    title="" type="button" class="button btn-cart"><span>Shop
                                                        Now
                                                    </span> </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <?php 
                } ?>

            </div>
        </div>
    </div>
</div>

<!-- end Slider -->

<!-- mob features box -->
<div class="our-features-box hidden-lg hidden-sm hidden-md">
    <div class="container">
        <div class="features-block">
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="feature-box first"> <span class="fa fa-truck"></span>
                    <div class="content">
                        <h3>FREE SHIPPING WORLDWIDE</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="feature-box"> <span class="fa fa-headphones"></span>
                    <div class="content">
                        <h3>24X7 CUSTOMER SUPPORT</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="feature-box"> <span class="fa fa-dollar"></span>
                    <div class="content">
                        <h3>MONEY BACK GUARANTEE</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-12 col-sm-6">
                <div class="feature-box last"> <span class="fa fa-mobile"></span>
                    <div class="content">
                        <h3>Hotline +(888) 123-4567</h3>
                        Lorem ipsum dolor sit amet.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- promotion banner -->
<div class="promotion-banner">
    <div class="container">
        <div class="row">
            <?php
                if(!$top_products->isEmpty()){

                foreach($top_products as $data[]){
                 }
            ?>
          
           <div class="col-lg-4 col-sm-4">
                <a href="/product_detail/<?= $data[0]->product_id ?>"><img width="390px" height="220px" alt="" src="<?= Config::get('constants.options.quickProducts_img_host_url').$data[0]->custom_banner?>"></a>
            </div>
            <div class="col-lg-4 col-sm-4 last">
                <a href="/product_detail/<?= $data[1]->product_id ?>"><img width="390px" height="220px" alt="" src="<?= Config::get('constants.options.quickProducts_img_host_url').$data[1]->custom_banner?>"></a>
            </div>
            <div class="col-lg-4 col-sm-4 last">
                <a href="/product_detail/<?= $data[2]->product_id ?>"><img width="390px" height="220px" alt="" src="<?= Config::get('constants.options.quickProducts_img_host_url').$data[2]->custom_banner?>"></a>
            </div>
        <?php } ?>
        </div>
    </div>
</div>

<!-- New Products  + Tab -->
<div class="content-page">
    <div class="container">
        <!-- featured category -->
        <div class="category-product">
            <div class="navbar nav-menu">
                <div class="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <div class="new_title">
                                <h2>New Products</h2>
                            </div>
                        </li>

                        {{-- <li class="active"><a data-toggle="tab" href="#tab-1">Mobiles</a> </li>
                        <li><a data-toggle="tab" href="#tab-2">Cameras</a> </li>
                        <li><a data-toggle="tab" href="#tab-3">Computer</a> </li>
                        <li><a data-toggle="tab" href="#tab-4">TV & Audio</a> </li>
                        <li><a data-toggle="tab" href="#tab-5">Accessories</a> </li> --}}
                        
                        <?php
                       // print_r(sizeof($custom_cat_1)); die;
                            if(!sizeof($custom_cat_names) == 1){
                                
                            }else{ 
                                $test = array(); 
                                $counter = 0;
                                 
                                foreach ($custom_cat_names as $data) { 
                                    $test[$counter] = $data->category_name;
                                    $counter++;
                                }

                                 if(sizeof($test) == 1){ ?>
                                <li class="active"><a data-toggle="tab" href="#tab-1"><?= $test[0]; ?></a> </li>
                                <?php }else if(sizeof($test) == 2){ ?>
                                    <li class="active"><a data-toggle="tab" href="#tab-1"><?= $test[0]; ?></a> </li>
                                    <li><a data-toggle="tab" href="#tab-2"><?= $test[1]; ?></a> </li>
                                <?php }else if(sizeof($test) == 3){ ?>
                                    <li class="active"><a data-toggle="tab" href="#tab-1"><?= $test[0]; ?></a> </li>
                                    <li><a data-toggle="tab" href="#tab-2"><?= $test[1]; ?></a> </li>
                                    <li><a data-toggle="tab" href="#tab-3"><?= $test[2]; ?></a> </li>
                                <?php }else if(sizeof($test) == 4){ ?>
                                    <li class="active"><a data-toggle="tab" href="#tab-1"><?= $test[0]; ?></a> </li>
                                    <li><a data-toggle="tab" href="#tab-2"><?= $test[1]; ?></a> </li>
                                    <li><a data-toggle="tab" href="#tab-3"><?= $test[2]; ?></a> </li>
                                    <li><a data-toggle="tab" href="#tab-4"><?= $test[3]; ?></a> </li>
                                <?php }
                                
                            }
                             
                        ?>
                        
                        
                       
                        
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                

            </div>
            <div class="product-bestseller">
                <div class="product-bestseller-content">
                    <div class="product-bestseller-list">
                        <div class="tab-container">
                            <!-- tab product -->
                           
                            <div class="tab-panel active" id="tab-1">
                                <div class="category-products">
                                    <ul class="products-grid">
                                            <?php
                               
                                            if(!sizeof($custom_cat_1) == 1 ){
            
                                            }else{
                                                foreach($custom_cat_1 as $product){
                                                    //echo $product->product_id;
                                                 ?>
                                                   <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                                    <div class="item-inner">
                                                                        <div class="item-img">
                                                                            <div class="item-img-info">
                                                                                <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                    <img alt="Retis lapen casen" style = "width:200px; height:300px;"
                                                                                     src="<?= Config::get('constants.options.product_img_host_url').$product->image ?>">
                                                                                </a>
                                                                                <div class="box-hover">
                                                                                    <ul class="add-to-links">
                                                                                        <li><a class="link-quickview quickViewModal" id = "<?= $product->core_id ?>">Quick
                                                                                                View</a> </li>
                                                                                        <li><a class="link-wishlist wishlist" id="<?= $product->id ?>">Wishlist</a>
                                                                                        </li>
                                                                                        <li><a class="link-compare compare_product" id="<?= $product->id ?>">Compare</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-info">
                                                                            <div class="info-inner">
                                                                                <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                       <?= $product->name ?> </a> </div>
                                                                                <div class="item-content">
                                                                                    <div class="rating">
                                                                                        <div class="ratings">
                                                                                            <div class="rating-box">
                                                                                                    <?php
                                                                                                    if($product->ratting == ""){
                                                                                                        echo "0";
                                                                                                    }else{ 
                                                                                                        //obtained / total * 100
                                                                                                        $rating = ($product->ratting / 5) * 100;
                                                                                                        ?>
                                                                                                       <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="item-price">
                                                                                        <div class="price-box"> <span class="regular-price">
                                                                                                <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                                                    <span class="price">
                                                                                                        <?php
                                                                                                        if($product->discount == ""){
                                        
                                                                                                        }else{
                                                                                                            echo "PKR: ".number_format($product->product_sale_price);
                                                                                                        }
                                                                                                            
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                                <p class="special-price"><span class="price-label">Special
                                                                                                        Price</span> <span class="price">
                                                                                                        <?php
                                                                                                                
                                                                                                                    //echo "$".$data->price;
                                                                                                                    if($product->discount == ""){
                                                                                                                        echo "PKR: ".number_format($product->product_sale_price);
                                                                                                                    }else{
                                                                                                                        $total_price = $product->product_sale_price;
                                                                                                                        $discount = $total_price - $product->discount;
                                                                                                                        echo "PKR: ".number_format($discount);
                                                                                                                    }
                                                                                                               
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="action">
                                                                                           
                                                                                            <input class = "qty" type = "text" value = "1" hidden/>
                                                                                            <button class="button btn-cart test" id = "<?= $product->id ?>" type="button" title=""
                                                                                                    data-original-title="Add to Cart"><span>Add to Cart</span></button>
                                                                                           
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                        <?php 
                                                    }
                                             }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="tab-panel" id="tab-2">
                                <div class="category-products">
                                    <ul class="products-grid">
                                            <?php
                               
                                            if(!sizeof($custom_cat_2) == 1){
            
                                            }else{
                                                foreach($custom_cat_2 as $product){
                                                 ?>
                                                             <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                                    <div class="item-inner">
                                                                        <div class="item-img">
                                                                            <div class="item-img-info">
                                                                                <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                    <img alt="Retis lapen casen" style = "width:200px; height:300px;"
                                                                                     src="<?= Config::get('constants.options.product_img_host_url').$product->image ?>">
                                                                                </a>
                                                                                <div class="box-hover">
                                                                                    <ul class="add-to-links">
                                                                                        <li><a class="link-quickview quickViewModal" id = "<?= $product->core_id ?>">Quick
                                                                                                View</a> </li>
                                                                                        <li><a class="link-wishlist wishlist" id="<?= $product->id ?>">Wishlist</a>
                                                                                        </li>
                                                                                        <li><a class="link-compare compare_product" id="<?= $product->id ?>">Compare</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-info">
                                                                            <div class="info-inner">
                                                                                <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                       <?= $product->name ?> </a> </div>
                                                                                <div class="item-content">
                                                                                    <div class="rating">
                                                                                        <div class="ratings">
                                                                                            <div class="rating-box">
                                                                                                    <?php
                                                                                                    if($product->ratting == ""){
                                                                                                        echo "0";
                                                                                                    }else{ 
                                                                                                        //obtained / total * 100
                                                                                                        $rating = ($product->ratting / 5) * 100;
                                                                                                        ?>
                                                                                                       <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="item-price">
                                                                                        <div class="price-box"> <span class="regular-price">
                                                                                                <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                                                    <span class="price">
                                                                                                        <?php
                                                                                                        if($product->discount == ""){
                                        
                                                                                                        }else{
                                                                                                            echo "PKR: ".number_format($product->product_sale_price);
                                                                                                        }
                                                                                                            
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                                <p class="special-price"><span class="price-label">Special
                                                                                                        Price</span> <span class="price">
                                                                                                        <?php
                                                                                                                
                                                                                                                    //echo "$".$data->price;
                                                                                                                    if($product->discount == ""){
                                                                                                                        echo "PKR: ".number_format($product->product_sale_price);
                                                                                                                    }else{
                                                                                                                        $total_price = $product->product_sale_price;
                                                                                                                        $discount = $total_price - $product->discount;
                                                                                                                        echo "PKR: ".number_format($discount);
                                                                                                                    }
                                                                                                               
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="action">
                                                                                           
                                                                                            <input class = "qty" type = "text" value = "1" hidden/>
                                                                                            <button class="button btn-cart test" id = "<?= $product->id ?>" type="button" title=""
                                                                                                    data-original-title="Add to Cart"><span>Add to Cart</span></button>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                        <?php 
                                                    }
                                             }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-panel" id="tab-3">
                                <div class="category-products">
                                    <ul class="products-grid">
                                            <?php
                               
                                            if(!sizeof($custom_cat_3) == 1){
            
                                            }else{
                                                foreach($custom_cat_3 as $product){
                                                    
                                                
                                                 ?>
                                                             <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                                    <div class="item-inner">
                                                                        <div class="item-img">
                                                                            <div class="item-img-info">
                                                                                <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                    <img alt="Retis lapen casen" style = "width:200px; height:300px;"
                                                                                     src="<?= Config::get('constants.options.product_img_host_url').$product->image ?>">
                                                                                </a>
                                                                                <div class="box-hover">
                                                                                    <ul class="add-to-links">
                                                                                        <li><a class="link-quickview quickViewModal" id = "<?= $product->core_id ?>">Quick
                                                                                                View</a> </li>
                                                                                        <li><a class="link-wishlist wishlist" id="<?= $product->id ?>">Wishlist</a>
                                                                                        </li>
                                                                                        <li><a class="link-compare compare_product" id="<?= $product->id ?>">Compare</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-info">
                                                                            <div class="info-inner">
                                                                                <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                       <?= $product->name ?> </a> </div>
                                                                                <div class="item-content">
                                                                                    <div class="rating">
                                                                                        <div class="ratings">
                                                                                            <div class="rating-box">
                                                                                                    <?php
                                                                                                    if($product->ratting == ""){
                                                                                                        echo "0";
                                                                                                    }else{ 
                                                                                                        //obtained / total * 100
                                                                                                        $rating = ($product->ratting / 5) * 100;
                                                                                                        ?>
                                                                                                       <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="item-price">
                                                                                        <div class="price-box"> <span class="regular-price">
                                                                                                <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                                                    <span class="price">
                                                                                                        <?php
                                                                                                        if($product->discount == ""){
                                        
                                                                                                        }else{
                                                                                                            echo "PKR: ".number_format($product->product_sale_price);
                                                                                                        }
                                                                                                            
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                                <p class="special-price"><span class="price-label">Special
                                                                                                        Price</span> <span class="price">
                                                                                                        <?php
                                                                                                                
                                                                                                                    //echo "$".$data->price;
                                                                                                                    if($product->discount == ""){
                                                                                                                        echo "PKR: ".number_format($product->product_sale_price);
                                                                                                                    }else{
                                                                                                                        $total_price = $product->product_sale_price;
                                                                                                                        $discount = $total_price - $product->discount;
                                                                                                                        echo "PKR: ".number_format($discount);
                                                                                                                    }
                                                                                                               
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="action">
                                                                                           
                                                                                            <input class = "qty" type = "text" value = "1" hidden/>
                                                                                            <button class="button btn-cart test" id = "<?= $product->id ?>" type="button" title=""
                                                                                                    data-original-title="Add to Cart"><span>Add to Cart</span></button>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                        <?php 
                                                    }
                                             }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-panel" id="tab-4">
                                <div class="category-products">
                                    <ul class="products-grid">
                                            <?php
                               
                                            if(!sizeof($custom_cat_4) == 1){
            
                                            }else{
                                                foreach($custom_cat_4 as $product){
                                                    
                                                
                                                 ?>
                                                             <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                                    <div class="item-inner">
                                                                        <div class="item-img">
                                                                            <div class="item-img-info">
                                                                                <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                    <img alt="Retis lapen casen" style = "width:200px; height:300px;"
                                                                                     src="<?= Config::get('constants.options.product_img_host_url').$product->image ?>">
                                                                                </a>
                                                                                <div class="box-hover">
                                                                                    <ul class="add-to-links">
                                                                                        <li><a class="link-quickview quickViewModal" id = "<?= $product->core_id ?>">Quick
                                                                                                View</a> </li>
                                                                                        <li><a class="link-wishlist wishlist" id="<?= $product->id ?>">Wishlist</a>
                                                                                        </li>
                                                                                        <li><a class="link-compare compare_product" id="<?= $product->id ?>">Compare</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-info">
                                                                            <div class="info-inner">
                                                                                <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $product->core_id ?>">
                                                                                       <?= $product->name ?> </a> </div>
                                                                                <div class="item-content">
                                                                                    <div class="rating">
                                                                                        <div class="ratings">
                                                                                            <div class="rating-box">
                                                                                                    <?php
                                                                                                    if($product->ratting == ""){
                                                                                                        echo "0";
                                                                                                    }else{ 
                                                                                                        //obtained / total * 100
                                                                                                        $rating = ($product->ratting / 5) * 100;
                                                                                                        ?>
                                                                                                       <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="item-price">
                                                                                        <div class="price-box"> <span class="regular-price">
                                                                                                <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                                                    <span class="price">
                                                                                                        <?php
                                                                                                        if($product->discount == ""){
                                        
                                                                                                        }else{
                                                                                                            echo "PKR: ".number_format($product->product_sale_price);
                                                                                                        }
                                                                                                            
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                                <p class="special-price"><span class="price-label">Special
                                                                                                        Price</span> <span class="price">
                                                                                                        <?php
                                                                                                            if($product->discount == ""){
                                                                                                                echo "PKR: ".number_format($product->product_sale_price);
                                                                                                            }else{
                                                                                                                $total_price = $product->product_sale_price;
                                                                                                                $discount = $total_price - $product->discount;
                                                                                                                echo "PKR: ".number_format($discount);
                                                                                                            }
                                                                                                               
                                                                                                            ?>
                                                                                                    </span> </p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="action">
                                                                                           
                                                                                            <input class = "qty" type = "text" value = "1" hidden/>
                                                                                            <button class="button btn-cart test" id = "<?= $product->id ?>" type="button" title=""
                                                                                                    data-original-title="Add to Cart"><span>Add to Cart</span></button>
                                                                                           
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                        <?php 
                                                    }
                                             }
                                        ?>
                                       
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- bestsell slider -->
<section class="bestsell-pro">
    {{-- <div class="container">
        <div class="slider-items-products">
            <div class="bestsell-block">
                <div id="bestsell-slider" class="product-flexslider hidden-buttons">
                    <div class="home-block-inner">
                        <a href="grid.html"><img src="/resources/images/banner6.jpg" alt="add banner"></a>
                        <div class="banner-content">
                            <div class="banner-text">Cameras</div>
                            <div class="banner-text1">20% off</div>
                            <p>on selected products</p>
                            <a href="#" class="view-bnt">Shop now</a>
                        </div>
                    </div>
                    <div class="block-title">
                        <h2>Best Sellers</h2>
                        <div class="hidden-xs hidden-sm">Lorem Ipsum is simply dummy text of the printing and
                            typesetting industry.</div>
                    </div>
                    <div class="slider-items slider-width-col4 products-grid block-content">
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product6.jpg">
                                        </a>
                                        <div class="new-label new-top-right">new</div>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="rating">
                                            <div class="ratings">
                                                <div class="rating-box">
                                                    <div style="width:80%" class="rating"></div>
                                                </div>
                                                <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                    <a href="#">Add Review</a> </p>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$88.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product7.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div style="width:80%" class="rating"></div>
                                                    </div>
                                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                        <a href="#">Add Review</a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$325.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->

                        <!-- Item -->
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product8.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div style="width:80%" class="rating"></div>
                                                    </div>
                                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                        <a href="#">Add Review</a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$245.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->

                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product9.jpg">
                                        </a>
                                        <div class="new-label new-top-left">new</div>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div style="width:80%" class="rating"></div>
                                                    </div>
                                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                        <a href="#">Add Review</a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$225.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product14.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div style="width:80%" class="rating"></div>
                                                    </div>
                                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                        <a href="#">Add Review</a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$115.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product16.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div style="width:80%" class="rating"></div>
                                                    </div>
                                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                        <a href="#">Add Review</a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$155.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Item -->
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info">
                                        <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product10.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare.html">Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="product_detail.html">
                                                Retis lapen casen </a> </div>
                                        <div class="item-content">
                                            <div class="rating">
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <div style="width:80%" class="rating"></div>
                                                    </div>
                                                    <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span>
                                                        <a href="#">Add Review</a> </p>
                                                </div>
                                            </div>
                                            <div class="item-price">
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$175.00</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="action">
                                                <button class="button btn-cart" type="button" title=""
                                                    data-original-title="Add to Cart"><span>Add to Cart</span> </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->

                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</section>
<!-- End Bestsell Slider -->

<!-- Special Product Slider -->
<section class="new-arrivals-pro">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-12 featured-add-box">
                <?php
                    if(!empty($featured_banner)){ ?>
                        <div class="featured-add-inner">
                            <a href="/product_detail/<?= $featured_banner->id ?>"> <img src="<?= Config::get('constants.options.featured_banner_host_url').$featured_banner->image ?>" alt="f-img"></a>
                            <div class="banner-content">
                                <div class="banner-text"><?= $featured_banner->product_name ?></div>
                                <p>Featured Product</p>
                                <a href="/product_detail/<?= $featured_banner->id ?>" class="view-bnt">Shop now</a>
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
            <div class="col-md-9 col-sm-8 col-xs-12 featured-pro-block">
                <div class="slider-items-products">
                    <div class="new-arrivals-block">
                        <div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
                            <div class="home-block-inner">
                                <div class="block-title">
                                    <h2>Featured Product</h2>
                                </div>
                            </div>
                            <div class="slider-items slider-width-col4 products-grid block-content">

                                <?php
                                    if(empty($featured_products)){

                                    }else{
                                        foreach($featured_products as $products){
                                           ?>
                                                 <div class="item">
                                                        <div class="item-inner">
                                                            <div class="item-img">
                                                                <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $products["id"] ?>">
                                                                        <img alt="Retis lapen casen" style = "width:200px; height:300px;" src="<?= Config::get('constants.options.product_img_host_url').$products["image"] ?>">
                                                                    </a>
                                                                    <div class="box-hover">
                                                                        <ul class="add-to-links">
                                                                                <li><a class="link-quickview quickViewModal" id = "<?= $products["id"] ?>">Quick View</a>
                                                                                </li>
                                                                                <li><a class="link-wishlist wishlist" id="<?php 
                                                                                    if(sizeof($products["variants"]) > 1){
                                                                                        echo $products["variants"][0]["variant_id"];
                                                                                    }else{
                                                                                        foreach($products["variants"] as $variants){
                                                                                        
                                                                                        }
                                                                                        echo $variants["variant_id"];
                                                                                    } ?>">Wishlist</a> 
                                                                                    </li>

                                                                                    <?php if(sizeof($products["variants"]) == 1){ ?>
                                                                                        <li><a class="link-compare compare_product" id="<?php 
                                                                                        
                                                                                            foreach($products["variants"] as $variants){
                                                                                            
                                                                                            }
                                                                                            echo $variants["variant_id"];
                                                                                       ?>" >Compare</a>
                                                                                    </li>
                                                                                    <?php } ?>

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $products["id"] ?>">
                                                                            <?= $products["name"] ?> </a> </div>
                                                                    <div class="rating">
                                                                        <div class="ratings">
                                                                            <div class="rating-box">
                                                                                    <?php
                                                                                        if(sizeof($products["variants"]) > 1){
                                                                                        foreach($products["variants"] as $variants){
                                                                                            if($variants["ratting"] == ""){
                                                                                                echo "0";
                                                                                            }else{
                                                                                            $rating = 
                                                                                            ($variants["ratting"] / 5) * 100; ?>
                                                                                            <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                        <?php }
                                                                                    }                            
                                                                                    }else{
                                                                                        foreach($products["variants"] as $variants){
                                                                                        }
                                                                                    if($variants["ratting"] == ""){
                                                                                        echo "0";
                                                                                    }else{
                                                                                        $rating = ($variants["ratting"] / 5) * 100; ?>
                                                                                        <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                    <?php }
                                                                                    }
                                                                                    ?>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="item-content">
                                                                        <div class="item-price">
                                                                                <p class="special-price"> <span class="price-label">Special Price</span>
                                                                                    <span id="product-price-48" class="price">
                                                                                            <?php
                                                                                            if(sizeof($products["variants"]) == 1){
                                                                                                if($products["discount"] == ""){
                                                                                                    foreach($products["variants"] as $variants){
                                                                                                        echo "PKR: ".number_format($variants["price"]);
                                                                                                    }
                                                                                                }else{
                                                                                                    foreach($products["variants"] as $variants){
                                                                                                        $total_price = $variants["price"];
                                                                                                        $discount = $total_price - $products["discount"];
                                                                                                        echo "PKR: ".number_format($discount);
                                                                                                    }
                                                                                                }
                                                                                            }else{
                                                                                                echo "PKR: 00";
                                                                                            } 
                            
                                                                                                ?>
                                                                                    </span> </p>
                                                                                <p class="old-price"> <span class="price-label">Regular Price:</span> <span
                                                                                        class="price">
                                                                                        <?php
                                                                                            if(sizeof($products["variants"]) == 1){
                                                                                                if($products["discount"] == ""){
                                                                                                }else{
                                                                                                    foreach($products["variants"] as $variants){
                                                                                                    echo "PKR: ".number_format($variants["price"]);
                                                                                                    }
                                                                                                }
                                                                                            }    
                                                                                        ?>
                                                                                    </span> </p>
                                                                            
                                                                        </div>
                                                                        <div class="action">
                                                                            @if(sizeof($products["variants"]) == 1)
                                                                            <input class = "qty" type = "text" value = "1" hidden/>
                                                                            <button class="button btn-cart test" id = "<?php 
                                                                            foreach($products["variants"] as $variants){
                                                                               echo $variants["variant_id"];
                                                                            } ?>" type="button" title=""
                                                                                data-original-title="Add to Cart"><span>Add to Cart</span></button>
                                                                            @else
                                                                            <a class="button btn-quickview quickViewModal" id = "<?= $products["id"] ?>" type="button"
                                                                                title="" data-original-title="Add to Cart"><span>Quick View</span></a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                        
                                    }
                                ?>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Special Product Slider -->

<!-- Testimonials Box Slider -->
<div class="container">
    <div class="row">
        {{-- <div class="col-md-6 col-sm-12 testimonials">
            <div class="ts-testimonial-widget">
                <div class="slider-items-products">
                    <div id="testimonials-slider" class="product-flexslider hidden-buttons home-testimonials">
                        <div class="slider-items slider-width-col4 fadeInUp">
                            <div class="holder">
                                <div class="thumb"> <img src="/resources/images/member1.jpg" alt="testimonials img">
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, Lid est laborum dolo rumes
                                    fugats untras. dolore magna aliquam erat volutpat. Aenean est auctorwisiet urna.
                                    Aliquam erat volutpat.</p>
                                <div class="line"></div>
                                <strong class="name">Saraha Smith</strong>
                            </div>
                            <div class="holder">
                                <div class="thumb"> <img src="/resources/images/member2.jpg" alt="testimonials img">
                                </div>
                                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                                    egestas. Nam sapien nunc, convallis in sollicitudin in, ullamcorper ad eulibero.
                                    Etiam cursus eu ipsum egestas.</p>
                                <div class="line"></div>
                                <strong class="name">Mark doe</strong>
                            </div>
                            <div class="holder">
                                <div class="thumb"> <img src="/resources/images/member3.jpg" alt="testimonials img">
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Duis ac turpis.
                                    Donec sit amet eros.</p>
                                <div class="line"></div>
                                <strong class="name">John Doe</strong>
                            </div>
                            <div class="holder">
                                <div class="thumb"> <img src="/resources/images/member4.jpg" alt="testimonials img">
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad
                                    minim veniam, quis nostrud exerci.</p>
                                <div class="line"></div>
                                <strong class="name">Stephen Doe</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Custom Slider -->
        {{-- <div class="col-md-12 col-sm-12 custom-slider-wrap">
            <div class="custom-slider-inner">
                <div class="home-custom-slider">
                    <div>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active"><img src="/resources/images/custom-slide2.jpg" alt="slide3">
                                    <div class="carousel-caption">
                                        <h3><a title=" Sample Product" href="#">spring <strong>2018</strong></a></h3>
                                        <span>Best Laptop</span> <a class="link" href="#">shop collection</a>
                                    </div>
                                </div>
                                <div class="item"><img src="/resources/images/custom-slide3.jpg" alt="slide2">
                                    <div class="carousel-caption"> <span>Huge <strong>sale</strong></span>
                                        <p>save up to <strong>70% OFF</strong> Electronics collection</p>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                                        <a class="link" href="#">Shop Now</a>
                                    </div>
                                </div>
                                <div class="item"><img src="/resources/images/custom-slide1.jpg" alt="slide1">
                                    <div class="carousel-caption"> <span>New <strong>Arrivals</strong></span>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy
                                            nibh euismod tincidunt ut laoreet.</p>
                                        <a class="link" href="#">View collection</a>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

<!-- Brand Logo -->

<div class="brand-logo">
    <div class="container">
        <div class="slider-items-products">
            <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col6">

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo3.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo1.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo2.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo4.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo5.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo6.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo2.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item">
                        <a href="#"><img src="/resources/images/b-logo4.png" alt="Image"> </a>
                    </div>
                    <!-- End Item -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
