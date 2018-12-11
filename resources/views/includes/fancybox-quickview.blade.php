<div style="background-color: rgb(119, 119, 119); opacity: 0.7; cursor: pointer; height: 1024px; display: none" id="fancybox-overlay">
</div>
<div style="width: 1190px; position: fixed; height: auto; top: 20%; left: 25%; display: none" id="fancybox-wrap">
    <div id="fancybox-outer">
        <div style="border-width: 10px; width: 1170px; height: auto;" id="fancybox-content">
            <div style="width:auto;height:auto;overflow: auto;position:relative;">
                <div class="product-view">
                    <div class="product-essential">
                        <form action="#" method="post" id="product_addtocart_form">
                            <input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">
                            <div class="product-img-box col-lg-5 col-sm-5 col-xs-12">
                                <div class="new-label new-top-left"> New </div>
                                <div class="product-image">
                                    <input type="text" id="hostUrl" value="{{ Config::get('constants.options.product_img_host_url') }}" hidden>
                                    <div class="product-full"> 
                                        <img class="fancy_box_image" id="product-zoom" src="/resources/products-images/product1.jpg"
                                             alt="product-image" />
                                    </div>
                                    <div class="more-views">
                                        <div class="slider-items-products">
                                            <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                                                <div class="slider-items slider-width-col4 block-content">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end: more-images -->
                            </div>
                            <div class="product-shop col-lg-7 col-sm-7 col-xs-12">
                                <div class="product-name">
                                    <h1 class="fancy_box_product_name">Wholesale Charming Blouse</h1>
                                </div>
                                <div class="ratings">
                                    <div class="rating-box">
                                        <div style="width:60%" class="rating fancy_box_rating"></div>
                                    </div>
                                    <p class="rating-links"> <a class="rate_counts">1 Review(s)</a> </p>
                                </div>
                                <div class="price-block">
                                    <div class="price-box">
                                        <p class="special-price"> <span class="price-label">Special Price</span> <span
                                                 class="price price_special">  </span> </p>
                                        <p class="old-price"> <span class="price-label">Regular Price:</span> <span
                                                class="price price_reqular">  </span> </p>
                                                
                                        <p class="availability in-stock pull-right" id="outOfStockFancy" style="display: none"><span style="background: red; font-weight: bold">Out of Stock</span></p>

                                        <p class="availability in-stock pull-right" id="inStockFancy"><span class = "fancybox_availability">In Stock</span></p>
                                    </div>
                                </div>
                                <div class="short-description">
                                    <h2>Quick Overview</h2>
                                    <p class = "fancy_box_description"> </p>
                                </div>
                                <div class="add-to-box">
                                    <div class="add-to-cart">
                                        <div class="pull-left">
                                            <div class="custom pull-left">
                                                <input hidden class = "product_discount_hidden" type = "text"  />
                                                <input class = "qty" type = "text" value = "1" hidden/>
                                                {{-- <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;"
                                                    class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                                                <input type="text" class="input-text qty" title="Qty" value="1"
                                                    maxlength="12" id="qty" name="qty">
                                                <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;"
                                                    class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button> --}}
                                            </div>
                                        </div>
                                        <button id="addToCartBtn" class="button btn-cart fancybox_cart_button"
                                            title="Add to Cart" type="button">
                                            <span id="addToCartText">Add to Cart</span>
                                        </button>
                                    </div>
                                    <div class="email-addto-box">
                                        <ul class="add-to-links">
                                            <li> <a class="link-wishlist wishlist" id = ""><span>Add to Wishlist</span></a></li>
                                            <li><span class="separator">|</span> <a class="link-compare compare_product" id = ""><span>Add
                                                        to Compare</span></a></li>
                                            <li><select class="form-control select_size" >
                                                {{-- <option id = "1" class = "price" >size</option> --}}
                                            </select> </li>
                                        </ul>
                                        <p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--product-view-->

            </div>
        </div>
        <a style="display: inline;" id="fancybox-close"></a>
    </div>
</div>
