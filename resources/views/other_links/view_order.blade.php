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
                            <h2>View Order</h2>
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
                                                        <th>Product Name</th>
                                                        <th>Unit Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                        <th>Order#</th>
                                                    </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                                if($order_data->isEmpty()){

                                                }else{  
                                                    foreach($order_data as $data){ ?>
                                                <tr class="first odd" >
                                                        <td><?= $data->name ?></td>
                                                        <td><?= $data->unit_price ?> </td>
                                                        <td><?= $data->quantity ?></td>
                                                        <td><?= $data->total_price ?></td>
                                                        <td><?= $data->order_id ?></td>
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
