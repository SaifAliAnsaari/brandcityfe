@extends('layouts.master')

@section('content')

<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>

<section class="main-container col1-layout">
    <div class="main container">
        <div class="col-main">
            <div class="cart">
                <div class="page-title">
                    <h2>Shopping Cart</h2>
                </div>
                <div class="table-responsive">
                    <form method="post" action="#updatePost/">
                        <input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
                        <fieldset>
                            <table class="data-table cart-table" id="shopping-cart-table">
                                <colgroup>
                                    <col width="1">
                                    <col>
                                    <col width="1">
                                    <col width="1">
                                    <col width="1">
                                    <col width="1">
                                    <col width="1">
                                </colgroup>
                                <thead>
                                    <tr class="first last">
                                        <th rowspan="1">&nbsp;</th>
                                        <th rowspan="1"><span class="nobr">Product Name</span></th>
                                        <th rowspan="1"></th>
                                        <th colspan="1" class="a-center"><span class="nobr">Unit Price</span></th>
                                        <th class="a-center" rowspan="1">Qty</th>
                                        <th colspan="1" class="a-center">Subtotal</th>
                                        <th class="a-center" rowspan="1">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="first last">
                                        <td class="a-right last" colspan="50"><a href = "/"><button  class="button btn-continue"
                                                title="Continue Shopping" type="button"><span>Continue Shopping</span></button></a>
                                            <button  class="button btn-update update_cart" type = "button" title="Update Cart" value="update_qty"
                                                >Update Cart QTY</button>
                                            <button id="empty_cart_button" type = "button" class="button btn-empty clear_cart" title="Clear Cart"
                                                value="empty_cart" >Clear
                                                    Cart</button>
                                                   
                                                </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    foreach($cart_detail as $detail){ ?>
                                    <tr class="first odd">
                                        <td class="image"><a class="product-image" title="Sample Product" href="#/women-s-crepe-printed-black/"><img
                                                    width="75" alt="Sample Product" src="/resources/products-images/product1.jpg"></a></td>
                                        <td>
                                            <h2 class="product-name"> <a href="/product_detail/<?= $detail->product_core_id ?>">
                                                    <?= $detail->product_name?>
                                                </a> </h2>
                                        </td>
                                        <td class="a-center"><a title="Edit item parameters" class="edit-bnt" href="#configure/id/15945/"></a></td>
                                        <td class="a-right"><span class="cart-price"> <span class="price">PKR : <?php
                                        if($detail->product_discount == "") {
                                            echo $detail->product_sale_price;
                                        }else{
                                            $total_price = $detail->product_sale_price;
                                            $discount = $total_price - $detail->product_discount;
                                            echo $discount;
                                        }//$detail->product_sale_price ?></span>
                                            </span></td>
                                        <td class="a-center movewishlist">
                                            <input type = "number" style = "width:60px;" class="input-text quantity" title="Qty" min="1" max="<?= $detail->product_quantity; ?>" id="<?= $detail->cart_id ?>" value="<?= $detail->quantity ?>" name="cart[15945][qty]" onkeyup="limitTheInputQuantity(this);" />
                                        </td>
                                        <td class="a-right movewishlist"><span class="cart-price">RS : <span class="price product_subtotal"><?php
                                         if($detail->product_discount == "") {
                                            echo $detail->product_sale_price * $detail->quantity ;
                                        }else{
                                            $total_price = $detail->product_sale_price;
                                            $discount = $total_price - $detail->product_discount;
                                            echo $discount * $detail->quantity ;
                                        }
                                        ?></span>
                                            </span></td>
                                        <td class="a-center last"><a class="button remove-item remove_item" title="Remove item" id="<?= $detail->id ?>"
                                                ><span><span>Remove item</span></span></a></td>
                                    </tr>
                                    <?php }
                                ?>
<script>
    function limitTheInputQuantity(inputRef){
        if(parseInt(inputRef.value) > parseInt(inputRef.getAttribute('max'))){ inputRef.value = inputRef.getAttribute('max'); inputRef.blur(); }else if(parseInt(inputRef.value) <= 0){ inputRef.value = 1; }
    }
</script>

                                </tbody>
                            </table>
                        </fieldset>
                    </form>
                </div>
                <!-- BEGIN CART COLLATERALS -->
                <div class="cart-collaterals row">
                    
                    <div class="col-sm-4">
                        <div class="discount">
                            <h3>Discount Codes</h3>
                                <label for="coupon_code">Enter your coupon code if you have one.</label>
                                <input type="hidden" value="0" id="remove-coupone" name="remove">
                                <input type="text" name="coupon_code" id="coupon_code" class="input-text fullwidth">
                                <button value="Apply Coupon"   class="button coupon btn_coupon_submit"
                                    title="Apply Coupon" type="button"><span>Apply Coupon</span></button>
                                <br>
                            <span class = "applied_success" style = "color:green; display:none">Coupon Applied successfully!</span>
                            <span class = "applied_failed" style = "color:red; display:none">Invalid Coupon!</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        {{-- <div class="shipping">
                            <h3>Estimate Shipping and Tax</h3>
                            <div class="shipping-form">
                                <form id="shipping-zip-form" method="post" action="#estimatePost/">
                                    <p>Enter your destination to get a shipping estimate.</p>
                                    <ul class="form-list">
                                        <li>
                                            <label class="required" for="country"><em>*</em>Country</label>
                                            <div class="input-box">
                                                <select title="Country" class="validate-select" id="country" name="country_id">

                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Åland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AQ">Antarctica</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BV">Bouvet Island</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="VG">British Virgin Islands</option>
                                                    <option value="BN">Brunei</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos [Keeling] Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CG">Congo - Brazzaville</option>
                                                    <option value="CD">Congo - Kinshasa</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d’Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="GF">French Guiana</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="TF">French Southern Territories</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GP">Guadeloupe</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="GY">Guyana</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="HM">Heard Island and McDonald Islands</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong SAR China</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Laos</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macau SAR China</option>
                                                    <option value="MK">Macedonia</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="YT">Mayotte</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia</option>
                                                    <option value="MD">Moldova</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar [Burma]</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="AN">Netherlands Antilles</option>
                                                    <option value="NC">New Caledonia</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="KP">North Korea</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territories</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PN">Pitcairn Islands</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RE">Réunion</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russia</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="SH">Saint Helena</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin</option>
                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">São Tomé and Príncipe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                    <option value="KR">South Korea</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syria</option>
                                                    <option value="TW">Taiwan</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TL">Timor-Leste</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option selected="selected" value="US">United States</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UM">U.S. Minor Outlying Islands</option>
                                                    <option value="VI">U.S. Virgin Islands</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VA">Vatican City</option>
                                                    <option value="VE">Venezuela</option>
                                                    <option value="VN">Vietnam</option>
                                                    <option value="WF">Wallis and Futuna</option>
                                                    <option value="EH">Western Sahara</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="region_id">State/Province</label>
                                            <div class="input-box">
                                                <select style="" title="State/Province" name="region_id" id="region_id"
                                                    class="required-entry validate-select">
                                                    <option>Please select region, state or province</option>
                                                    <option value="1" title="Alabama">Alabama</option>
                                                    <option value="2" title="Alaska">Alaska</option>
                                                    <option value="3" title="American Samoa">American Samoa</option>
                                                    <option value="4" title="Arizona">Arizona</option>
                                                    <option value="5" title="Arkansas">Arkansas</option>
                                                    <option value="6" title="Armed Forces Africa">Armed Forces Africa</option>
                                                    <option value="7" title="Armed Forces Americas">Armed Forces
                                                        Americas</option>
                                                    <option value="8" title="Armed Forces Canada">Armed Forces Canada</option>
                                                    <option value="9" title="Armed Forces Europe">Armed Forces Europe</option>
                                                    <option value="10" title="Armed Forces Middle East">Armed Forces
                                                        Middle East</option>
                                                    <option value="11" title="Armed Forces Pacific">Armed Forces
                                                        Pacific</option>
                                                    <option value="12" title="California">California</option>
                                                    <option value="13" title="Colorado">Colorado</option>
                                                    <option value="14" title="Connecticut">Connecticut</option>
                                                    <option value="15" title="Delaware">Delaware</option>
                                                    <option value="16" title="District of Columbia">District of
                                                        Columbia</option>
                                                    <option value="17" title="Federated States Of Micronesia">Federated
                                                        States Of Micronesia</option>
                                                    <option value="18" title="Florida">Florida</option>
                                                    <option value="19" title="Georgia">Georgia</option>
                                                    <option value="20" title="Guam">Guam</option>
                                                    <option value="21" title="Hawaii">Hawaii</option>
                                                    <option value="22" title="Idaho">Idaho</option>
                                                    <option value="23" title="Illinois">Illinois</option>
                                                    <option value="24" title="Indiana">Indiana</option>
                                                    <option value="25" title="Iowa">Iowa</option>
                                                    <option value="26" title="Kansas">Kansas</option>
                                                    <option value="27" title="Kentucky">Kentucky</option>
                                                    <option value="28" title="Louisiana">Louisiana</option>
                                                    <option value="29" title="Maine">Maine</option>
                                                    <option value="30" title="Marshall Islands">Marshall Islands</option>
                                                    <option value="31" title="Maryland">Maryland</option>
                                                    <option value="32" title="Massachusetts">Massachusetts</option>
                                                    <option value="33" title="Michigan">Michigan</option>
                                                    <option value="34" title="Minnesota">Minnesota</option>
                                                    <option value="35" title="Mississippi">Mississippi</option>
                                                    <option value="36" title="Missouri">Missouri</option>
                                                    <option value="37" title="Montana">Montana</option>
                                                    <option value="38" title="Nebraska">Nebraska</option>
                                                    <option value="39" title="Nevada">Nevada</option>
                                                    <option value="40" title="New Hampshire">New Hampshire</option>
                                                    <option value="41" title="New Jersey">New Jersey</option>
                                                    <option value="42" title="New Mexico">New Mexico</option>
                                                    <option value="43" title="New York">New York</option>
                                                    <option value="44" title="North Carolina">North Carolina</option>
                                                    <option value="45" title="North Dakota">North Dakota</option>
                                                    <option value="46" title="Northern Mariana Islands">Northern
                                                        Mariana Islands</option>
                                                    <option value="47" title="Ohio">Ohio</option>
                                                    <option value="48" title="Oklahoma">Oklahoma</option>
                                                    <option value="49" title="Oregon">Oregon</option>
                                                    <option value="50" title="Palau">Palau</option>
                                                    <option value="51" title="Pennsylvania">Pennsylvania</option>
                                                    <option value="52" title="Puerto Rico">Puerto Rico</option>
                                                    <option value="53" title="Rhode Island">Rhode Island</option>
                                                    <option value="54" title="South Carolina">South Carolina</option>
                                                    <option value="55" title="South Dakota">South Dakota</option>
                                                    <option value="56" title="Tennessee">Tennessee</option>
                                                    <option value="57" title="Texas">Texas</option>
                                                    <option value="58" title="Utah">Utah</option>
                                                    <option value="59" title="Vermont">Vermont</option>
                                                    <option value="60" title="Virgin Islands">Virgin Islands</option>
                                                    <option value="61" title="Virginia">Virginia</option>
                                                    <option value="62" title="Washington">Washington</option>
                                                    <option value="63" title="West Virginia">West Virginia</option>
                                                    <option value="64" title="Wisconsin">Wisconsin</option>
                                                    <option value="65" title="Wyoming">Wyoming</option>
                                                </select>
                                                <input type="text" style="display:none;" class="input-text required-entry"
                                                    title="State/Province" name="region" id="region">
                                            </div>
                                        </li>
                                        <li>
                                            <label for="postcode">Zip/Postal Code</label>
                                            <div class="input-box">
                                                <input type="text" name="estimate_postcode" id="postcode" class="input-text validate-postcode">
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="buttons-set11">
                                        <button class="button get-quote" onclick="coShippingMethodForm.submit()" title="Get a Quote"
                                            type="button"><span>Get a Quote</span></button>
                                    </div>
                                    <!--buttons-set11-->
                                </form>
                            </div>
                        </div> --}}
                    </div>
                    <div class="totals col-sm-4">
                        <h3>Shopping Cart Total</h3>
                        <div class="inner">
                            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                                <colgroup>
                                    <col>
                                    <col width="1">
                                </colgroup>
                                <tfoot>
                                    <tr>
                                        <td colspan="1" class="a-left" style=""><strong>Grand Total</strong></td>
                                        <td class="a-right" style=""><strong><span class="price grand_total final_price"></span></strong></td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td colspan="1" class="a-left" style=""> Subtotal </td>
                                        <td class="a-right" style=""><span class="price grand_total"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <ul class="checkout">
                                <li>
                                    <a><button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Proceed
                                            to Checkout</span></button></a>
                                </li>
                                <br>
                                {{-- <li><a title="Checkout with Multiple Addresses" href="multiple_addresses.html">Checkout
                                        with Multiple Addresses</a> </li> --}}
                                <br>
                            </ul>
                        </div>
                        <!--inner-->

                    </div>
                </div>

                <!--cart-collaterals-->

            </div>
            <div class="crosssel bounceInUp animated">
                <div class="new_title">
                    <h2>you may be interested</h2>
                </div>
                <div class="category-products">
                        <ul class="products-grid">
                                <?php
                   
                                if(empty($latest_products)){

                                }else{
                                    foreach($latest_products as $product){
                                        
                                    
                                     ?>
                                                 <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                        <div class="item-inner">
                                                            <div class="item-img">
                                                                <div class="item-img-info">
                                                                    <a class="product-image" title="Retis lapen casen" href="/product_detail/<?= $product['id'] ?>">
                                                                        <img alt="Retis lapen casen" style = "width:200px; height:300px;"
                                                                         src="<?= Config::get('constants.options.product_img_host_url').$product['image'] ?>">
                                                                    </a>
                                                                    <div class="box-hover">
                                                                        <ul class="add-to-links">
                                                                            <li><a class="link-quickview quickViewModal" id = "<?= $product['id'] ?>">Quick
                                                                                    View</a> </li>
                                                                            <li><a class="link-wishlist wishlist" id="<?php 
                                                                                if(sizeof($product["variants"]) > 1){
                                                                                    echo $product["variants"][0]["variant_id"];
                                                                                }else{
                                                                                    foreach($product["variants"] as $variants){
                                                                                    }
                                                                                    echo $variants["variant_id"];
                                                                                } ?>">Wishlist</a>
                                                                            </li>

                                                                            <?php if(sizeof($product["variants"]) == 1){ ?>
                                                                                <li><a class="link-compare compare_product" id="<?php 
                                                                                
                                                                                    foreach($product["variants"] as $variants){
                                                                                    
                                                                                    }
                                                                                    echo $variants["variant_id"];
                                                                               ?>" >Compare</a>
                                                                            </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="info-inner">
                                                                    <div class="item-title"> <a title="Retis lapen casen" href="/product_detail/<?= $product['id'] ?>">
                                                                           <?= $product['name'] ?> </a> </div>
                                                                    <div class="item-content">
                                                                        <div class="rating">
                                                                            <div class="ratings">
                                                                                <div class="rating-box">
                                                                                        <?php
                                                                                        if(sizeof($product["variants"]) > 1){
                                                                                        foreach($product["variants"] as $variants){
                                                                                            if($variants["ratting"] == ""){
                                                                                                echo "0";
                                                                                            }else{
                                                                                            $rating = 
                                                                                            ($variants["ratting"] / 5) * 100; ?>
                                                                                            <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                        <?php }
                                                                                        }                            
                                                                                        }else{
                                                                                            foreach($product["variants"] as $variants){
                                                                                            }
                                                                                        if($variants["ratting"] == ""){
                                                                                            echo "0";
                                                                                        }else{
                                                                                            $rating = ($variants["ratting"] / 5) * 100; ?>
                                                                                            <div style="width:<?= $rating ?>%" class="rating"></div>
                                                                                        <?php }
                                                                                        }
                                                                                        ?>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="item-price">
                                                                            <div class="price-box"> <span class="regular-price">
                                                                                    <p class="old-price"><span class="price-label">Regular Price:</span>
                                                                                        <span class="price">
                                                                                                <?php
                                                                                                if(sizeof($product["variants"]) == 1){
                                                                                                    if($product["discount"] == ""){
                                                                                                    }else{
                                                                                                        foreach($product["variants"] as $variants){
                                                                                                        echo "PKR: ".number_format($variants["price"]);
                                                                                                        }
                                                                                                    }
                                                                                                }    
                                                                                            ?>
                                                                                        </span> </p>
                                                                                    <p class="special-price"><span class="price-label">Special
                                                                                            Price</span> <span class="price">
                                                                                                    <?php
                                                                                                    if(sizeof($product["variants"]) == 1){
                                                                                                        if($product["discount"] == ""){
                                                                                                            foreach($product["variants"] as $variants){
                                                                                                                echo "PKR: ".number_format($variants["price"]);
                                                                                                            }
                                                                                                        }else{
                                                                                                            foreach($product["variants"] as $variants){
                                                                                                                $total_price = $variants["price"];
                                                                                                                $discount = $total_price - $product["discount"];
                                                                                                                echo "PKR: ".number_format($discount);
                                                                                                            }
                                                                                                        }
                                                                                                    }else{
                                                                                                        echo "PKR: 00";
                                                                                                    } 
                                    
                                                                                                        ?>
                                                                                        </span> </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="action">
                                                                                @if(sizeof($product["variants"]) == 1)
                                                                                <input class = "qty" type = "text" value = "1" hidden/>
                                                                                <button class="button btn-cart test" id = "<?php 
                                                                                foreach($product["variants"] as $variants){
                                                                                   echo $variants["variant_id"];
                                                                                } ?>" type="button" title=""
                                                                                    data-original-title="Add to Cart"><span>Add to Cart</span></button>
                                                                                @else
                                                                                <a class="button btn-quickview quickViewModal" id = "<?= $product["id"] ?>" type="button"
                                                                                    title="" data-original-title="Add to Cart"><span>Quick View</span></a>
                                                                                @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                            <?php 
                                        }
                                 }
                            ?>
                           
                        </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
