<header>
    <div class="header-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-2 col-sm-3 col-xs-12 logo-block">
                    <!-- Header Logo -->
                    <div class="logo">
                        <a title="Brandcity" href="/home"><img alt="HTML Website Template" src="/resources/images/logo.png">
                        </a>
                    </div>
                    <!-- End Header Logo -->
                </div>
                <!-- Header Language -->
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 pull-right hidden-xs">
                   
                    <div class="welcome-msg hidden-xs"> Welcome to the World of BRANDS! </div>
                    <!-- Header Top Links -->
                    <div class="toplinks">
                        <div class="links">
                            <div class="myaccount"><a title="My Account" href="/account_info"><span class="hidden-xs">My
                                        Account</span></a> </div>
                            <div class="check"><a title="Checkout" href="/checkout"><span class="hidden-xs">Checkout</span></a>
                            </div>
                            {{-- <div class="demo"><a title="Blog" href="/blog"><span class="hidden-xs">Blog</span></a>
                            </div> --}}
                            <!-- Header Company -->
                            <div class="dropdown block-company-wrapper hidden-xs"> <a role="button" data-toggle="dropdown"
                                    class="block-company dropdown-toggle" href="#"> Company <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a href="/about_us"> About Us </a> </li>
                                    <li role="presentation"><a href="#"> Customer Service </a> </li>
                                    <li role="presentation"><a href="#"> Privacy Policy </a> </li>
                                    <li role="presentation"><a href="/site_map">Site Map </a> </li>
                                    {{-- <li role="presentation"><a href="#">Search Terms </a> </li>
                                    <li role="presentation"><a href="#">Advanced Search </a> </li> --}}
                                </ul>
                            </div>
                            <!-- End Header Company -->
                            <?php if($user = Auth::user()){ ?>
                            <div class="login"><a href="/logout"><span class="hidden-xs">Log out</span></a> </div>
                            <?php } else{ ?>
                            <div class="login"><a href="/login"><span class="hidden-xs">Log In</span></a> </div>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- End Header Top Links -->
                </div>
            </div>
        </div>
    </div>
</header>
