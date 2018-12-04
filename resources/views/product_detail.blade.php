@extends('layouts.master')
@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('update_success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('update_success') !!}</li>
        </ul>
    </div>
@endif
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li style="color: black; font-size:11px;">Home <span>/</span>
                    </li>
                    <li style="color: black; font-size:11px;">
                        <?= $categories->main_category ?><span>/ </span> </li>
                    <li style="color: black; font-size:11px;">
                        <?= $categories->sub_category ?> <span>/</span> </li>
                    <li style="color: black; font-size:11px;">
                        <?= $categories->category_name ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->
<?php if($user = Auth::user()){ ?>
<input type="text" value="<?= Auth::id() ?>" name ="user_id" class="user_id" hidden>
<?php }else { ?>
<input type="text" value="guest_user" name ="user_id" class="user_id" hidden>
<?php } 
?>
<div class="container">
        <div class="row">
            <div id="loader">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="lading"></div>
            </div>
        </div>
    </div>
<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-main">
                    <div class="product-view">
                        <div class="product-essential">
                            <form action="#" method="post" id="product_addtocart_form">
                                <input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">
                                <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                                    <div class="new-label new-top-left"> New </div>
                                    <div class="product-image">
                                        <div class="product-full"> <img id="product-zoom" src="
                                        <?= Config::get('constants.options.product_img_host_url').$product_core->product_thumbnail?>
                                        " data-zoom-image="<?= Config::get('constants.options.product_img_host_url').$product_core->product_thumbnail?>"
                                                alt="product-image" />
                                        </div>
                                        <div class="more-views">
                                            <div class="slider-items-products">
                                                <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                                                    <div class="slider-items slider-width-col4 block-content">
                                                        <div class="more-views-items"> <a href="#" data-image="<?= Config::get('constants.options.product_img_host_url').$product_core->product_thumbnail?>"
                                                                data-zoom-image="<?= Config::get('constants.options.product_img_host_url').$product_core->product_thumbnail?>">
                                                                <img id="product-zoom" src="<?= Config::get('constants.options.product_img_host_url').$product_core->product_thumbnail?>"
                                                                    alt="product-image" />
                                                            </a></div>
                                                        <?php 
                                                    if(empty($product_images)){
                                                    }else{
                                                        foreach($product_images as $images){ ?>
                                                        <div class="more-views-items"> <a href="#" data-image="<?= Config::get('constants.options.product_img_host_url').$images->image_url?>"
                                                                data-zoom-image="<?= Config::get('constants.options.product_img_host_url').$images->image_url?>">
                                                                <img id="product-zoom" src="<?= Config::get('constants.options.product_img_host_url').$images->image_url?>"
                                                                    alt="product-image" />
                                                            </a></div>
                                                        <?php }
                                                    }
                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: more-images -->
                                </div>
                                <div class="product-shop col-lg-8 col-sm-7 col-xs-12">
                                    {{-- <div class="product-next-prev"> <a class="product-next" href="#"><span></span></a>
                                        <a class="product-prev" href="#"><span></span></a> </div> --}}
                                    <div class="product-name">
                                        <h1>
                                            <?= $product_core->product_name ?>
                                        </h1>
                                    </div>
                                    <div class="ratings">
                                        <div class="rating-box">
                                                <?php
                                                if($product_core->average_rating == ""){
                                                    echo "0";
                                                }else{ 
                                                    //obtained / total * 100
                                                    $rating = ($product_core->average_rating / 5) * 100;
                                                    ?>
                                                   <div style="width:<?= $rating ?>%" class="rating"></div>
                                                <?php }
                                                ?>
                                        </div>
                                        <p class="rating-links"> <a ><?= $product_core->rate_counts ?> Review(s)</a> </p>
                                    </div>
                                    <div class="price-block">
                                        <div class="price-box">
                                            <p class="special-price"> <span class="price-label">Special Price</span>
                                                <span id="product-price-48" class="price price_special">
                                                    <?php
                                                        if(empty($product_core->product_discount)){
                                                            //echo $availability[0]->product_sale_price;
                                                            if(empty($availability[0]->product_sale_price)){
                                                                echo "Incomplete information of this product";
                                                            }else{
                                                                echo "RS : ".$availability[0]->product_sale_price;
                                                            }
                                                        }else{
                                                            $total_price = $availability[0]->product_sale_price;
                                                            $discount = $total_price - (($product_core->product_discount / 100) * $total_price);
                                                            echo "RS : ".$discount;
                                                        }
                                                    ?>
                                                </span> </p>
                                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span
                                                    class="price price_reqular">
                                                    <?php
                                                    
                                                        if(empty($product_core->product_discount)){
                                                            
                                                        }else{
                                                            echo "RS : ".$availability[0]->product_sale_price;
                                                        }
                                                    ?>
                                                </span> </p>
                                            <?php 
                                            //agar variant aik say ziada hain.
                                            if(sizeof($availability) > 1){
                                                foreach ($availability as $avaiable_items){
                                                    if(empty($avaiable_items->product_quantity)){ ?>
                                                       <p class="availability in-stock pull-right"><span>Out of Stock</span></p>
                                                    <?php }else{ ?>
                                                       <p class="availability in-stock pull-right"><span>In Stock</span></p>
                                                    <?php }
                                                }
                                            }else{
                                                foreach ($availability as $avaiable_items){
                                                if(empty($avaiable_items->product_quantity)){ ?>
                                                   <p class="availability in-stock pull-right"><span>Out of Stock</span></p>
                                               <?php }else{ ?>
                                                    <p class="availability in-stock pull-right"><span>In Stock</span></p>
                                               <?php }
                                            }
                                        }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="short-description">
                                        <h2>Quick Overview</h2>
                                        <span style="display:block;text-overflow: ellipsis; width: 300px; overflow: hidden; white-space: nowrap;">
                                            <?= $product_core->product_description ?>
                                        </span>
                                    </div>
                                    <div class="add-to-box">
                                        <div class="add-to-cart">
                                            <div class="pull-left">
                                                <div class="custom pull-left">
                                                    <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;"
                                                        class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                                                    <input type="text" class="input-text qty" title="Qty" value="1"
                                                        maxlength="12" id="qty" name="qty">
                                                    <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                                        class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                                                </div>
                                            </div>
                                            <?php
                                            if(sizeof($availability) == 1){
                                                 foreach($availability as $variants){ ?>
                                                     <button class="button btn-cart" title="Add to Cart" id="<?= $variants->id ?>"
                                                            type="button">Add to
                                                            Cart</button>
                                                     <?php }
                                            }else{
                                                $id_arr = array();
                                                $counter = 0;
                                                foreach($availability as $variants){
                                                    $id_arr[$counter] = $variants->id;
                                                    $counter++;
                                                 } ?>
                                                  <button class="button btn-cart" title="Add to Cart" id="<?= $id_arr[0] ?>"
                                                        type="button">Add to
                                                        Cart</button>
                                           <?php  }
                                                
                                            ?>
                                           
                                        </div>
                                        <div class="email-addto-box">
                                            <ul class="add-to-links">
                                                    <?php
                                                    if(sizeof($availability) == 1){
                                                         foreach($availability as $variants){ ?>
                                                            <li> <a class="link-wishlist wishlist" id="<?= $variants->id ?>"><span>Add
                                                                to Wishlist</span></a></li>
                                                             <?php }
                                                    }else{
                                                        $id_arr = array();
                                                        $counter = 0;
                                                        foreach($availability as $variants){
                                                            $id_arr[$counter] = $variants->id;
                                                            $counter++;
                                                         } ?>
                                                        <li> <a class="link-wishlist wishlist" id="<?= $id_arr[0] ?>"><span>Add
                                                                to Wishlist</span></a></li>
                                                          
                                                   <?php  }
                                                        
                                                    ?>
                                                    <?php
                                                    if(sizeof($availability) == 1){
                                                        foreach($availability as $variants){ ?>
                                                        <li><span class="separator">|</span> <a class="link-compare compare_product" id = "<?= $variants->id ?>"><span>Add
                                                                to Compare</span></a></li>
                                                            <?php }
                                                    }else{
                                                        $id_arr = array();
                                                        $counter = 0;
                                                        foreach($availability as $variants){
                                                            $id_arr[$counter] = $variants->id;
                                                            $counter++;
                                                        } ?>
                                                        <li><span class="separator">|</span> <a class="link-compare compare_product" id = "<?= $id_arr[0] ?>"><span>Add
                                                                to Compare</span></a></li>
                                                    <?php  }
                                                        
                                                    ?>
                                                
                                                
                                                <li><select class="form-control select_size" >
                                                <?php 
                                                    foreach($availability as $size){ ?>
                                                        <option id = "<?= $size->id ?>" class = "<?= $size->product_sale_price ?>" ><?= $size->product_size ?></option>
                                                    <?php }
                                                ?>
                                                 </select> </li>
                                                
                                            </ul>
                                            <p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p>
                                           
                                        </div>
                                       
                                    </div>
                                    <div class="social">
                                        <ul class="link">
                                            <li class="fb"><a href="#"></a></li>
                                            <li class="tw"><a href="#"></a></li>
                                            <li class="googleplus"><a href="#"></a></li>
                                            <li class="rss"><a href="#"></a></li>
                                            <li class="pintrest"><a href="#"></a></li>
                                            <li class="linkedin"><a href="#"></a></li>
                                            <li class="youtube"><a href="#"></a></li>
                                           
                                        </ul>
                                    </div>
                                    <input hidden type = "text" class = "product_discount_hidden" value = "<?= $product_core->product_discount?>" />
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
                    <div class="add_info">
                        <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                            <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product
                                    Description </a> </li>
                            <li><a href="#product_tabs_tags" data-toggle="tab">Specs</a></li>
                            <li> <a href="#reviews_tabs" data-toggle="tab">Reviews</a> </li>
                        </ul>
                        <div id="productTabContent" class="tab-content">
                            <div class="tab-pane fade in active" id="product_tabs_description">
                                <div class="std">
                                    <p>
                                        <?= $product_core->product_description ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="product_tabs_tags">
                                <div class="box-collateral box-tags">
                                    
                                    <!--tags-->
                                    <?php 
                                        if($specs->isEmpty()){
                                        }else{
                                            foreach($specs as $spec){ ?>
                                                <div class = "row" style = "margin-left:15px;">
                                                    <strong><?= $spec->spec_type ?></strong> : <p><?= $spec->description ?></p>
                                                </div>
                                            <?php }
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews_tabs">
                                <div class="box-collateral box-reviews" id="customer-reviews">
                                    <?php 
                                        if(!Auth::id()){
                                    }else{ ?>
                                         <div class="box-reviews1">
                                                <div class="form-add">
                                                    <?php 
                                                    //print_r($my_rating);
                                                        if(empty($my_rating) || $my_rating->isEmpty()){
                                                            
                                                           //yani app ki koi rating nae hai ?>
                                                        {!! Form::open(['action' => "HomeController@add_update_review"]) !!}
                                                        <?php
                                                        if(empty($availability)){
        
                                                        }else{ 
                                                            foreach($availability as $data){ ?>
                                                            <input name="product_id" value = "<?= $product_core_id ?>" hidden/>
                                                           <?php }
                                                        }
                                                        ?>
                                                       
                                                        <h3>Write Your Own Review</h3>
                                                        <fieldset>
                                                            <h4>How do you rate this product? <em class="required">*</em></h4>
                                                            <span id="input-message-box"></span>
                                                            <table id="product-review-table" class="data-table">
                                                                <thead>
                                                                    <tr class="first last">
                                                                        <th>&nbsp;</th>
                                                                        <th><span class="nobr">1 *</span></th>
                                                                        <th><span class="nobr">2 *</span></th>
                                                                        <th><span class="nobr">3 *</span></th>
                                                                        <th><span class="nobr">4 *</span></th>
                                                                        <th><span class="nobr">5 *</span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="first odd">
                                                                        <th>Price</th>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="1" id="Price_1" name="radio_price"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="2" id="Price_2" name="radio_price"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="3" id="Price_3" name="radio_price"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="4" id="Price_4" name="radio_price"></td>
                                                                        <td class="value last"><input type="radio" class="radio" required
                                                                                value="5" id="Price_5" name="radio_price"></td>
                                                                    </tr>
                                                                    <tr class="even">
                                                                        <th>Value</th>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="1" id="Value_1" name="radio_value"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="2" id="Value_2" name="radio_value"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="3" id="Value_3" name="radio_value"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="4" id="Value_4" name="radio_value"></td>
                                                                        <td class="value last"><input type="radio" class="radio" required
                                                                                value="5" id="Value_5" name="radio_value"></td>
                                                                    </tr>
                                                                    <tr class="last odd">
                                                                        <th>Quality</th>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="1" id="Quality_1" name="radio_quality"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="2" id="Quality_2" name="radio_quality"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="3" id="Quality_3" name="radio_quality"></td>
                                                                        <td class="value"><input type="radio" class="radio" required
                                                                                value="4" id="Quality_4" name="radio_quality"></td> 
                                                                        <td class="value last"><input type="radio" class="radio" required
                                                                                value="5" id="Quality_5" name="radio_quality"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <input type="hidden" class="validate-rating" name="validate_rating">
                                                            <div class="review1">
                                                                <ul class="form-list">
                                                                    <li>
                                                                        <label class="required" for="nickname_field">Nickname<em>*</em></label>
                                                                        <div class="input-box">
                                                                            <input type="text" class="input-text" id="nickname_field" required
                                                                                name="nickname">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <label class="required" for="summary_field">Summary<em>*</em></label>
                                                                        <div class="input-box">
                                                                            <input type="text" class="input-text" id="summary_field" required
                                                                                name="title">
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="review2">
                                                                <ul>
                                                                    <li>
                                                                        <label class="required " for="review_field">Review<em>*</em></label>
                                                                        <div class="input-box">
                                                                            <textarea rows="3" required cols="5" id="review_field" name="detail"></textarea>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <div class="buttons-set">
                                                                    <button class="button submit" title="Submit Review" type="submit"><span>Submit
                                                                            Review</span></button>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
        
                                                        <?php } else{
                                                            //display rating and change submit review TO update review
                                                            foreach($my_rating as $rating){ ?>
                                                            {!! Form::open(['action' => "HomeController@only_update_review"]) !!}
                                                            <?php
                                                            if(empty($availability)){
        
                                                            }else{ 
                                                                foreach($availability as $data){ ?>
                                                                <input name="product_id" value = "<?= $product_core_id ?>" hidden/>
                                                                <?php }
                                                            }
                                                            ?>
                                                            <h3>Write Your Own Review</h3>
                                                            <fieldset>
                                                                <h4>How do you rate this product? <em class="required">*</em></h4>
                                                                <span id="input-message-box"></span>
                                                                <table id="product-review-table" class="data-table">
                                                                    <thead>
                                                                        <tr class="first last">
                                                                            <th>&nbsp;</th>
                                                                            <th><span class="nobr">1 *</span></th>
                                                                            <th><span class="nobr">2 *</span></th>
                                                                            <th><span class="nobr">3 *</span></th>
                                                                            <th><span class="nobr">4 *</span></th>
                                                                            <th><span class="nobr">5 *</span></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="first odd">
                                                                            <th>Price</th>
                                                                            <?php 
                                                                                if($rating->price == 1){ ?>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                        value="1" id="Price_1" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="2" id="Price_2" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="3" id="Price_3" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="4" id="Price_4" name="radio_price"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                        value="5" id="Price_5" name="radio_price"></td>
                                                                                <?php }else if($rating->price == 2){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Price_1" name="radio_price"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="2" id="Price_2" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Price_3" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Price_4" name="radio_price"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Price_5" name="radio_price"></td>
                                                                                <?php }else if($rating->price == 3){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Price_1" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Price_2" name="radio_price"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="3" id="Price_3" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Price_4" name="radio_price"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Price_5" name="radio_price"></td>
                                                                               <?php }else if($rating->price == 4){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Price_1" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Price_2" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Price_3" name="radio_price"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="4" id="Price_4" name="radio_price"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Price_5" name="radio_price"></td>
                                                                               <?php }else if($rating->price == 5){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Price_1" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Price_2" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Price_3" name="radio_price"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Price_4" name="radio_price"></td>
                                                                                    <td class="value last"><input checked type="radio" class="radio" required
                                                                                            value="5" id="Price_5" name="radio_price"></td>
                                                                               <?php }
                                                                            ?>
                                                                            
                                                                        </tr>
                                                                        <tr class="even">
                                                                            <th>Value</th>
                                                                            <?php
                                                                                if($rating->value == 1){ ?>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                        value="1" id="Value_1" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="2" id="Value_2" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="3" id="Value_3" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="4" id="Value_4" name="radio_value"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                        value="5" id="Value_5" name="radio_value"></td>
                                                                                <?php }else if($rating->value == 2){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Value_1" name="radio_value"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="2" id="Value_2" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Value_3" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Value_4" name="radio_value"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Value_5" name="radio_value"></td>
                                                                                <?php }else if($rating->value == 3){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Value_1" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Value_2" name="radio_value"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="3" id="Value_3" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Value_4" name="radio_value"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Value_5" name="radio_value"></td>
                                                                                <?php }else if($rating->value == 4){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Value_1" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Value_2" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Value_3" name="radio_value"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="4" id="Value_4" name="radio_value"></td>
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Value_5" name="radio_value"></td>
                                                                                <?php }else if($rating->value == 5){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Value_1" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Value_2" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Value_3" name="radio_value"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Value_4" name="radio_value"></td>
                                                                                    <td class="value last"><input checked type="radio" class="radio" required
                                                                                            value="5" id="Value_5" name="radio_value"></td>
                                                                               <?php } 
                                                                            ?>
                                                                           
                                                                        </tr>
                                                                        <tr class="last odd">
                                                                            <th>Quality</th>
                                                                            <?php 
                                                                                if($rating->quality == 1 ){ ?>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                        value="1" id="Quality_1" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="2" id="Quality_2" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="3" id="Quality_3" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="4" id="Quality_4" name="radio_quality"></td> 
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                        value="5" id="Quality_5" name="radio_quality"></td>
                                                                                <?php }else if($rating->quality == 2 ){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Quality_1" name="radio_quality"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="2" id="Quality_2" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Quality_3" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Quality_4" name="radio_quality"></td> 
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Quality_5" name="radio_quality"></td>
                                                                                <?php }else if($rating->quality == 3 ){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Quality_1" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Quality_2" name="radio_quality"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="3" id="Quality_3" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Quality_4" name="radio_quality"></td> 
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Quality_5" name="radio_quality"></td>
                                                                                <?php } else if($rating->quality == 4 ){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Quality_1" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Quality_2" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Quality_3" name="radio_quality"></td>
                                                                                    <td class="value"><input checked type="radio" class="radio" required
                                                                                            value="4" id="Quality_4" name="radio_quality"></td> 
                                                                                    <td class="value last"><input type="radio" class="radio" required
                                                                                            value="5" id="Quality_5" name="radio_quality"></td>
                                                                                <?php } else if($rating->quality == 5 ){ ?>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                        value="1" id="Quality_1" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="2" id="Quality_2" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="3" id="Quality_3" name="radio_quality"></td>
                                                                                    <td class="value"><input type="radio" class="radio" required
                                                                                            value="4" id="Quality_4" name="radio_quality"></td> 
                                                                                    <td class="value last"><input checked type="radio" class="radio" required
                                                                                            value="5" id="Quality_5" name="radio_quality"></td>
                                                                                <?php } 
                                                                            ?>
                                                                            
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <input type="hidden" class="validate-rating" name="validate_rating">
                                                                <div class="review1">
                                                                    <ul class="form-list">
                                                                        <li>
                                                                            <label class="required" for="nickname_field">Nickname<em>*</em></label>
                                                                            <div class="input-box">
                                                                                <input type="text" class="input-text" id="nickname_field" required
                                                                                    name="nickname" value = "<?= $rating->nick_name ?>">
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <label class="required" for="summary_field">Summary<em>*</em></label>
                                                                            <div class="input-box">
                                                                                <input type="text" class="input-text" id="summary_field" required
                                                                                    name="title" value = "<?= $rating->summary ?>">
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <div class="review2">
                                                                    <ul>
                                                                        <li>
                                                                            <label class="required " for="review_field">Review<em>*</em></label>
                                                                            <div class="input-box">
                                                                                <textarea rows="3" required cols="5" id="review_field" name="detail" > <?= $rating->review ?> </textarea>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="buttons-set">
                                                                        <button class="button submit" title="Submit Review" type="submit"><span>Update
                                                                                Review</span></button>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            </form>
                                                            <?php }
        
                                                        } 
                                                    ?>
                                                   
                                                </div>
                                            </div>
                                   <?php }
                                     ?>
                                   
                                    <div class="box-reviews2">
                                        <h3>Customer Reviews</h3>
                                        <div class="box visible">
                                            <ul>
                                                <?php
                                                    if($product_reviews->isEmpty()){
                                                        echo "No reviews";
                                                    }else{
                                                        foreach ($product_reviews as $reviews) { ?>
              
                                                <li>
                                                    <table class="ratings-table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Value</th>
                                                                <td>
                                                                    <?php
                                                                        if($reviews->value == 1){ ?>
                                                                        <div class="rating-box">
                                                                                <div class="rating" style="width:20%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->value == 2){ ?>
                                                                            <div class="rating-box">
                                                                                    <div class="rating" style="width:40%;"></div>
                                                                                </div>
                                                                        <?php }else if($reviews->value == 3){ ?>
                                                                            <div class="rating-box">
                                                                                    <div class="rating" style="width:60%;"></div>
                                                                                </div>
                                                                        <?php }else if($reviews->value == 4){ ?>
                                                                            <div class="rating-box">
                                                                                    <div class="rating" style="width:80%;"></div>
                                                                                </div>
                                                                        <?php }else if($reviews->value == 5){ ?>
                                                                            <div class="rating-box">
                                                                                    <div class="rating" style="width:100%;"></div>
                                                                                </div>
                                                                        <?php }
                                                                    ?>
                                                                   
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Quality</th>
                                                                <td>
                                                                    <?php 
                                                                        if($reviews->quality == 1){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:20%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->quality == 2){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:40%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->quality == 3){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:60%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->quality == 4){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:80%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->quality == 5){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div>
                                                                        <?php }
                                                                    ?>
                                                                    
                                                                   
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Price</th>
                                                                <td>
                                                                    <?php 
                                                                        if($reviews->price == 1){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:20%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->price == 2){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:40%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->price == 3){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:60%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->price == 4){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:80%;"></div>
                                                                            </div>
                                                                        <?php }else if($reviews->price == 5){ ?>
                                                                            <div class="rating-box">
                                                                                <div class="rating" style="width:100%;"></div>
                                                                            </div>
                                                                        <?php }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="review">
                                                        <h6><a ><?= $reviews->summary?></a></h6>
                                                        <small>Review by <span><?= $reviews->nick_name?> </span>on <?= $reviews->created_at ?>
                                                        </small>
                                                        <div class="review-txt"> <?= $reviews->review?></div>
                                                    </div>
                                                </li>
                                                <?php }
                                                }    
                                                ?>
                                                {{-- <li class="even">
                                                    <table class="ratings-table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Value</th>
                                                                <td>
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:100%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Quality</th>
                                                                <td>
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:100%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Price</th>
                                                                <td>
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:80%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="review">
                                                        <h6><a href="#/catalog/product/view/id/60/">Amazing</a></h6>
                                                        <small>Review by <span>Sandra Parker</span>on 1/3/2014 </small>
                                                        <div class="review-txt"> Minimalism is the online ! </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <table class="ratings-table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Value</th>
                                                                <td>
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:100%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Quality</th>
                                                                <td>
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:100%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Price</th>
                                                                <td>
                                                                    <div class="rating-box">
                                                                        <div class="rating" style="width:80%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="review">
                                                        <h6><a href="#/catalog/product/view/id/59/">Nicely</a></h6>
                                                        <small>Review by <span>Anthony Lewis</span>on 1/3/2014 </small>
                                                        <div class="review-txt last"> Unbeatable service and selection.
                                                            This store has the best business model I have seen on the
                                                            net. They are true to their word, and go the extra mile for
                                                            their customers. I felt like a purchasing partner more than
                                                            a customer. You have a lifetime client in me. </div>
                                                    </div>
                                                </li> --}}
                                            </ul>
                                        </div>
                                        <div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View
                                                        all</span></span></a> </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main Container End -->
<!-- Related Products Slider -->
<div class="container">
    <!-- Related Slider -->
    <div class="related-pro">
        <div class="slider-items-products">
            <div class="related-block">
                <div id="related-products-slider" class="product-flexslider hidden-buttons">
                    <div class="home-block-inner">
                        <div class="block-title">
                            <h2>Related Products</h2>
                            <div class="hidden-xs hidden-sm">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.</div>
                        </div>
                    </div>
                    <div class="slider-items slider-width-col4 products-grid block-content">
                        <?php 
                            foreach($related_products as $products){ ?>
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $products->id ?>">
                                            <img alt="Retis lapen casen" src="<?= Config::get('constants.options.product_img_host_url').$products->product_thumbnail?>">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                    <li><a class="link-quickview quickViewModal" id = "<?= $products->id?>">Quick View</a>
                                                    </li>
                                                <?php
                                                   if ($products->total_variants == 1){ ?>
                                                        <li><a class="link-wishlist wishlist" id="<?= $products->wishlist_id ?>">Wishlist</a> </li>
                                                   <?php }else{
                                                   }
                                                    ?>
                                                
                                                <li><a class="link-compare compare_product" id = "<?= $products->wishlist_id ?>" >Compare</a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $products->id ?>">
                                                <?= $products->product_name ?> </a> </div>
                                        <div class="rating">
                                            <div class="ratings">
                                                <div class="rating-box">
                                                        <?php
                                                        if($products->average_rating == ""){
                                                            echo "0";
                                                        }else{ 
                                                            //obtained / total * 100
                                                            $rating = ($products->average_rating / 5) * 100;
                                                            ?>
                                                           <div style="width:<?= $rating ?>%" class="rating"></div>
                                                        <?php }
                                                        ?>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="item-price">
                                                    <p class="special-price"> <span class="price-label">Special Price</span>
                                                        <span id="product-price-48" class="price">
                                                            <?php
                                                                if(empty($products->product_discount)){
                                                                    //echo $availability[0]->product_sale_price;
                                                                        echo "RS : ".$products->price;
                                                                    
                                                                }else{
                                                                    $total_price = $products->price;
                                                                    $discount = $total_price - (($products->product_discount / 100) * $total_price);
                                                                    echo "RS : ".$discount;
                                                                }
                                                            ?>
                                                        </span> </p>
                                                    <p class="old-price"> <span class="price-label">Regular Price:</span> <span
                                                            class="price">
                                                            <?php
                                                            
                                                                if(empty($products->product_discount)){
                                                                    
                                                                }else{
                                                                    echo "RS : ".$products->price;
                                                                }
                                                            ?>
                                                        </span> </p>
                                                
                                            </div>
                                            <div class="action">
                                                   
                                                    @if($products->total_variants == 1)
                                                    <button class="button btn-cart" type="button" title=""
                                                        data-original-title="Add to Cart"><span>Add to Cart</span></button>
                                                    @else
                                                    <a class="button btn-quickview quickViewModal" id = "<?= $products->id?>" type="button"
                                                        title="" data-original-title="Add to Cart"><span>Quick View</span></a>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End related products Slider -->
</div>
<!-- Related Products Slider End -->
<!-- Upsell Product Slider -->
<div class="container">
    <!-- upsell Slider -->
    <div class="upsell-pro">
        <div class="slider-items-products">
            <div class="upsell-block">
                <div id="upsell-products-slider" class="product-flexslider hidden-buttons">
                    <div class="home-block-inner">
                        <div class="block-title">
                            <h2>Upsell Product</h2>
                            <div class="hidden-xs hidden-sm">Lorem Ipsum is simply dummy text of the printing and
                                typesetting industry.</div>
                        </div>
                    </div>
                    <div class="slider-items slider-width-col4 products-grid block-content">
                        <div class="item">
                            <div class="item-inner">
                                <div class="item-img">
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product10.jpg">
                                        </a>
                                        <div class="new-label new-top-right">new</div>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare_products">Compare</a> </li>
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
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$245.00</span>
                                                    </span> </div>
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
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product11.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="compare_products">Compare</a> </li>
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
                                                    </span> </div>
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
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product12.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="/compare_products">Compare</a> </li>
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
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$185.00</span>
                                                    </span> </div>
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
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product13.jpg">
                                        </a>
                                        <div class="new-label new-top-left">new</div>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="/compare_products">Compare</a> </li>
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
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$235.00</span>
                                                    </span> </div>
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
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product14.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="/compare_products">Compare</a> </li>
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
                                                    </span> </div>
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
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product16.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="/compare_products">Compare</a> </li>
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
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$335.00</span>
                                                    </span> </div>
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
                                    <div class="item-img-info"> <a class="product-image" title="Retis lapen casen" href="product_detail.html">
                                            <img alt="Retis lapen casen" src="/resources/products-images/product10.jpg">
                                        </a>
                                        <div class="box-hover">
                                            <ul class="add-to-links">
                                                <li><a class="link-quickview" href="quick_view.html">Quick View</a>
                                                </li>
                                                <li><a class="link-wishlist" href="wishlist.html">Wishlist</a> </li>
                                                <li><a class="link-compare" href="/compare_products">Compare</a> </li>
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
                                                <div class="price-box"> <span class="regular-price"> <span class="price">$125.00</span>
                                                    </span> </div>
                                            </div>
                                            <div class="action">
                                                <button class="abc button btn-cart" type="button" title=""
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
    </div>
    <!-- End Upsell  Slider -->
</div>
@endsection