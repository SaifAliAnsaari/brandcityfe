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

<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9">
                <div class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>My Dashboard</h2>
                        </div>
                        <div class="dashboard">
                            <div class="welcome-msg"> <strong>Hello,
                                    <?= $account_info->first_name  ?></strong>
                                <p>From your My Account Dashboard you have the ability to view a snapshot of your
                                    recent account activity and update your account information. Select a link below to
                                    view or edit information.</p>
                            </div>
                            <div class="recent-orders">
                                <div class="title-buttons"><strong>Recent Orders</strong> <a href="/orders">View All </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="data-table" id="my-orders-table">
                                        <col>
                                        <col>
                                        <col>
                                        <col width="1">
                                        <col width="1">
                                        <col width="1">
                                        <thead>
                                            <tr class="first last">
                                                <th>Order #</th>
                                                <th>Date</th>
                                                <th>Shop by</th>
                                                <th><span class="nobr">Order Total</span></th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php 
                                                    if($orders_detail->isEmpty()){

                                                    }else{
                                                        foreach ($orders_detail as $orders) { ?>
                                                        <tr class="first odd">
                                                            <td><?= $orders->order_id ?></td>
                                                            <td><?= $orders->date ?> </td>
                                                            <td><?= $orders->first_name. " " .$orders->last_name ?></td>
                                                            <td><span class="price"><?= $orders->total_price ?></span></td>
                                                            <td><em>Pending</em></td>
                                                            <td class="a-center last"><span class="nobr"> <a href="/view_order/<?= $orders->order_id ?>">View Order</a>
                                                                    </span></td>
                                                        </tr>
                                                       <?php }
                                                    }
                                                ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-account">
                                <div class="page-title">
                                    <h2>Account Information</h2>
                                </div>
                                <div class="col2-set">
                                    <div class="col-1">
                                        {!! Form::open(['action' => "FormsController@contact_info"]) !!}
                                        <h5>Contact Information</h5>
                                        <a class = "edit_contact_info">Edit</a>
                                        <p>
                                            <span class = "name_contact_info">
                                            Name :
                                            <?= $account_info->first_name. " " .$account_info->last_name ?> </span>
                                            <input required type="text"  value = " <?= $account_info->first_name ?>" name = "contact_info_firstname" class = "form-control inputFirstName_contact_info" style = "width:50%; display: none"/> <br>
                                            <input required type="text"  value = "<?= $account_info->last_name ?>" name = "contact_info_lastname" class = "form-control inputLastName_contact_info" style = "width:50%; display: none"/> <br>
                                            <span class = "email_contact_info">
                                            Email :
                                            <?= $account_info->email ?> </span>
                                            <input required type="email" value = "<?= $account_info->email ?>" name = "contact_info_email" class = "form-control inputEmail_contact_info" style = "width:50%; display: none" /> <br>
                                            {{-- <a href="#">Change Password</a> --}}
                                        </p>
                                            <button style="display: none" class="save_contact_info" title="save" type="submit"><span>Save</span></button>
                                        </form>
                                    </div>
                                    
                                    <div class="col-2">
                                        <h5>Newsletters</h5>
                                        <?php
                                            if(empty($subscription)){ ?>
                                        <p> You have not subscribed to any newsletter. </p>
                                        <?php }else{ ?>
                                            <a class = "deactivate_subscription"><span>Deactivate Subscription<span></a>
                                            <p> You are a subscriber. </p>
                                        <?php }
                                        ?>
 

                                </div>
                                <div class="col2-set">
                                    
                                    
                                    <div class="col-1">
                                        <h4>Primary Billing Address</h4>
                                        <address>
                                            {!! Form::open(['action' => "FormsController@billing_address"]) !!}
                                                <span class = "billing_address_detail"> Email :
                                                <?= $account_info->email ?></span><br>
                                                <span hidden class = "input_billing_address">Email : </span> <br>
                                                <input required type="email" value = "<?= $account_info->email ?>" name = "billling_address_email" class = "input_billing_address form-control" style = "width:50%; display: none" />
                                                <span class = "billing_address_detail"> Country :
                                                <?= $account_info->country ?></span><br>
                                                <span hidden class = "input_billing_address">Country : </span><br>
                                                <input hidden required type="text" value = "<?= $account_info->country ?>" name = "billling_address_country" class = "input_billing_address form-control" style = "width:50%; display: none" />
                                                <span class = "billing_address_detail"> Address :
                                                <?= $account_info->address ?></span><br>
                                                <span hidden class = "input_billing_address">Address : </span><br>
                                                <input hidden required type="text" value = "<?= $account_info->address ?>" name = "billling_address_address" class = "input_billing_address form-control" style = "width:50%; display: none" />
                                                <span class = "billing_address_detail">City :
                                                <?= $account_info->city ?></span><br>
                                                <span hidden class = "input_billing_address">City : </span><br>
                                                <input hidden required type="text" value = "<?= $account_info->city ?>" name = "billling_address_city" class = "input_billing_address form-control" style = "width:50%; display: none" />
                                                <span class = "billing_address_detail"> Phone :
                                                <?= $account_info->phone ?> </span><br>
                                                <span hidden class = "input_billing_address">Phone : </span><br>
                                                <input hidden required type="text" value = "<?= $account_info->phone ?>" name = "billling_address_phone" class = "input_billing_address form-control" style = "width:50%; display: none" />
                                                <a class = "edit_primary_billing_address">Edit Address</a>
                                                <br>
                                                <button style = "display: none" class="input_billing_address" title="save" type="submit"><span>Save</span></button>
                                            </form>
                                        </address>
                                    </div>
                                    <div class="col-2">
                                        <h5>Shipping Address</h5>
                                        <span style = "color:darkgrey; font-size:10px;">You can change shipping address in CHECKOUT section</span>
                                        <address>
                                            Name :
                                            <?= $account_info->first_name. " " .$account_info->last_name ?><br>
                                            Country :
                                            <?= $account_info->country ?><br>
                                            Address :
                                            <?= $account_info->address ?><br>
                                            City :
                                            <?= $account_info->city ?><br>
                                            Phone :
                                            <?= $account_info->phone ?> <br>
                                            {{-- <a href="#">Edit Address</a> --}}
                                        </address>
                                    </div>

                                    <h4>Address Book</h4>
                                    <div class="manage_add"><a>Manage Addresses</a> <br>
                                        {!! Form::open(['action' => "FormsController@manage_address"]) !!}
                                        <span hidden  class = "input_manage_address">Primary Address : </span> <br>
                                        <input type = "text" value = "<?= $account_info->address ?>" class = "form-control input_manage_address" name = "primary_add" style = "width:25%; display: none" required/>
                                        <span hidden  class = "input_manage_address">Secondary Address : </span> <br>
                                        <input type = "text" value = "<?= $account_info->secondary_address ?>" class = "form-control input_manage_address" name = "secondary_add" style = "width:25%; display: none;" required/>
                                        <button style = "display: none" class="input_manage_address btn btn-primary" title="save" type="submit"><span>Save</span></button>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="col-right sidebar col-sm-3 col-xs-12">
                <div class="block block-account">
                    <div class="block-title">My Account</div>
                    <div class="block-content">
                        <ul> 
                            <li class="current"><a >Account Information</a></li>
                            <li><a href="#">Address Book</a></li>
                            <li><a href="/orders">My Orders</a></li>
                            {{-- <li><a href="#">Billing Agreements</a></li>
                            <li><a href="#">Recurring Profiles</a></li>
                            <li><a href="#">My Product Reviews</a></li> --}}
                            <li><a href="/wishlist">My Wishlist</a></li>
                            <li class="last"><a href="#">Newsletter Subscriptions</a></li>
                        </ul>
                    </div>
                </div>
                
            </aside>
        </div>
    </div>
</div>

@endsection
