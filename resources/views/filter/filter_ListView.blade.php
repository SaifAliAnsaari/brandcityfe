@extends('layouts.master')

@section('content')

<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>

<!-- Breadcrumbs -->
<div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul>
                            <li style="color: black; font-size:11px;"> Home <span>/</span> </li>
                            <li style="color: black; font-size:11px;">
                                Filter </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
      <!-- Breadcrumbs End --> 
      
      <!-- Main Container -->
      
      <section class="main-container col2-left-layout">
        <div class="container">
          <div class="row">
            <div class="col-sm-9 col-sm-push-3">
              <div class="category-description std">
                <div class="slider-items-products">
                  <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col1 owl-carousel owl-theme"> 
                      
                      <!-- Item -->
                      {{-- <div class="item"> <a href="#"><img alt="" src="/resources/images/category-img1.jpg"></a>
                        <div class="cat-img-title cat-bg cat-box">
                            <div class="small-tag">Big Sale</div>
                            <h2 class="cat-heading">Mobiles Collection</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                    </div> --}}
                    <!-- End Item -->

                    <!-- Item -->
                    {{-- <div class="item"> <a href="#"><img alt="" src="/resources/images/category-img2.jpg"></a>
                        <div class="cat-img-title cat-bg cat-box">
                            <div class="small-tag">Street Style</div>
                            <h2 class="cat-heading">New Season</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
              <article class="col-main">
                <h2 class="page-heading"> <span class="page-heading-title">Smartphones</span> </h2>
                <div class="display-product-option">
                  <div class="pager hidden-xs">
                    <div class="pages">
                      <ul class="pagination">
                            @if ($core->hasPages())
                                    <ul class="pagination pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($core->onFirstPage())
                                            <li class="disabled"><span>«</span></li>
                                        @else
                                            <li><a href="{{ $core->previousPageUrl() }}" rel="prev">«</a></li>
                                        @endif

                                        @if($core->currentPage() > 3)
                                            <li class="hidden-xs"><a href="{{ $core->url(1) }}">1</a></li>
                                        @endif
                                        @if($core->currentPage() > 4)
                                            <li><span>...</span></li>
                                        @endif
                                        @foreach(range(1, $core->lastPage()) as $i)
                                            @if($i >= $core->currentPage() - 2 && $i <= $core->currentPage() + 2)
                                                @if ($i == $core->currentPage())
                                                    <li class="active"><span>{{ $i }}</span></li>
                                                @else
                                                    <li><a href="{{ $core->url($i) }}">{{ $i }}</a></li>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if($core->currentPage() < $core->lastPage() - 3)
                                            <li><span>...</span></li>
                                        @endif
                                        @if($core->currentPage() < $core->lastPage() - 2)
                                            <li class="hidden-xs"><a href="{{ $core->url($core->lastPage()) }}">{{ $core->lastPage() }}</a></li>
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($core->hasMorePages())
                                            <li><a href="{{ $core->nextPageUrl() }}" rel="next">»</a></li>
                                        @else
                                            <li class="disabled"><span>»</span></li>
                                        @endif
                                    </ul>
                                @endif
                      </ul>
                    </div>
                  </div>
                  <div class="sorter">
                        <div class="view-mode"> <a class="button-grid" title="Grid" href="/filter">&nbsp;</a><span class="button-active button-list" title="List">&nbsp;</span> </div>
                      </div>
                </div>
                <div class="category-products">
                  <ol class="products-list" id="products-list">
                    <?php 
                    if(empty($category_data)){
                            //echo "No data found";
                    }else{
                        foreach($category_data as $category_data){ ?>

                    <li class="item first">
                      <div class="product-image"> <a href="/product_detail/<?= $category_data["id"] ?>" title="HTC Rhyme Sense"> 
                        <img class="small-image" src="<?= Config::get('constants.options.product_img_host_url').$category_data["image"] ?>" alt="HTC Rhyme Sense"> </a>
                       {{-- <div class="new-label new-top-left">New</div> --}}
                       </div>
                      <div class="product-shop">
                        <h2 class="product-name"><a href="product_detail.html" title="HTC Rhyme Sense"><?= $category_data["name"] ?></a></h2>
                        <div class="ratings">
                          <div class="rating-box">
                              <?php

                              if(sizeof($category_data["variants"]) > 1){
                                  foreach($category_data["variants"] as $variants){
                                      if($variants["ratting"] == ""){
                                      echo "0";
                                      }else{
                                      $rating = 
                                          ($variants["ratting"] / 5) * 100; ?>
                                      <div style="width:<?= $rating ?>%" class="rating"></div>
                                  <?php }
                                      
                                  }
                                 
                              }else{
                                  foreach($category_data["variants"] as $variants){
                                  
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
                        <div class="desc std">
                          <p><?= $category_data['description'] ?> <a class="link-learn" title="" href="/product_detail/<?= $category_data["id"] ?>">Learn More</a> </p>
                        </div>
                        <div class="price-box">
                                <p class="old-price"><span class="price-label">Regular Price:</span>
                                    <span class="price">
                                        <?php
                                          if(sizeof($category_data["variants"]) == 1){
                                            if($category_data["discount"] == ""){

                                            }else{
                                              foreach($category_data["variants"] as $variants){
                                                echo "PKR: ".number_format($variants["price"]);
                                              }
                                            }
                                          }    
                                        ?>
                                    </span> </p>
                                <p class="special-price"><span class="price-label">Special
                                    Price</span> <span class="price">
                                        <?php
                                        if(sizeof($category_data["variants"]) == 1){
                                            if($category_data["discount"] == ""){
                                                foreach($category_data["variants"] as $variants){
                                                    echo "PKR: ".number_format($variants["price"]);
                                                }
                                            }else{
                                                foreach($category_data["variants"] as $variants){
                                                    $total_price = $variants["price"];
                                                    $discount = $total_price - $category_data["discount"];
                                                    echo "PKR: ".number_format($discount);
                                                }
                                            }
                                        }else{
                                             echo "PKR: 00";
                                        } 
                                        ?>
                                    </span> </p>
                        </div>
                        <div class="actions">
                            @if(sizeof($category_data["variants"]) == 1)
                            <input class = "qty" type = "text" value = "1" hidden/>
                            <button class="button btn-cart test" id = "<?php 
                            foreach($category_data["variants"] as $variants){
                                echo $variants["variant_id"];
                            } ?>" type="button" title=""
                                data-original-title="Add to Cart"><span>Add to Cart</span></button>
                            @else
                            <a class="button btn-quickview quickViewModal" id = "<?= $category_data["id"] ?>" type="button"
                                title="" data-original-title="Add to Cart"><span>Quick View</span></a>
                            @endif
                          <span class="add-to-links"><a title="Add to Compare" class="button link-compare compare_product" id="<?php 
                            if(sizeof($category_data["variants"]) > 1){
                                //echo "greater"; die;
                                foreach($category_data["variants"] as $variants){
                                    
                                }
                                echo $variants["variant_id"];
                            }else{
                                foreach($category_data["variants"] as $variants){
                                   
                                }
                                echo $variants["variant_id"];
                            } ?>"><span>Compare</span></a> </span>
                          <span class="add-to-links"><a title="Add to Wishlist" class="button link-wishlist wishlist" id="<?php 
                            if(sizeof($category_data["variants"]) > 1){
                                //echo "greater"; die;
                                foreach($category_data["variants"] as $variants){
                                    
                                }
                                //echo $variants[0]["variant_id"];
                                echo "test";
                            }else{
                                foreach($category_data["variants"] as $variants){
                                   
                                }
                                echo $variants["variant_id"];
                            } ?>"><span>Add to Wishlist</span></a> </span>
                      </div>
                    </li>

                    <?php }
                        }
                    ?>
                 
                  </ol>
                  <div class="toolbar">
                  <div class="row">
                    <div class="col-lg-3 col-md-4">
                      {{-- <div id="sort-by">
                        <label class="left">Sort By: </label>
                        <ul>
                          <li><a href="#">Position<span class="right-arrow"></span></a>
                            <ul>
                              <li><a href="#">Name</a></li>
                              <li><a href="#">Price</a></li>
                              <li><a href="#">Position</a></li>
                            </ul>
                          </li>
                        </ul>
                      </div> --}}
                    </div>
                    <div class="col-lg-6 col-sm-7 col-md-5">
                      <div class="pager">
                        <div class="pages">
                          <label>Page:</label>
                          <ul class="pagination">
                                @if ($core->hasPages())
                                <ul class="pagination pagination">
                                    {{-- Previous Page Link --}}
                                    @if ($core->onFirstPage())
                                        <li class="disabled"><span>«</span></li>
                                    @else
                                        <li><a href="{{ $core->previousPageUrl() }}" rel="prev">«</a></li>
                                    @endif

                                    @if($core->currentPage() > 3)
                                        <li class="hidden-xs"><a href="{{ $core->url(1) }}">1</a></li>
                                    @endif
                                    @if($core->currentPage() > 4)
                                        <li><span>...</span></li>
                                    @endif
                                    @foreach(range(1, $core->lastPage()) as $i)
                                        @if($i >= $core->currentPage() - 2 && $i <= $core->currentPage() + 2)
                                            @if ($i == $core->currentPage())
                                                <li class="active"><span>{{ $i }}</span></li>
                                            @else
                                                <li><a href="{{ $core->url($i) }}">{{ $i }}</a></li>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if($core->currentPage() < $core->lastPage() - 3)
                                        <li><span>...</span></li>
                                    @endif
                                    @if($core->currentPage() < $core->lastPage() - 2)
                                        <li class="hidden-xs"><a href="{{ $core->url($core->lastPage()) }}">{{ $core->lastPage() }}</a></li>
                                    @endif

                                    {{-- Next Page Link --}}
                                    @if ($core->hasMorePages())
                                        <li><a href="{{ $core->nextPageUrl() }}" rel="next">»</a></li>
                                    @else
                                        <li class="disabled"><span>»</span></li>
                                    @endif
                                </ul>
                            @endif
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-md-3">
                      {{-- <div id="limiter">
                        <label>View: </label>
                        <ul>
                          <li><a href="#">09<span class="right-arrow"></span></a>
                            <ul>
                              <li><a href="#">15</a></li>
                              <li><a href="#">20</a></li>
                              <li><a href="#">30</a></li>
                              <li><a href="#">35</a></li>
                            </ul>
                          </li>
                        </ul>
                        <a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a> 
                        </div> --}}
                    </div>
                  </div>
                </div>
                </div>
              </article>
              <!--	///*///======    End article  ========= //*/// --> 
            </div>
            <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
              <aside class="col-left sidebar">
               
               
                <div class="block block-layered-nav">
                        <div class="block-title">Shop By (All Categories)</div>
                        <div class="block-content">
                            <p class="block-subtitle">Shopping Options</p>
                            <dl id="narrow-by-list">
                                <dt class="odd">Price</dt>
                                <dd class="odd">
                                    <ol>
                                        <li class = "filter_values" id= "price-999.99"> <a ><span class="price">0.00</span> - <span class="price">999.99</span></a>
                                        </li>
                                        <li class = "filter_values" id= "price-1000"> <a ><span class="price">1000.00</span class="price"> and above</a> </li>
                                    </ol>
                                </dd>
                                <dt class="even">Manufacturer</dt>
                                <dd class="even">
                                    <ol>
                                        <?php
                                            if(empty($brands)){
                                                echo "";
                                            }else{
                                            foreach($brands as $brands){ ?>
                                        <li class = "filter_values" id= "brand-<?= $brands->product_brand ?>"> <a >
                                                <?= $brands->product_brand ?></a> </li>
                                        <?php }  }
                                        ?>

                                    </ol>
                                </dd>
                                <dt class="odd">Color</dt>
                                <dd class="odd">
                                    <ol>
                                        <?php
                                            if(empty($colors)){
                                                echo "";
                                            }else{
                                            foreach($colors as $color){ ?>
                                        <li class = "filter_values" id= "color-<?= $color->product_color ?>"> <a >
                                                <?= $color->product_color ?></a> </li>
                                        <?php } }
                                        ?>

                                    </ol>
                                </dd>
                                <dt class="last even">Discount</dt>
                                <dd class="last even">
                                    <ol>
                                        <li class = "filter_values" id= "discount-10"> <a >10% off</a> </li>
                                        <li class = "filter_values" id= "discount-20"> <a >20% off</a> </li>
                                        <li class = "filter_values" id= "discount-30"> <a >30% off</a> </li>
                                    </ol>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="block block-cart">
                            <div class="block-title ">My Cart</div>
                            <div class="block-content">
                                <div class="summary">
                                    <?php if(empty($cart_detail)){ ?>
                                    <p class="amount">There are <a href="shopping_cart.html">0 items</a> in your cart.</p>
                                    <?php }else{ ?>
                                    <p class="amount">There are <a href="shopping_cart.html">
                                            <?=  count($cart_detail); ?> items</a> in your cart.</p>
                                    <?php } 
                                   ?>
    
                                </div>
                                <div class="ajax-checkout">
                                    <a href="/checkout"> <button class="button button-checkout" title="checkout" type="button"><span>Checkout</span></button></a>
                                </div>
    
                                <p class="block-subtitle">Recently added item(s) </p>
                                <ul>
                                    <?php if(empty($cart_detail)){
                                            echo "Empty Cart";
                                        }else{
                                            //echo "<pre>"; print_r($cart_detail); die;
                                            foreach($cart_detail as $detail){  ?>
    
                                    <li class="item"> <a href="/product_detail/<?= $detail->product_core_id ?>" title="Fisher-Price Bubble Mower"
                                            class="product-image"><img src="<?= Config::get('constants.options.product_img_host_url').$detail->product_thumbnail?>"
                                                alt="Fisher-Price Bubble Mower"></a>
                                        <div class="product-details">
                                            <div class="access"> <a href="/cart" title="Remove This Item" class="btn-remove1">
                                                    <span class="icon"></span> Remove </a> </div>
                                            <strong><?= $detail->quantity ?></strong> x <span class="price">RS : <?= $detail->product_sale_price ?></span>
                                            <p class="product-name"> <a href="/cart">
                                                    <?= $detail->product_name ?></a> </p>
                                        </div>
                                    </li>
    
                                    <?php } }?>
                                   
                                </ul>
                            </div>
                        </div>
              
                    {{-- <div class="custom-slider">
                        <div>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#carousel-example-generic" data-slide-to="0"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="item active"><img src="/resources/images/slide3.jpg" alt="slide3">
                                        <div class="carousel-caption">
                                            <h3><a title=" Sample Product" href="#">50% OFF</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <a class="link" href="#">Buy Now</a>
                                        </div>
                                    </div>
                                    <div class="item"><img src="/resources/images/slide1.jpg" alt="slide1">
                                        <div class="carousel-caption">
                                            <h3><a title=" Sample Product" href="#">Hot collection</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                    <div class="item"><img src="/resources/images/slide2.jpg" alt="slide2">
                                        <div class="carousel-caption">
                                            <h3><a title=" Sample Product" href="#">Summer collection</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only">Previous</span>
                                </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
               
                 {{-- <div class="hot-banner"><img alt="banner" src="/resources/images/hot-trends-banner.jpg"></div> --}}
              
              </aside>
            </div>
          </div>
        </div>
      </section>
      <!-- Main Container End -->

      @endsection