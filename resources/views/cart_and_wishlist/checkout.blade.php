@extends('layouts.master')
 
@section('content')
@if (\Session::has('update_success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('update_success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('update_failed'))
    <div class="alert" style = "background:red;">
        <ul>
            <li>{!! \Session::get('update_failed') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('failed'))
    <div class="alert" style = "background:red;">
        <ul>
            <li>{!! \Session::get('failed') !!}</li>
        </ul>
    </div>
@endif
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9">
                <div class="col-main">
                    <div class="page-title">
                        <h1>Checkout</h1>
                    </div>
                    <ol class="one-page-checkout" id="checkoutSteps">
                        <li id="opc-billing" class="section allow active step_one_activate">
                            <div class="step-title"> <span class="number">1</span>
                                <h3>Checkout Method</h3>
                            </div>
                            <div id="checkout-step-billing" class="step a-item step-one" style="-">
                                {{-- <form id="co-billing-form"> --}}
                                    <fieldset class="group-select">
                                        <ul>
                                            <li>
                                                <label for="billing-address-select">Select a shipping address from your
                                                    address book or enter a new address.</label>
                                                <br>
                                                <select name="billing_address_id" id="billing-address-select" class="address-select"
                                                    title="" >
                                                    <option disabled value = "select_address" selected="selected">Select address</option>
                                                    <?php
                                                    if($user_data->address == "" ){ ?>
                                                    <?php }else{ ?>
                                                        <option value="primary" ><?= $user_data->address ?></option>
                                                    <?php }
                                                ?>
                                                    
                                                        
                                                        <?php
                                                            if($user_data->secondary_address == ""){ ?>
                                                                <option value = "new_add">New Address</option>
                                                            <?php }else{ ?>
                                                                <option value="secondary"><?= $user_data->secondary_address ?></option>
                                                            <?php }
                                                        ?>
                                                    {{-- <option>New Address</option> --}}
                                                </select>
                                            </li>
                                            <li id="billing-new-address-form" style = "display:none;">
                                                <fieldset>
                                                    <legend>New Address</legend>
                                                    {{-- <input type="hidden" name="billing[address_id]" value="4269" id="billing:address_id"> --}}
                                                    <ul> 
                                                        <?php
                                                            if($user = Auth::user()){ ?>

                                                                {!! Form::open(['action' => "FormsController@save_address_checkout"]) !!}
                                                                <li>
                                                                    <label>Address <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="text" title="Street Address" name="secondary_address"
                                                                        class="input-text">
                                                                </li>  
                                                                <li>
                                                                    <label>Email <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="email" title="email" name="secondary_email"
                                                                        class="input-text">
                                                                </li> 
                                                                <li>
                                                                    <p class="require"><em class="required">* </em>Required Fields</p>
                                                                    <button type="submit" class="button continue"  ><span>Save</span></button>
                                                                </li>
                                                                </form>

                                                           <?php }else{ ?>

                                                                {!! Form::open(['action' => "FormsController@save_address_checkout_guest"]) !!}
                                                                <li>
                                                                    <label>Name <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="text" title="name" name="name"
                                                                        class="input-text">
                                                                </li>
                                                                <li>
                                                                    <label>Address <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="text" title="Street Address" name="address"
                                                                        class="input-text">
                                                                </li>  
                                                                <li>
                                                                    <label>City <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="text" title="city" name="city"
                                                                        class="input-text">
                                                                </li>
                                                                <li>
                                                                    <label>Email <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="email" title="email" name="email"
                                                                        class="input-text">
                                                                </li> 
                                                                <li>
                                                                    <label>Phone <span class="required">*</span></label> 
                                                                </li>
                                                                <li>
                                                                    <input required type="text" maxlength="11" title="phone" name="phone"
                                                                        class="input-text">
                                                                </li>
                                                                <li>
                                                                    <p class="require"><em class="required">* </em>Required Fields</p>
                                                                    <button type="submit" class="button continue"  ><span>Save</span></button>
                                                                </li>
                                                                </form>

                                                            <?php }
                                                        ?>
                                                        
                                                        {{-- <li>
                                                            <input type="checkbox" name="billing[save_in_address_book]"
                                                                value="1" title="Save in address book" id="billing:save_in_address_book"
                                                                onChange="shipping.setSameAsBilling(false);" class="checkbox">
                                                            <label for="billing:save_in_address_book">Save in address
                                                                book</label>
                                                        </li> --}}
                                                    </ul>
                                                </fieldset>
                                            </li>
                                            {{-- <li>
                                                <input type="radio" name="billing[use_for_shipping]" id="billing:use_for_shipping_yes"
                                                    value="1" onClick="$('shipping:same_as_billing').checked = true;"
                                                    class="radio">
                                                <label for="billing:use_for_shipping_yes">Ship to this address</label>
                                                <input type="radio" name="billing[use_for_shipping]" id="billing:use_for_shipping_no"
                                                    value="0" checked="checked" onClick="$('shipping:same_as_billing').checked = false;"
                                                    class="radio">
                                                <label for="billing:use_for_shipping_no">Ship to different address</label>
                                            </li> --}}
                                        </ul>
                                        {{-- <p class="require"><em class="required">* </em>Required Fields</p> --}}
                                        <button type="button" class="button continue continue_checkout"  ><span>Continue</span></button>
                                    </fieldset>
                                {{-- </form> --}}
                            </div>
                        </li>
                        {{-- <li id="opc-shipping" class="section step_two_activate">
                            <div class="step-title"> <span class="number">2</span>
                                <h3 class="one_page_heading"> Shipping Information</h3>
                            </div>
                            <div id="checkout-step-shipping" class="step a-item step-two " >
                                <form id="co-shipping-form">
                                    <fieldset class="group-select">
                                        <ul>
                                            <li>
                                                <label for="shipping-address-select">Select a shipping address from
                                                    your address book or enter a new address.</label>
                                                <br>
                                                <select name="shipping_address_id" id="shipping-address-select" class="address-select"
                                                    title="" onChange="shipping.newAddress(!this.value)">
                                                    <option value="1" selected="selected">Stephen Doe, 1600 Duane
                                                        Avenue, Santa Clara, CA 95054</option>
                                                    <option>New Address</option>
                                                </select>
                                            </li>
                                            <li id="shipping-new-address-form" style="display: none;">
                                                <fieldset>
                                                    <input type="hidden" name="shipping[address_id]" id="shipping:address_id">
                                                    <ul>
                                                        <li>
                                                            <div class="customer-name">
                                                                <div class="input-box name-firstname">
                                                                    <label for="shipping:firstname"> First Name <span
                                                                            class="required">*</span> </label>
                                                                    <br>
                                                                    <input type="text" id="shipping:firstname" name="shipping[firstname]"
                                                                        title="First Name" class="input-text required-entry"
                                                                        onChange="shipping.setSameAsBilling(false)">
                                                                </div>
                                                                <div class="input-box name-lastname">
                                                                    <label for="shipping:lastname"> Last Name <span
                                                                            class="required">*</span> </label>
                                                                    <br>
                                                                    <input type="text" id="shipping:lastname" name="shipping[lastname]"
                                                                        title="Last Name" class="input-text required-entry"
                                                                        onChange="shipping.setSameAsBilling(false)">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="input-box">
                                                                <label for="shipping:company">Company</label>
                                                                <br>
                                                                <input type="text" id="shipping:company" name="shipping[company]"
                                                                    title="Company" class="input-text" onChange="shipping.setSameAsBilling(false);">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <label for="shipping:street1">Address <span class="required">*</span></label>
                                                            <br>
                                                            <input type="text" title="Street Address" name="shipping[street][]"
                                                                id="shipping:street1" class="input-text required-entry"
                                                                onChange="shipping.setSameAsBilling(false);">
                                                        </li>
                                                        <li>
                                                            <input type="text" title="Street Address 2" name="shipping[street][]"
                                                                id="shipping:street2" class="input-text" onChange="shipping.setSameAsBilling(false);">
                                                        </li>
                                                        <li>
                                                            <div class="input-box">
                                                                <label for="shipping:city">City <span class="required">*</span></label>
                                                                <br>
                                                                <input type="text" title="City" name="shipping[city]"
                                                                    class="input-text required-entry" id="shipping:city"
                                                                    onChange="shipping.setSameAsBilling(false);">
                                                            </div>
                                                            <div class="input-box">
                                                                <label for="shipping:region">State/Province <span class="required">*</span></label>
                                                                <br>
                                                                <select name="shipping[region_id]" title="State/Province"
                                                                    class="validate-select" style="">
                                                                    <option>Please select region, state or province</option>
                                                                    <option value="1">Alabama</option>
                                                                    <option value="2">Alaska</option>
                                                                    <option value="3">American Samoa</option>
                                                                    <option value="4">Arizona</option>
                                                                    <option value="5">Arkansas</option>
                                                                    <option value="6">Armed Forces Africa</option>
                                                                    <option value="7">Armed Forces Americas</option>
                                                                    <option value="8">Armed Forces Canada</option>
                                                                    <option value="9">Armed Forces Europe</option>
                                                                    <option value="10">Armed Forces Middle East</option>
                                                                    <option value="11">Armed Forces Pacific</option>
                                                                    <option value="12">California</option>
                                                                    <option value="13">Colorado</option>
                                                                    <option value="14">Connecticut</option>
                                                                    <option value="15">Delaware</option>
                                                                    <option value="16">District of Columbia</option>
                                                                    <option value="17">Federated States Of Micronesia</option>
                                                                    <option value="18">Florida</option>
                                                                    <option value="19">Georgia</option>
                                                                    <option value="20">Guam</option>
                                                                    <option value="21">Hawaii</option>
                                                                    <option value="22">Idaho</option>
                                                                    <option value="23">Illinois</option>
                                                                    <option value="24">Indiana</option>
                                                                    <option value="25">Iowa</option>
                                                                    <option value="26">Kansas</option>
                                                                    <option value="27">Kentucky</option>
                                                                    <option value="28">Louisiana</option>
                                                                    <option value="29">Maine</option>
                                                                    <option value="30">Marshall Islands</option>
                                                                    <option value="31">Maryland</option>
                                                                    <option value="32">Massachusetts</option>
                                                                    <option value="33">Michigan</option>
                                                                    <option value="34">Minnesota</option>
                                                                    <option value="35">Mississippi</option>
                                                                    <option value="36">Missouri</option>
                                                                    <option value="37">Montana</option>
                                                                    <option value="38">Nebraska</option>
                                                                    <option value="39">Nevada</option>
                                                                    <option value="40">New Hampshire</option>
                                                                    <option value="41">New Jersey</option>
                                                                    <option value="42">New Mexico</option>
                                                                    <option value="43">New York</option>
                                                                    <option value="44">North Carolina</option>
                                                                    <option value="45">North Dakota</option>
                                                                    <option value="46">Northern Mariana Islands</option>
                                                                    <option value="47">Ohio</option>
                                                                    <option value="48">Oklahoma</option>
                                                                    <option value="49">Oregon</option>
                                                                    <option value="50">Palau</option>
                                                                    <option value="51">Pennsylvania</option>
                                                                    <option value="52">Puerto Rico</option>
                                                                    <option value="53">Rhode Island</option>
                                                                    <option value="54">South Carolina</option>
                                                                    <option value="55">South Dakota</option>
                                                                    <option value="56">Tennessee</option>
                                                                    <option value="57">Texas</option>
                                                                    <option value="58">Utah</option>
                                                                    <option value="59">Vermont</option>
                                                                    <option value="60">Virgin Islands</option>
                                                                    <option value="61">Virginia</option>
                                                                    <option value="62">Washington</option>
                                                                    <option value="63">West Virginia</option>
                                                                    <option value="64">Wisconsin</option>
                                                                    <option value="65">Wyoming</option>
                                                                </select>
                                                                <input type="text" id="shipping:region" name="shipping[region]"
                                                                    title="State/Province" class="input-text required-entry"
                                                                    style="display: none;">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="input-box">
                                                                <label for="shipping:postcode">Zip/Postal Code <span
                                                                        class="required">*</span></label>
                                                                <br>
                                                                <input type="text" title="Zip/Postal Code" name="shipping[postcode]"
                                                                    id="shipping:postcode" class="input-text validate-zip-international required-entry"
                                                                    onChange="shipping.setSameAsBilling(false);">
                                                            </div>
                                                            <div class="input-box">
                                                                <label>Country <span class="required">*</span></label>
                                                                <br>
                                                                <select name="shipping[country_id]" class="validate-select"
                                                                    title="Country" onChange="shipping.setSameAsBilling(false);">
                                                                    <option value="AF">Afghanistan</option>
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
                                                                    <option value="HR">Croatia</option>
                                                                    <option value="CU">Cuba</option>
                                                                    <option value="CY">Cyprus</option>
                                                                    <option value="CZ">Czech Republic</option>
                                                                    <option value="CI">Côte d’Ivoire</option>
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
                                                                    <option value="HM">Heard Island and McDonald
                                                                        Islands</option>
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
                                                                    <option value="KP">North Korea</option>
                                                                    <option value="MP">Northern Mariana Islands</option>
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
                                                                    <option value="RO">Romania</option>
                                                                    <option value="RU">Russia</option>
                                                                    <option value="RW">Rwanda</option>
                                                                    <option value="RE">Réunion</option>
                                                                    <option value="BL">Saint Barthélemy</option>
                                                                    <option value="SH">Saint Helena</option>
                                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                                    <option value="LC">Saint Lucia</option>
                                                                    <option value="MF">Saint Martin</option>
                                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                                    <option value="WS">Samoa</option>
                                                                    <option value="SM">San Marino</option>
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
                                                                    <option value="GS">South Georgia and the South
                                                                        Sandwich Islands</option>
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
                                                                    <option value="ST">São Tomé and Príncipe</option>
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
                                                                    <option value="UM">U.S. Minor Outlying Islands</option>
                                                                    <option value="VI">U.S. Virgin Islands</option>
                                                                    <option value="UG">Uganda</option>
                                                                    <option value="UA">Ukraine</option>
                                                                    <option value="AE">United Arab Emirates</option>
                                                                    <option value="GB">United Kingdom</option>
                                                                    <option value="US" selected="selected">United
                                                                        States</option>
                                                                    <option value="UY">Uruguay</option>
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
                                                                    <option value="AX">Åland Islands</option>
                                                                </select>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="input-box">
                                                                <label for="shipping:telephone">Telephone <span class="required">*</span></label>
                                                                <br>
                                                                <input type="text" name="shipping[telephone]" title="Telephone"
                                                                    class="input-text required-entry" id="shipping:telephone"
                                                                    onChange="shipping.setSameAsBilling(false);">
                                                            </div>
                                                            <div class="input-box">
                                                                <label for="shipping:fax">Fax</label>
                                                                <br>
                                                                <input type="text" name="shipping[fax]" title="Fax"
                                                                    class="input-text" id="shipping:fax" onChange="shipping.setSameAsBilling(false);">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="shipping[save_in_address_book]"
                                                                value="1" title="Save in address book" id="shipping:save_in_address_book"
                                                                onChange="shipping.setSameAsBilling(false);" class="checkbox">
                                                            <label for="shipping:save_in_address_book">Save in address
                                                                book</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="shipping[same_as_billing]"
                                                                value="1" onClick="shipping.setSameAsBilling(this.checked)"
                                                                class="checkbox">
                                                            <label>Use Billing Address</label>
                                                        </li>
                                                    </ul>
                                                </fieldset>
                                            </li>
                                        </ul>
                                        <p class="require"><em class="required">* </em>Required Fields</p>
                                        <div class="buttons-set1" id="shipping-buttons-container">
                                            <button type="button" class="button" onClick="shipping.save()"><span>Continue</span></button>
                                            <a href="#" onClick="checkout.back(); return false;" class="back-link">«
                                                Back</a> </div>
                                    </fieldset>
                                </form>
                            </div>
                        </li> --}}
                        <li id="opc-shipping_method" class="section step_two_activate">
                            <div class="step-title"> <span class="number">2</span>
                                <h3 class="one_page_heading">Shipping Method</h3>
                            </div>
                            <div id="checkout-step-shipping_method" class="step a-item step-two" style = "display:none;"  >
                                <form id="co-shipping-method-form">
                                    <fieldset>
                                        <div id="checkout-shipping-method-load">
                                            <dl class="shipping-methods">
                                                <dt>Flat Rate</dt>
                                                <dd>
                                                    <ul>
                                                        <li>
                                                            <input type="radio" name="shipping_method" value="200"
                                                                id="s_method_flatrate_flatrate" checked="checked" class="radio">
                                                            <label for="s_method_flatrate_flatrate">Fixed <span class="price">PKR : 200</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </dd>
                                            </dl>
                                        </div> 
                                        <div class="buttons-set1" id="shipping-method-buttons-container">
                                            <button type="button" class="button shipping_method_continue" ><span>Continue</span></button>
                                            <a class="back-link" id = "section_two">«
                                                Back</a> </div>
                                    </fieldset>
                                </form>
                            </div>
                        </li>


                        <li id="opc-payment" class="section step_three_activate">
                            <div class="step-title"> <span class="number">3</span>
                                <h3 class="one_page_heading">Payment Information</h3>
                            </div>
                            <div id="checkout-step-payment" class="step a-item step-three"  style = "display:none;"  >
                                <form id="co-payment-form">
                                    <dl id="checkout-payment-method-load"> 
                                        <dt>
                                            <input type="radio" id="p_method_ccsave" value="credit card" name="payment[method]"
                                                title="Credit Card (saved)"  checked class="radio radio_payment_info">
                                            <label for="p_method_ccsave">Credit Card (saved)</label>
                                        </dt>
                                        <dd>
                                            <fieldset class="form-list">
                                                <ul id="payment_form_ccsave"  >
                                                    <li>
                                                        <div class="input-box">
                                                            <label for="ccsave_cc_owner">Name on Card <span class="required">*</span></label>
                                                            <br>
                                                            <input type="text"  title="Name on Card" class="input-text required-entry"
                                                                id="ccsave_cc_owner" name="payment[cc_owner]">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="input-box">
                                                            <label for="ccsave_cc_type">Credit Card Type <span class="required">*</span></label>
                                                            <br>
                                                            <select id="ccsave_cc_type" name="payment[cc_type]"
                                                                class="required-entry validate-cc-type-select">
                                                                <option>--Please Select--</option>
                                                                <option value="DC">Debit Card</option>
                                                                <option value="VI">Visa</option>
                                                                <option value="MC">MasterCard</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="input-box">
                                                            <label for="ccsave_cc_number">Credit Card Number <span
                                                                    class="required">*</span></label>
                                                            <br>
                                                            <input type="text"  id="ccsave_cc_number" name="payment[cc_number]"
                                                                title="Credit Card Number" class="input-text validate-cc-number validate-cc-type">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="input-box">
                                                            <label for="ccsave_expiration">Expiration Date <span class="required">*</span></label>
                                                            <br>
                                                            <div class="v-fix">
                                                                <select   id="ccsave_expiration" style="width: 140px;"
                                                                    name="payment[cc_exp_month]" class="required-entry">
                                                                    <option selected="selected">Month</option>
                                                                    <option value="1">01 - January</option>
                                                                    <option value="2">02 - February</option>
                                                                    <option value="3">03 - March</option>
                                                                    <option value="4">04 - April</option>
                                                                    <option value="5">05 - May</option>
                                                                    <option value="6">06 - June</option>
                                                                    <option value="7">07 - July</option>
                                                                    <option value="8">08 - August</option>
                                                                    <option value="9">09 - September</option>
                                                                    <option value="10">10 - October</option>
                                                                    <option value="11">11 - November</option>
                                                                    <option value="12">12 - December</option>
                                                                </select>
                                                            </div>
                                                            <div class="v-fix">
                                                                <select  id="ccsave_expiration_yr" style="width: 103px;"
                                                                    name="payment[cc_exp_year]" class="required-entry">
                                                                    <option selected="selected">Year</option>
                                                                    <option value="2011">2011</option>
                                                                    <option value="2012">2012</option>
                                                                    <option value="2013">2013</option>
                                                                    <option value="2014">2014</option>
                                                                    <option value="2015">2015</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="input-box">
                                                            <label for="ccsave_cc_cid">Card Verification Number (CVV) <span
                                                                    class="required">*</span></label>
                                                            <br>
                                                            <div class="v-fix">
                                                                <input type="text"   title="Card Verification Number"
                                                                    class="input-text required-entry validate-cc-cvn"
                                                                    id="ccsave_cc_cid" name="payment[cc_cid]" style="width: 3em;">
                                                            </div> 
                                                        </div>
                                                    </li>
                                                </ul>
                                            </fieldset>
                                        </dd>
                                    </dl>
                                    <p class="require"><em class="required">* </em>Required Fields</p>
                                <div class="buttons-set1" id="payment-buttons-container">
                                    <button type="button" class="button payment_info_continue"  ><span>Continue</span></button>
                                    <a   class="back-link" id = "section_three">« Back</a>
                                </div>
                                <div style="clear: both;"></div>
                                </form>
                                
                            </div>
                        </li>

                        <li id="opc-review" class="section step_four_activate">
                            <div class="step-title"> <span class="number">4</span>
                                <h3 class="one_page_heading">Order Review</h3>
                            </div>
                            <div id="checkout-step-review" class="step a-item step-four"  style = "display:none;"   >
                                <div class="order-review" id="checkout-review-load"> </div>
                                <div class="buttons-set13" id="review-buttons-container">
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
                                                        <?php
                                                            if(isset($_COOKIE['C-D'])){ ?>
                                                                <h1>Coupon Applied</h1>
                                                            <?php }
                                                        ?>
                                                        
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
                                                                <?php echo $detail->quantity; ?>
                                                            </td>
                                                            <td class="a-right movewishlist"><span class="cart-price">PKR : <span class="price product_subtotal"><?php
                                                             if($detail->product_discount == "") {
                                                                echo $detail->product_sale_price * $detail->quantity ;
                                                            }else{
                                                                $total_price = $detail->product_sale_price;
                                                                $discount = $total_price - $detail->product_discount;
                                                                echo $discount * $detail->quantity ;
                                                            }
                                                            ?></span>
                                                                </span></td> 
                                                        </tr>
                                                        <?php }
                                                    ?> 
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                            
                                            <h1 class = "grand_total"> </h1>
                                    {{-- {!! Form::open(['action' => "FormsController@place_order"]) !!} --}}
                                    <a href="/">Forgot an Item?</a> <br>
                                    <button type="submit" class="button place_order_btn"  ><span>Place Order</span></button>
                                        {{-- </form> --}}
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </section>
            <aside class="col-right sidebar col-sm-3 col-xs-12">
                <div class="block block-progress">
                    <div class="block-title ">Your Checkout</div>
                    <div class="block-content">

                        <?php
                            if(empty($user_data)){

                            }else{ ?>


                        <dl>
                            <dt class="complete"> Primary Address 
                            </dt>
                            <dd class="complete">
                                <address>
                                    <?= $user_data->first_name. " " .$user_data->last_name?><br>
                                    <?= $user_data->address ?><br>
                                    <?= $user_data->city ?><br>
                                    <?= $user_data->country ?><br>
                                    <?= "T: " .$user_data->phone ?> <br>
                                </address>
                            </dd>
                            <dt class="complete"> Shipping Address
                            </dt>
                            <dd class="complete">
                                <address>
                                    <?= $user_data->first_name. " " .$user_data->last_name?><br>
                                    <?= $user_data->address ?><br>
                                    <?= $user_data->city ?><br>
                                    <?= $user_data->country ?><br>
                                    <?= "T: " .$user_data->phone ?> <br>
                                </address>
                            </dd>
                            <dt class="complete"> Shipping Method
                            </dt>
                            <dd class="complete"> Flat Rate - Fixed <br>
                                <span class="price">PKR 200</span> </dd>
                            <dt> Payment Method </dt>

                        </dl>

                        <?php }
                        ?>

                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
