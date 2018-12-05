@extends('layouts.master')

@section('content')

<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>

    <input class = "qty" type = "text" value = "1" hidden/>

<section class="main-container col1-layout">
    <div class="main container">
        <div class="col-main">
            <div class="cart">
                <div class="page-title">
                    <h2>Compare Products</h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped compare-table">
                        <colgroup>
                            <col width="1">
                            <col width="50%">
                            <col width="50%">
                        </colgroup>
                        <tbody>
                            <tr class="product-shop-row first odd">
                                <th>&nbsp;</th>
                                <?php 
                                foreach ($product1_detai as $pro_one) { ?>
                                <td><a class="product-image" href="/product_detail/<?= $pro_one->product_id ?>" title="Azrouel Dress">
                                        <img src="<?= Config::get('constants.options.product_img_host_url').$pro_one->image?>" alt="Azrouel Dress" width="200">    
                                    </a>
                                    <h2 class="product-name"><a href="/product_detail/<?= $pro_one->product_id ?>" title="Azrouel Dress"><?= $pro_one->name ?></a></h2>
                                    <div class="price-box">
                                      
                                                <p class="old-price"><span class="price-label">Regular Price:</span>
                                                    <span class="price">
                                                        <?php
                                                        if($pro_one->discount == ""){

                                                        }else{
                                                            echo "RS : ".$pro_one->product_sale_price;
                                                        }     
                                                            ?>
                                                    </span> </p>
                                                <p class="special-price"><span class="price-label">Special
                                                        Price</span> <span class="price">
                                                        <?php
                                                            if($pro_one->discount == ""){
                                                                echo "RS : ".$pro_one->product_sale_price;
                                                            }else{
                                                                $total_price = $pro_one->product_sale_price;
                                                                $discount = $total_price - (($pro_one->discount / 100) * $total_price);
                                                                echo "RS : ".$discount;
                                                            }
                                                                
                                                            ?>
                                                    </span> </p>

                                    </div>
                                    <p>
                                        <button type="button" title="Add to Cart" id = "<?= $pro_one->id ?>" class="button btn-cart"><span><span>Add to
                                                    Cart</span></span></button>
                                    </p>
                                    <a class="button wishlist" id = "<?= $pro_one->id ?>">Add to Wishlist</a>
                                </td>
                                <?php }
                                foreach ($product2_detail as $pro_two) { ?>
                                <td><a class="product-image" href="/product_detail/<?= $pro_two->product_id ?>" title="Blue Lagoon polka-dot chiffon and lace thong">
                                            <img src="<?= Config::get('constants.options.product_img_host_url').$pro_two->image?>" alt="Azrouel Dress" width="200">                                  
                                    </a>
                                    <h2 class="product-name"><a href="/product_detail/<?= $pro_two->product_id ?>" title="Blue Lagoon polka-dot chiffon and lace thong"><?= $pro_two->name ?></a></h2>
                                    <div class="price-box"> 
                                            <p class="old-price"><span class="price-label">Regular Price:</span>
                                                <span class="price">
                                                    <?php
                                                    if($pro_two->discount == ""){

                                                    }else{
                                                        echo "RS : ".$pro_two->product_sale_price;
                                                    }     
                                                        ?>
                                                </span> </p>
                                            <p class="special-price"><span class="price-label">Special
                                                    Price</span> <span class="price">
                                                    <?php
                                                        if($pro_two->discount == ""){
                                                            echo "RS : ".$pro_two->product_sale_price;
                                                        }else{
                                                            $total_price = $pro_two->product_sale_price;
                                                            $discount = $total_price - (($pro_two->discount / 100) * $total_price);
                                                            echo "RS : ".$discount;
                                                        }
                                                            
                                                        ?>
                                                </span> </p>
                                    </div>
                                    <p>
                                        <button type="button" title="Add to Cart" id = "<?= $pro_two->id ?>" class="button btn-cart"><span><span>Add to
                                                    Cart</span></span></button>
                                    </p>
                                    <a  class="button wishlist" id = "<?= $pro_two->id ?>">Add to Wishlist</a>
                                </td>
                                <?php }
                                ?>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr class="even">
                                <th>Description</th>
                                
                                    <?php 
                                        foreach($product1_detai as $pro_one){ ?>
                                        <td>
                                            <div> <?= $pro_one->description ?> </div>
                                        </td>
                                        <? }
                                        foreach($product2_detail as $pro_two){ ?>
                                            <td>
                                                <div> <?= $pro_two->description ?> </div>
                                            </td>
                                       <?php }
                                    ?>
                                    
                            </tr>
                            <tr class="odd">
                                <th>Color</th>
                                <?php 
                                foreach($product1_detai as $pro_one){ ?>
                                    <td>
                                        <div> <?= $pro_one->product_color ?> </div>
                                    </td>
                                <?php }
                                foreach($product2_detail as $pro_two){ ?>
                                    <td>
                                        <div> <?= $pro_two->product_color ?> </div>
                                    </td>
                               <?php }
                                ?>
                            </tr>
                            <tr class="even">
                                <th>Brand</th>
                                <?php 
                                foreach($product1_detai as $pro_one){ ?>
                                    <td>
                                        <div> <?= $pro_one->brand ?> </div>
                                    </td>
                                <?php }
                                foreach($product2_detail as $pro_two){ ?>
                                    <td>
                                        <div> <?= $pro_two->brand ?> </div>
                                    </td>
                               <?php }
                                ?>
                            </tr>

                           {{-- specification --}}
                            <?php 
                                foreach($spec_one as $one){ ?>
                                    <tr class="even">
                                        <th><?= $one->specification ?></th>
                                        <td>
                                            <div style = "max-width:150px;"><?= $one->description ?></div>
                                        </td>
                                        <td>
                                            <?php 
                                                foreach($spec_two as $two){
                                                    if($two->specification ==  $one->specification){ ?>
                                                        <div style = "max-width:150px;"><?= $two->description ?></div>
                                            <?php }
                                                }
                                            ?>
                                            
                                        </td>
                                    </tr>
                               <?php }
                            ?>


                        </tbody>
                        <tbody>
                            <tr class="add-to-row last odd text-center">
                                <th>&nbsp;</th>
                                <td>
                                        <?php
                                        foreach($product1_detai as $pro_one){ ?>
                                    <div class="price-box">
                                            <p class="old-price"><span class="price-label">Regular Price:</span>
                                                <span class="price">
                                                    <?php
                                                    if($pro_one->discount == ""){

                                                    }else{
                                                        echo "RS : ".$pro_one->product_sale_price;
                                                    }     
                                                        ?>
                                                </span> </p>
                                            <p class="special-price"><span class="price-label">Special
                                                    Price</span> <span class="price">
                                                    <?php
                                                        if($pro_one->discount == ""){
                                                            echo "RS : ".$pro_one->product_sale_price;
                                                        }else{
                                                            $total_price = $pro_one->product_sale_price;
                                                            $discount = $total_price - (($pro_one->discount / 100) * $total_price);
                                                            echo "RS : ".$discount;
                                                        }
                                                            
                                                        ?>
                                                </span> </p>
                                    </div>
                                    <p>
                                        <button type="button" title="Add to Cart" id = "<?= $pro_one->id ?>" class="button btn-cart"><span><span>Add to
                                                    Cart</span></span></button>
                                    </p>
                                    <a class="button wishlist" id = "<?= $pro_one->id ?>">Add to Wishlist</a>
                                </td>
                                <?php }
                                foreach ($product2_detail as $pro_two){
                                ?>
                                <td>
                                    <div class="price-box"> 
                                            <p class="old-price"><span class="price-label">Regular Price:</span>
                                                <span class="price">
                                                    <?php
                                                    if($pro_two->discount == ""){

                                                    }else{
                                                        echo "RS : ".$pro_two->product_sale_price;
                                                    }     
                                                        ?>
                                                </span> </p>
                                            <p class="special-price"><span class="price-label">Special
                                                    Price</span> <span class="price">
                                                    <?php
                                                        if($pro_two->discount == ""){
                                                            echo "RS : ".$pro_two->product_sale_price;
                                                        }else{
                                                            $total_price = $pro_two->product_sale_price;
                                                            $discount = $total_price - (($pro_two->discount / 100) * $total_price);
                                                            echo "RS : ".$discount;
                                                        }
                                                            
                                                        ?>
                                                </span> </p>
                                     </div>
                                    <p>
                                        <button type="button" title="Add to Cart" id = "<?= $pro_two->id ?>" class="button btn-cart"><span><span>Add to
                                                    Cart</span></span></button>
                                    </p>
                                    <a class="button wishlist" id = "<?= $pro_two->id ?>">Add to Wishlist</a>
                                </td>
                            <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
