<header>
    <div class="header-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-2 col-sm-3 col-xs-12 logo-block">
                    <!-- Header Logo -->
                    <div class="logo">
                        <a title="Brandcity" href="/home" style="color: white; font-weight: 600; font-size: 1.5em">BRANDCITY</a>
                    </div>
                    <!-- End Header Logo -->
                </div>
                <!-- Header Language -->
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 pull-right hidden-xs">
                   
                    <div class="welcome-msg hidden-xs"> Welcome to the World of BRANDS! </div>
                    <!-- Header Top Links -->
                    <div class="toplinks">
                        <div class="links">
                            @if(Auth::user())
                            <div class="myaccount"><a title="My Account" href="/account_info"><span class="hidden-xs">My
                                    Account</span></a> </div>
                            @endif
                            {{-- <div class="check"><a title="Checkout" href="/checkout"><span class="hidden-xs">Checkout</span></a>
                            </div> --}}
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
                            <?php if($user = Auth::user()){
                                $name = Auth::user()->first_name. " " . Auth::user()->last_name; ?>
                            <div class="dropdown block-company-wrapper hidden-xs"> <a role="button" data-toggle="dropdown"
                                 class="block-company dropdown-toggle" href=""> {{ $name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li role="presentation"><a href="/logout"> Logout </a> </li>
                                </ul>
                            </div>
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
