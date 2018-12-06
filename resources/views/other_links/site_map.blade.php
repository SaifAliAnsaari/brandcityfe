@extends('layouts.master')

@section('content')
<section class="main-container col1-layout">
    <div class="main container">
        <div class="col-main">
            <div class="cart">
                <div class="page-title">
                    <h2>Sitemap</h2>
                </div>
                <div class="row content-row">
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-4">
                        {{-- <ul class="simple-list arrow-list bold-list">
                            <li> <a href="grid.html">Woman</a>
                                <ul>
                                    <li><a href="grid.html">Featured products</a></li>
                                    <li><a href="grid.html">New arrivals</a></li>
                                    <li><a href="grid.html">Bestsellers</a></li>
                                    <li><a href="grid.html">Footwear Womens</a></li>
                                    <li><a href="grid.html">Shorts</a></li>
                                </ul>
                            </li>
                            <li> <a href="grid.html">Man</a>
                                <ul>
                                    <li><a href="grid.html">Polo Shirts</a></li>
                                    <li><a href="grid.html">Shirts</a></li>
                                    <li><a href="grid.html">Big &amp; Tall</a></li>
                                    <li><a href="grid.html">Jeans</a></li>
                                    <li><a href="grid.html">Sweaters</a></li>
                                </ul>
                            </li>
                            <li><a href="grid.html">Electronics</a></li>
                            <li><a href="grid.html">Furniture</a></li>
                            <li><a href="grid.html">Sale</a></li>
                        </ul> --}}
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
                    </div>
                    
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-4">
                        <ul class="simple-list arrow-list bold-list">
                            <li><a href="/cart">Shopping Cart</a></li>
                            <li> <a href="/account_info">My Account</a>
                                <ul>
                                    <li><a href="/account_info">My Account</a></li>
                                    <li><a href="/orders">Order history</a></li>
                                    <li><a href="#">Reviews</a></li>
                                </ul>
                            </li>
                            <li> <a href="/contact_us">Customer service</a>
                                <ul>
                                    <li><a href="/contact_us">Online support</a></li>
                                    <li><a href="/faq">Help & FAQs</a></li>
                                    <li><a href="/contact_us">Call Center</a></li>
                                </ul>
                            </li>
                            <li> <a href="/about_us">Information</a>
                                <ul>
                                    <li><a href="/about_us">About Us</a></li>
                                    <li><a href="#">Shipping &amp; Returns</a></li>
                                    <li><a href="#">Privacy Notice</a></li>
                                    <li><a href="#">Conditions of Use</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> <img class="img-responsive animate scale" src="/resources/images/large-icon-sitemap.png"
                            alt=""> </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
