<div id="mobile-menu">
        <ul class="mobile-menu">

           
            @foreach ($nav_links as $nav)
            <li>
                <a> <span>{{ $nav["name"] }}</span> </a>
                
                        <?php 
                            $total_sub = count($nav["sub_category"]);
                            $counter = 0;
                            for($i=0; $i<$total_sub; $i++){ ?>
                            <ul>
                                    <li>
                            <a > <span>{{ $nav["sub_category"][$i]['name'] }}</span> </a>
                                <ul class="nav">

                                    <?php 
                                        foreach($nav["sub_category"][$i]["product_categories"] as $pro){ ?>
                                        <li> <a href="/category/<?= $pro["name"] ?>"><span>{{ $pro['name'] }}</span></a>
                                        </li>
                                        <?php }
                                    ?>
                                        
                                </ul>
                                <br>
                            </li>
                        </ul>
                                <?php $counter++;
                            } 
                        ?>
                   
            </li>
            @endforeach



           
        </ul>
        <div class="top-links">
            <div class="lang-curr">
                
            </div>
            <!--lang-curr-->
            <ul class="links">
                <li><a href="/account_info" title="My Account">My Account</a></li>
                <li><a href="/wishlist" title="Wishlist">Wishlist</a></li>
                <li><a href="/cart" title="Checkout">Checkout</a></li>
                <li class="last"><a href="/login" title="Log In"><span>Log In</span></a></li>
            </ul>
        </div>
    </div>