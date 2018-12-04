<footer class="footer">
    <div class="newsletter-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="newsletter">
                        {!! Form::open(['action' => "HomeController@newsletter"]) !!}
                        <div>
                            <h4><span>newsletter</span></h4>
                            <input type="email" placeholder="Enter your email address" required class="input-text" title="Sign up for our newsletter"
                                id="newsletter1" name="email" style="width:30%;">
                            <button class="subscribe" title="Subscribe" type="submit"><span>Subscribe</span></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--newsletter-->
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Shopping Guide</h4>
                        <ul class="links">
                            {{-- <li><a href="/blog" title="How to buy">Blog</a></li> --}}
                            <li><a href="/faq" title="FAQs">FAQs</a></li>
                            <li><a href="/checkout" title="Payment">Payment</a></li>
                            <li><a href="#" title="Shipment">Shipment</a></li>
                            <li><a href="#" title="Where is my order?">Where is my order?</a></li>
                            <li><a href="#" title="Return policy">Return policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Style Advisor</h4>
                        <ul class="links">
                            <li><a href="/account_info" title="Your Account">Your Account</a></li>
                            <li><a href="#" title="Information">Information</a></li>
                            <li><a href="#" title="Addresses">Addresses</a></li>
                            <li><a href="#" title="Addresses">Discount</a></li>
                            <li><a href="#" title="Orders History">Orders History</a></li>
                            <li><a href="#" title="Order Tracking">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="footer-column pull-left">
                        <h4>Information</h4>
                        <ul class="links">
                            <li><a href="/site_map" title="Site Map">Site Map</a></li>
                            <li><a href="#" title="Search Terms">Search Terms</a></li>
                            <li><a href="#" title="Advanced Search">Advanced Search</a></li>
                            <li><a href="/about_us" title="About Us">About Us</a></li>
                            <li><a href="/contact_us" title="Contact Us">Contact Us</a></li>
                            <li><a href="#" title="Suppliers">Suppliers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <h4>contact us</h4>
                    <div class="contacts-info">
                        <address>
                            <i class="add-icon">&nbsp;</i>123 Main Street, Anytown, <br>
                            &nbsp;CA 12345 USA
                        </address>
                        <div class="phone-footer"><i class="phone-icon">&nbsp;</i> +1 800 123 1234</div>
                        <div class="email-footer"><i class="email-icon">&nbsp;</i> <a href="mailto:support@example.com">support@example.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="social">
                        <ul>
                            <li class="fb">
                                <a href="#"></a>
                            </li>
                            <li class="tw">
                                <a href="#"></a>
                            </li>
                            <li class="googleplus">
                                <a href="#"></a>
                            </li>
                            <li class="rss">
                                <a href="#"></a>
                            </li>
                            <li class="pintrest">
                                <a href="#"></a>
                            </li>
                            <li class="linkedin">
                                <a href="#"></a>
                            </li>
                            <li class="youtube">
                                <a href="#"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <div class="payment-accept"> <img src="/resources/images/payment-1.png" alt="PayPal"> <img src="/resources/images/payment-2.png"
                            alt="VISA"> <img src="/resources/images/payment-3.png" alt="American Express"> <img src="/resources/images/payment-4.png"
                            alt="Mastercard"> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-xs-12 coppyright"> &copy; 2018 Magikcommerce. All Rights Reserved.</div>
                <div class="col-sm-7 col-xs-12 company-links">
                    <ul class="links">
                        <li><a href="#" title="Gift Subscriptions">Gift Subscriptions</a></li>
                        <li><a href="#" title="Advertise Products">Advertise Products</a></li>
                        <li><a href="#" title="Terms & Conditions">Terms & Conditions</a></li>
                        <li class="last"><a href="#" title="Privacy Policy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
