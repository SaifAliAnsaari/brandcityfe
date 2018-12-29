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
                                                            echo "PKR: ".number_format($pro_one->product_sale_price);
                                                        }     
                                                            ?>
                                                    </span> </p>
                                                <p class="special-price"><span class="price-label">Special
                                                        Price</span> <span class="price">
                                                        <?php
                                                            if($pro_one->discount == ""){
                                                                echo "PKR: ".number_format($pro_one->product_sale_price);
                                                            }else{
                                                                $total_price = $pro_one->product_sale_price;
                                                                $discount = $total_price - $pro_one->discount;
                                                                echo "PKR: ".number_format($discount);
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
                                                        echo "PKR: ".number_format($pro_two->product_sale_price);
                                                    }     
                                                        ?>
                                                </span> </p>
                                            <p class="special-price"><span class="price-label">Special
                                                    Price</span> <span class="price">
                                                    <?php
                                                        if($pro_two->discount == ""){
                                                            echo "PKR: ".number_format($pro_two->product_sale_price);
                                                        }else{
                                                            $total_price = $pro_two->product_sale_price;
                                                            $discount = $total_price - $pro_two->discount;
                                                            echo "PKR: ".number_format($discount);
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
                    </table>

                    <?php $counter = 0; ?>
                    @foreach ($spec_one as $data)
                        <span style="padding: 10px 10px; display: block; background: #fbf9f9; border: 1px solid #dcd4d4; font-weight: 400;">{{ $data['header'] }}</span>
                        @foreach ($data['specs'] as $spec)
                            <div class="row" style="margin-top: 10px; padding:5px;">
                                <div class="col-md-3">
                                    <span style="line-height: 45px;"> {{$spec->specification}} </span>
                                </div>
                                <div class="col-md-9">
                                    <div class = "row" style = "display: inline;">
                                    <input  style = "width:50%; display: inline;" value="{{ $spec->description }}" class="form-control" disabled/> 
                                    
                                    <?php 
                                        foreach($spec_two as $data_two){
                                            foreach($data_two['specs'] as $two){
                                            if($two->specification ==  $spec->specification){ ?>
                                            <input  style = "width:50%; display: inline;" value="{{ $two->description }}" class="form-control" disabled />
                                   
                                         <?php }
                                        } 
                                    }
                                    ?>    
                                    
                                    </div>
                                </div>
                            </div>
                            <?php $counter++; ?>
                        @endforeach
                    @endforeach

                    <span style="padding: 10px 10px; display: block; background: #fbf9f9; border: 1px solid #dcd4d4; font-weight: 400;">Brand</span>
                    <div class="row" style="margin-top: 10px; padding:5px;">
                        @foreach ($product1_detai as $pro_one)
                        <div class="col-md-6" style = "padding:10px;">
                            {{ $pro_one->brand }}
                        </div>
                        @endforeach

                        @foreach ($product2_detail as $pro_two)
                        <div class="col-md-6" style = "padding:10px;">
                            {{ $pro_two->brand }}
                        </div>
                        @endforeach
                    </div>

                    <span style="padding: 10px 10px; display: block; background: #fbf9f9; border: 1px solid #dcd4d4; font-weight: 400;">Description</span>
                    <div class="row" style="margin-top: 10px; padding:5px;">
                        @foreach ($product1_detai as $pro_one)
                        <div class="col-md-6" style = "padding:10px;">
                            {{ $pro_one->description }}
                        </div>
                        @endforeach

                        @foreach ($product2_detail as $pro_two)
                        <div class="col-md-6" style = "padding:10px;">
                            {{ $pro_two->description }}
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
