@extends('layouts.master')

@section('content')

<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <div class = "col-sm-2"></div>
            <section class="col-sm-8">
                <div class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>My Orders</h2>
                        </div>
                        <div class="dashboard">
                           
                            <div class="recent-orders">
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
                                                if($order_data->isEmpty()){

                                                }else{  
                                                    foreach($order_data as $data){ ?>
                                                <tr class="first odd" >
                                                        <td><?= $data->order_id ?></td>
                                                        <td><?= $data->date ?> </td>
                                                        <td><?= $data->first_name. " " .$data->last_name ?></td>
                                                        <td><span class="price"><?= $data->total_price ?></span></td>
                                                        <td><em>Pending</em></td>
                                                        <td class="a-center last"><span class="nobr"> <a href="/view_order/<?= $data->order_id ?>">View Order</a>
                                                                </span></td>
                                                </tr>
                                                <?php } }
                                            ?>
                                            
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </section>
            <div class = "col-sm-2"></div>
        </div>
    </div>
</div>

@endsection
