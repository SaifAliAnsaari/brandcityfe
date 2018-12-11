<nav>
    <div class="container">
        <div>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 hidden-xs nav-icon">
                <div class="mega-container visible-lg visible-md visible-sm">
                    <div class="navleft-container">
                        <div class="mega-menu-title">
                            <h3><i class="fa fa-navicon"></i> All Categories</h3>
                        </div>
                        <div class="mega-menu-category">
                            <ul class="nav"> 
                                <li class="nosub "> <a href="/"><i class="fa fa-home"></i> Home</a> </li>

                                {{-- @if(Auth::id()) --}}
                                
                                @foreach ($nav_links as $nav)
                               
                                <li> <a ><i class="fa fa-mobile-phone"></i> {{ $nav["name"] }}</a>
                                    <div class="wrap-popup">
                                        <div class="popup">
                                            <div class="row">
                                                
                                                <?php 
                                                    $total_sub = count($nav["sub_category"]);
                                                    $sub_printable = $total_sub/2;
                                                    ceil($sub_printable);
                                                      ?>
                                                        <div class="col-md-4 col-sm-6">
                                                            <?php  $counter = 0;
                                                            for($i=0; $i<$sub_printable; $i++){ ?>
                                                                <a > <?= $nav["sub_category"][$i]['name'] ?> </a>
                                                                <ul class="nav">

                                                                    <?php 
                                                                        foreach($nav["sub_category"][$i]["product_categories"] as $pro){ ?>
                                                                        <li> <a href="/category/<?= $pro["name"] ?>"><span>{{ $pro['name'] }}</span></a>
                                                                        </li>
                                                                       <?php }
                                                                    ?>
                                                                        
                                                                </ul>
                                                                <br>
                                                                <?php $counter++;
                                                             } ?>
                                                            </div>
                                                       
                                                        <div class="col-md-4 col-sm-6">
                                                            <?php 
                                                            for($j = $counter; $j < $counter+2; $j++){ 
                                                                if(isset($nav["sub_category"][$j]['name'])){?>
                                                                <a> <?= $nav["sub_category"][$j]['name'] ?> </a>
                                                                <ul class="nav">
                                                                    <?php 
                                                                        foreach($nav["sub_category"][$j]["product_categories"] as $pro){ ?>
                                                                        <li> <a href="/category/<?= $pro["name"] ?>"><span>{{ $pro['name'] }}</span></a>
                                                                        </li>
                                                                    <?php }
                                                                    ?>
                                                                </ul>
                                                                <br>
                                                                <?php }
                                                            } ?>
                                                            </div>

                                                
                                                <div class="col-md-4 has-sep hidden-sm">
                                                    <div class="custom-menu-right">
                                                        <div class="box-banner media">
                                                            <div class="add-right">
                                                                <a ><img alt="menu image" src="{{ Config::get('constants.options.category_img_host_url').$nav["image"] }}"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                @endforeach

                                {{-- @endif --}}
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-5 col-sm-5 col-xs-3 hidden-xs category-search-form">
                <div class="search-box">
                    {{-- <form id="search_mini_form" action="#" method="get"> --}}
                        {!! Form::open(['action' => "SearchController@search_items"]) !!}
                        <select name="cat" id="cat" class="cate-dropdown hidden-sm hidden-md">
                              
                            <?php
                            // if(Auth::id() != Null){
                                foreach($all_product_cats as $categories){ ?>
                                    <option value="<?= $categories->id ?>"><?= $categories->category_name ?></option>
                                <?php }
                            // }else{
                            //    // echo "a"; user is logged out
                            // } 
                            ?>

                        </select>
                        <!-- Autocomplete End code -->
                        <input id="search" type="text" name="search_dropdown" placeholder="Search product here..." class="searchbox search_dropdown"
                            maxlength="128">
                        <button type="submit" title="Search" class="search-btn-bg" id="submit-button"><span>Search</span></button>
                        <div class ="row col-md-5"> </div>
                        <div class ="row col-md-7 search_dropdown_list"> </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 card_wishlist_area">
                <div class="mm-toggle-wrap">
                    <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
                </div>
                <div class="top-cart-contain">
                    <!-- Top Cart -->
                    <div class="mini-cart">
                        <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"> <a href="/cart"><span
                                    class="price">My Cart</span> <span class="cart_count">
                                    <?php if(empty($cart_detail)){

                                    }else{
                                        echo count($cart_detail);
                                        } ?></span>
                            </a>
                        </div>
                        @if(count($cart_detail) > 0)
                        <div class="top-cart-content">
                            <!--block-subtitle-->
                            <ul class="mini-products-list" id="cart-sidebar">
                                <?php foreach($cart_detail as $detail){  ?>
                                        <li class="item first">
                                            <div class="item-inner">
                                                <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $detail->product_core_id ?>"><img alt="Retis lapen casen"
                                                        src=" <?= Config::get('constants.options.product_img_host_url').$detail->product_thumbnail?>">
                                                </a>
                                                <div class="product-details">
                                                    <div class="access"><a class="btn-remove1 remove_item" id="<?= $detail->id; ?>" title="Remove This Item" >Remove</a> <a class="btn-edit" title="Edit item" href="#"><i
                                                                class="icon-pencil"></i><span class="hidden">Edit item</span></a>
                                                    </div>
                                                    <span class="price">RS : <?php
                                                    if($detail->product_discount == "") {
                                                        echo $detail->product_sale_price;
                                                    }else{
                                                        $total_price = $detail->product_sale_price;
                                                        $discount = $total_price - (($detail->product_discount / 100) * $total_price);
                                                        echo $discount;
                                                    } ?></span>
                                                    <p class="product-name"><a href="/product_detail/<?= $detail->product_core_id ?>">
                                                            <?= $detail->product_name ?></a> </p>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                            </ul>
                            <!--actions-->
                            <div class="actions" style="">
                                {{-- <button class="btn-checkout" title="Checkout" type="button" onclick="window.location.href='/checkout'"><span>Checkout</span>
                                </button> --}}
                                <a href="/cart" class="view-cart"><span>View Cart</span></a> </div>
                        </div>
                        @endif
                    </div>
                    <!-- Top Cart -->
                </div>
                <!-- mgk wishlist -->
                <div class="mgk-wishlist"><a title="My Wishlist" href="/wishlist"><i class="fa fa-heart"></i><span
                            class="title-wishlist hidden-xs">Wishlist</span></a></div>
            </div>
        </div>
    </div>
</nav>
