@extends('layouts.master')

@section('content')
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9">
                <div class="col-main">
                    <div class="page-title">
                        <h2>Contact Us</h2>
                    </div>
                    <div class="static-contain">
                        <fieldset class="group-select">
                            <ul>
                                <li id="billing-new-address-form">
                                    <fieldset>
                                        <input type="hidden" name="billing[address_id]" id="billing:address_id">
                                        <ul>
                                            <li>
                                                <div class="customer-name">
                                                    <div class="input-box name-firstname">
                                                        <label for="billing:firstname"> First Name<span class="required">*</span></label>
                                                        <br>
                                                        <input type="text" id="billing:firstname" name="billing[firstname]"
                                                            title="First Name" class="input-text ">
                                                    </div>
                                                    <div class="input-box name-lastname">
                                                        <label for="billing:lastname"> Email Address <span class="required">*</span>
                                                        </label>
                                                        <br>
                                                        <input type="text" id="billing:lastname" name="billing[lastname]"
                                                            title="Last Name" class="input-text">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="input-box">
                                                    <label>Company</label>
                                                    <br>
                                                    <input type="text" name="billing[company]" title="Company" class="input-text">
                                                </div>
                                                <div class="input-box">
                                                    <label for="billing:email">Telephone <span class="required">*</span></label>
                                                    <br>
                                                    <input type="text" name="billing[email]" id="billing:email" title="Email Address"
                                                        class="input-text validate-email">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Address <span class="required">*</span></label>
                                                <br>
                                                <input type="text" title="Street Address" name="billing[street][]"
                                                    class="input-text required-entry">
                                            </li>
                                            <li>
                                                <input type="text" title="Street Address 2" name="billing[street][]"
                                                    class="input-text required-entry">
                                            </li>
                                            <li class="">
                                                <label for="comment">Comment<em class="required">*</em></label>
                                                <br>
                                                <div style="float:none" class="">
                                                    <textarea name="comment" id="comment" title="Comment" class="required-entry input-text"
                                                        cols="5" rows="3"></textarea>
                                                </div>
                                            </li>
                                        </ul>
                                    </fieldset>
                                </li>
                                <li>
                                    <p class="require"><em class="required">* </em>Required Fields</p>

                                    <div class="buttons-set">
                                        <button type="submit" title="Submit" class="button submit"> <span> Submit
                                            </span> </button>
                                    </div>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                </div>
            </section>
            <aside class="col-right sidebar col-sm-3 col-xs-12">
                <div class="block block-company">
                    <div class="block-title">Company </div>
                    <div class="block-content">
                        <ol id="recently-viewed-items">
                            <li class="item odd"><a href="#">About Us</a></li>
                            <li class="item even"><a href="#">Sitemap</a></li>
                            <li class="item  odd"><a href="#">Terms of Service</a></li>
                            {{-- <li class="item even"><a href="#">Search Terms</a></li> --}}
                            <li class="item last"><strong>Contact Us</strong></li>
                        </ol>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
