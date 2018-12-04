@extends('layouts.master')

@section('content')
<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9">
                <div class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>My Wishlist</h2>
                        </div>
                        <div class="my-wishlist">
                            <div class="table-responsive">
                                <form method="post" action="#/wishlist/index/update/wishlist_id/1/" id="wishlist-view-form">
                                    <fieldset>
                                        <input type="hidden" value="ROBdJO5tIbODPZHZ" name="form_key">
                                        <table id="wishlist-table" class="clean-table linearize-table data-table">
                                            <thead>
                                                <tr class="first last">
                                                    <th class="customer-wishlist-item-image"></th>
                                                    <th class="customer-wishlist-item-info"></th>
                                                    <th class="customer-wishlist-item-quantity">Color</th>
                                                    <th class="customer-wishlist-item-price">Price</th>
                                                    <th class="customer-wishlist-item-cart"></th>
                                                    <th class="customer-wishlist-item-remove"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach($wishlist_data as $data){ 
                                                    ?>

                                                <tr id="item_32" class="last even">
                                                    <td class="wishlist-cell0 customer-wishlist-item-image"><a title="<?= $data->name ?>"
                                                            href="/product_detail/<?= $data->product_id ?>" class="product-image"> <img width="150" alt="product_image"
                                                                src="<?= Config::get('constants.options.product_img_host_url').$data->image?>"> </a></td>
                                                    <td class="wishlist-cell1 customer-wishlist-item-info">
                                                        <h3 class="product-name"><a title=" <?= $data->name ?>" href="/product_detail/<?= $data->product_id ?>">Product Name : <?= $data->name ?></a></h3>
                                                        <div class="description std">
                                                            <div class="inner"><a title = "Brand" style = "color:grey"> <?= $data->brand ?> </a></div>
                                                        </div>
                                                       <div class="inner"><a title = "Color" style = "color:grey"> <?= $data->product_color ?> </a></div>
                                                           
                                                        {{-- <textarea title="Comment" onblur="focusComment(this)" onfocus="focusComment(this)"
                                                            cols="5" rows="3" name="description[32]" style="height: 120px; width: 96%;"></textarea> --}}
                                                    </td>
                                                    <td data-rwd-label="Quantity" class="wishlist-cell2 customer-wishlist-item-quantity">
                                                        <div class="cart-cell">
                                                            <div class="add-to-cart-alt">
                                                                <span><?= $data->product_color ?></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td data-rwd-label="Price" class="wishlist-cell3 customer-wishlist-item-price">
                                                        <div class="cart-cell">
                                                            <div class="price-box"> <span id="product-price-2" class="regular-price">
                                                                    <span class="price"><?php 
                                                                        $discount = $data->discount;
                                                                        if($discount == ''){
                                                                            echo "RS : ".$data->product_sale_price;
                                                                        }else{
                                                                            $total_price = $data->product_sale_price;
                                                                            $discount_amount = $total_price - (($discount / 100) * $total_price);
                                                                            echo "RS : ".$discount_amount;
                                                                        } ?></span> </span> </div>
                                                        </div>
                                                    </td>
                                                    <td class="wishlist-cell4 customer-wishlist-item-cart">
                                                            <input type="text" class="qty"  value="1"
                                                            id="qty" name="qty" hidden>
                                                        <div class="cart-cell">
                                                            <button class="button btn-cart" id = "<?= $data->id ?>"
                                                                title="Add to Cart" type="button"><span><span>Add to
                                                                        Cart</span></span></button>
                                                        </div>
                                                        <p><a id = "<?= $data->id ?>" class="btn-cart">Add to Cart</a></p>
                                                    </td>
                                                    <td class="wishlist-cell5 customer-wishlist-item-remove last delete_one_item_wishlist" id = "<?= $data->id ?>"><a
                                                            class="remove-item" title="Delete item" ></a></td>
                                                </tr>
                                                <?php  }
                                            ?>

                                              
                                            </tbody>
                                        </table>
                                        <div class="buttons-set buttons-set2">
                                            <button class="button btn-share " title="Share Wishlist" name="save_and_share"
                                                type="button"><span>Share Wishlist</span></button>
                                            <button class="button btn-update clear_wishlist" title="Clear Wishlist" name="do" type="button"><span>Clear
                                                    Wishlist</span></button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                        <div class="buttons-set">
                            <p class="back-link"><a href="/"><small>« </small>Home</a></p>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="col-right sidebar col-sm-3 col-xs-12">
                <div class="block block-account">
                    <div class="block-title">My Account</div>
                    <div class="block-content">
                        <ul>
                            <li><a href="/account_info">Account Dashboard</a></li>
                            <li><a href="#">Account Information</a></li>
                            <li><a href="#">Address Book</a></li>
                            <li><a href="#">My Orders</a></li>
                            <li><a href="#">Billing Agreements</a></li>
                            <li><a href="#">Recurring Profiles</a></li>
                            <li><a href="#">My Product Reviews</a></li>
                            <li class="current"><a href="/wishlist">My Wishlist</a></li>
                            </li>
                            <li class="last"><a href="#">Newsletter Subscriptions</a></li>
                        </ul>
                    </div>
                </div>
               
            </aside>
        </div>
    </div>
</div>
@endsection
