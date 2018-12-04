@extends('layouts.master')

@section('content')

<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>
    


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
                                <div class="item"> <a href="#"><img alt="" src="/resources/images/category-img1.jpg"></a>
                                    <div class="cat-img-title cat-bg cat-box">
                                        <div class="small-tag">Big Sale</div>
                                        <h2 class="cat-heading">Mobiles Collection</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                    </div>
                                </div>
                                <!-- End Item -->

                                <!-- Item -->
                                <div class="item"> <a href="#"><img alt="" src="/resources/images/category-img2.jpg"></a>
                                    <div class="cat-img-title cat-bg cat-box">
                                        <div class="small-tag">Street Style</div>
                                        <h2 class="cat-heading">New Season</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                    </div>
                                    <!-- End Item -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <article class="col-main" style = "width:100%;">
                    <h2 class="page-heading"> <span class="page-heading-title">Filter</span> </h2>
                    <div class="display-product-option">
                        <div class="pager hidden-xs">
                            <div class="pages">
                                <ul class="pagination">
                                 
                                    @if ($campaign_data->hasPages())
                                        <ul class="pagination pagination">
                                            {{-- Previous Page Link --}}
                                            @if ($campaign_data->onFirstPage())
                                                <li class="disabled"><span>«</span></li>
                                            @else
                                                <li><a href="{{ $campaign_data->previousPageUrl() }}" rel="prev">«</a></li>
                                            @endif
    
                                            @if($campaign_data->currentPage() > 3)
                                                <li class="hidden-xs"><a href="{{ $campaign_data->url(1) }}">1</a></li>
                                            @endif
                                            @if($campaign_data->currentPage() > 4)
                                                <li><span>...</span></li>
                                            @endif
                                            @foreach(range(1, $campaign_data->lastPage()) as $i)
                                                @if($i >= $campaign_data->currentPage() - 2 && $i <= $campaign_data->currentPage() + 2)
                                                    @if ($i == $campaign_data->currentPage())
                                                        <li class="active"><span>{{ $i }}</span></li>
                                                    @else
                                                        <li><a href="{{ $campaign_data->url($i) }}">{{ $i }}</a></li>
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if($campaign_data->currentPage() < $campaign_data->lastPage() - 3)
                                                <li><span>...</span></li>
                                            @endif
                                            @if($campaign_data->currentPage() < $campaign_data->lastPage() - 2)
                                                <li class="hidden-xs"><a href="{{ $campaign_data->url($campaign_data->lastPage()) }}">{{ $campaign_data->lastPage() }}</a></li>
                                            @endif
    
                                            {{-- Next Page Link --}}
                                            @if ($campaign_data->hasMorePages())
                                                <li><a href="{{ $campaign_data->nextPageUrl() }}" rel="next">»</a></li>
                                            @else
                                                <li class="disabled"><span>»</span></li>
                                            @endif
                                        </ul>
                                    @endif

                                </ul>
                            </div>
                        </div>
                        <div class="sorter">
                            <div class="view-mode"> <span title="Grid" class="button button-active button-grid">&nbsp;</span><a
                                    href="list.html" title="List" class="button-list">&nbsp;</a> </div>
                        </div>
                    </div>
                    <div class="category-products">
                        <ul class="products-grid">

                            <ul class="products-grid">

                                <?php 
                                    if($campaign_data->isEmpty()){
                                        echo "No data found";
                                    }else{
                                        foreach($campaign_data as $data){
                                            if(empty($data->image) && empty($data->name)){

                                            }else{ ?>
    
    
                                <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="item-inner">
                                        <div class="item-img">
                                            <div class="item-img-info"><a href="/product_detail/<?= $data->id ?>" title="Retis lapen casen"
                                                    class="product-image"><img src="
                                            <?= Config::get('constants.options.product_img_host_url').$data->image?>
                                            "
                                                        alt="Retis lapen casen"></a>
                                                <div class="new-label new-top-left">New</div>
                                                <div class="box-hover">
                                                    <ul class="add-to-links">
                                                        <li><a class="link-quickview quickViewModal" id = "<?= $data->id?>">Quick View</a>
                                                        </li>
                                                        <li><a class="link-wishlist wishlist" id="<?= $data->product_id ?>">Wishlist</a> </li>
                                                        <li><a class="link-compare compare_product" id="<?= $data->product_id ?>">Compare</a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <div class="info-inner">
                                                <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $data->id ?>">
                                                        <?= $data->name ?> </a> </div>
                                                <div class="item-content">
                                                    <div class="rating">
                                                        <div class="ratings">
                                                            <div class="rating-box">
                                                                    <?php
                                                                    if($data->average_rating == ""){
                                                                        echo "0";
                                                                    }else{ 
                                                                        //obtained / total * 100
                                                                        $rating = ($data->average_rating / 5) * 100;
                                                                        ?>
                                                                       <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                    <?php }
                                                                    ?>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="item-price">
                                                        <div class="price-box">
                                                            <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                <span class="price">
                                                                    <?php
                                                                    if($data->total_variants == 1){
                                                                    if($data->discount == ""){
    
                                                                    }else{
                                                                        echo "RS : ".$data->price;
                                                                    }
                                                                }
                                                                            
                                                                        ?>
                                                                </span> </p>
                                                            <p class="special-price"><span class="price-label">Special
                                                                    Price</span> <span class="price">
                                                                    <?php
                                                                            if($data->total_variants == 1){
                                                                                //echo "$".$data->price;
                                                                                if($data->discount == ""){
                                                                                    echo "RS : ".$data->price;
                                                                                }else{
                                                                                    $total_price = $data->price;
                                                                                    $discount = $total_price - (($data->discount / 100) * $total_price);
                                                                                    echo "RS : ".$discount;
                                                                                }
                                                                            }else{
                                                                                echo "RS : 00";
                                                                            }
                                                                        ?>
                                                                </span> </p>
                                                        </div>
                                                    </div>
                                                    <div class="action">
                                                        @if($data->total_variants == 1)
                                                        <input class = "qty" type = "text" value = "1" hidden/>
                                                        <button class="button btn-cart test" id = "<?= $data->product_id ?>" type="button" title=""
                                                            data-original-title="Add to Cart"><span>Add to Cart</span></button>
                                                        @else
                                                        <a  class="button btn-quickview quickViewModal" id = "<?= $data->id?>" type="button"
                                                            title="" data-original-title="Add to Cart"><span>Quick View</span></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
    
                                <?php }
                                    }
                                }
                                ?>
    
    
                            </ul>

                        </ul>
                    </div>
                    <div class="toolbar">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div id="sort-by">
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
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-7 col-md-5">
                                <div class="pager">
                                    <div class="pages">
                                        <label>Page:</label>
                                        <ul class="pagination">
                                                @if ($campaign_data->hasPages())
                                                <ul class="pagination pagination">
                                                    {{-- Previous Page Link --}}
                                                    @if ($campaign_data->onFirstPage())
                                                        <li class="disabled"><span>«</span></li>
                                                    @else
                                                        <li><a href="{{ $campaign_data->previousPageUrl() }}" rel="prev">«</a></li>
                                                    @endif
            
                                                    @if($campaign_data->currentPage() > 3)
                                                        <li class="hidden-xs"><a href="{{ $campaign_data->url(1) }}">1</a></li>
                                                    @endif
                                                    @if($campaign_data->currentPage() > 4)
                                                        <li><span>...</span></li>
                                                    @endif
                                                    @foreach(range(1, $campaign_data->lastPage()) as $i)
                                                        @if($i >= $campaign_data->currentPage() - 2 && $i <= $campaign_data->currentPage() + 2)
                                                            @if ($i == $campaign_data->currentPage())
                                                                <li class="active"><span>{{ $i }}</span></li>
                                                            @else
                                                                <li><a href="{{ $campaign_data->url($i) }}">{{ $i }}</a></li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if($campaign_data->currentPage() < $campaign_data->lastPage() - 3)
                                                        <li><span>...</span></li>
                                                    @endif
                                                    @if($campaign_data->currentPage() < $campaign_data->lastPage() - 2)
                                                        <li class="hidden-xs"><a href="{{ $campaign_data->url($campaign_data->lastPage()) }}">{{ $campaign_data->lastPage() }}</a></li>
                                                    @endif
            
                                                    {{-- Next Page Link --}}
                                                    @if ($campaign_data->hasMorePages())
                                                        <li><a href="{{ $campaign_data->nextPageUrl() }}" rel="next">»</a></li>
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
                                <div id="limiter">
                                    <label>View: </label>
                                    <ul>
                                        <li><a href="#">18<span class="right-arrow"></span></a>
                                            <ul>
                                                <li><a href="#">20</a></li>
                                                <li><a href="#">25</a></li>
                                                <li><a href="#">30</a></li>
                                                <li><a href="#">35</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                <aside class="col-left sidebar">
                    <div class="side-nav-categories">
                        <div class="block-title"> Categories </div>
                        <!--block-title-->
                        <!-- BEGIN BOX-CATEGORY -->
                        <div class="box-content box-category">
                            
                                <ul>
                                    @foreach ($nav_links as $nav)
                                    <li> <a class="active" >{{ $nav["name"] }}</a> <span class="subDropdown minus"></span> 
                                        <ul class="level0_415" style="display:block">
                                            @foreach ($nav["sub_category"] as $sub)
                                            <li> <a > {{ $sub["name"] }} </a> <span class="subDropdown plus"></span>
                                                <ul class="level1" style="display:none">
                                                    @foreach ($sub["product_categories"] as $prod)
                                                    <li> <a href="/category/<?= $prod["name"] ?>"> {{ $prod["name"] }} </a> </li>
                                                    
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                               
                            </div>
                        <!--box-content box-category-->
                    </div>
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
                   
                    <div class="custom-slider">
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
                    </div>
                    <div class="block block-list block-viewed">
                        <div class="block-title"> Recently Viewed </div>
                        <div class="block-content">
                            <ol id="recently-viewed-items">
                                <li class="item odd">
                                    <p class="product-name"><a href="#"> Armchair with Box-Edge Upholstered Arm</a></p>
                                </li>
                                <li class="item even">
                                    <p class="product-name"><a href="#"> Pearce Upholstered Slee pere</a></p>
                                </li>
                                <li class="item last odd">
                                    <p class="product-name"><a href="#"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a></p>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="block block-poll">
                        <div class="block-title">Community Poll </div>
                        <form id="pollForm" action="#" method="post" onSubmit="return validatePollAnswerIsSelected();">
                            <div class="block-content">
                                <p class="block-subtitle">What is your favorite Magento feature?</p>
                                <ul id="poll-answers">
                                    <li class="odd">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_5" value="5">
                                        <span class="label">
                                            <label for="vote_5">Layered Navigation</label>
                                        </span> </li>
                                    <li class="even">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_6" value="6">
                                        <span class="label">
                                            <label for="vote_6">Price Rules</label>
                                        </span> </li>
                                    <li class="odd">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_7" value="7">
                                        <span class="label">
                                            <label for="vote_7">Category Management</label>
                                        </span> </li>
                                    <li class="last even">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_8" value="8">
                                        <span class="label">
                                            <label for="vote_8">Compare Products</label>
                                        </span> </li>
                                </ul>
                                <div class="actions">
                                    <button type="submit" title="Vote" class="button button-vote"><span>Vote</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="hot-banner"><img alt="banner" src="/resources/images/hot-trends-banner.jpg"></div>
                    <div class="block block-tags">
                        <div class="block-title"> Popular Tags</div>
                        <div class="block-content">
                            <ul class="tags-list">
                                <li><a href="#" style="font-size:98.3333333333%;">Camera</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">Hohoho</a></li>
                                <li><a href="#" style="font-size:145%;">SEXY</a></li>
                                <li><a href="#" style="font-size:75%;">Tag</a></li>
                                <li><a href="#" style="font-size:110%;">Test</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">bones</a></li>
                                <li><a href="#" style="font-size:110%;">cool</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">cool t-shirt</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">crap</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">good</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">green</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">hip</a></li>
                                <li><a href="#" style="font-size:75%;">laptop</a></li>
                                <li><a href="#" style="font-size:75%;">mobile</a></li>
                                <li><a href="#" style="font-size:75%;">nice</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">phone</a></li>
                                <li><a href="#" style="font-size:98.3333333333%;">red</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">tight</a></li>
                                <li><a href="#" style="font-size:75%;">trendy</a></li>
                                <li><a href="#" style="font-size:86.6666666667%;">young</a></li>
                            </ul>
                            <div class="actions"> <a href="#" class="view-all">View All Tags</a> </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
<!-- Main Container End -->

@endsection
