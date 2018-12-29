@extends('layouts.master')

@section('content')

<div class="box-reviews2 container">
    <div class = "row">
        <div class = "col-md-2"></div>
        <div class = "col-md-8">
                <h3>Customer Reviews</h3>
                <div class="box visible">
                  <ul>
                      <?php
                        if(!empty($reviews)){
                            foreach ($reviews as $reviews) { ?>
                               <li style = "margin-bottom:20px;">
                                    <table class="ratings-table">
                                      <tbody>
                                        <tr>
                                          <th>Value</th>
                                          <td> <?php
                                            if($reviews->value == 1){ ?>
                                            <div class="rating-box">
                                                    <div class="rating" style="width:20%;"></div>
                                                </div>
                                            <?php }else if($reviews->value == 2){ ?>
                                                <div class="rating-box">
                                                        <div class="rating" style="width:40%;"></div>
                                                    </div>
                                            <?php }else if($reviews->value == 3){ ?>
                                                <div class="rating-box">
                                                        <div class="rating" style="width:60%;"></div>
                                                    </div>
                                            <?php }else if($reviews->value == 4){ ?>
                                                <div class="rating-box">
                                                        <div class="rating" style="width:80%;"></div>
                                                    </div>
                                            <?php }else if($reviews->value == 5){ ?>
                                                <div class="rating-box">
                                                        <div class="rating" style="width:100%;"></div>
                                                    </div>
                                            <?php }
                                        ?></td>
                                        </tr>
                                        <tr>
                                          <th>Quality</th>
                                          <td><?php 
                                            if($reviews->quality == 1){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:20%;"></div>
                                                </div>
                                            <?php }else if($reviews->quality == 2){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:40%;"></div>
                                                </div>
                                            <?php }else if($reviews->quality == 3){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:60%;"></div>
                                                </div>
                                            <?php }else if($reviews->quality == 4){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:80%;"></div>
                                                </div>
                                            <?php }else if($reviews->quality == 5){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:100%;"></div>
                                                </div>
                                            <?php }
                                        ?></td>
                                        </tr>
                                        <tr>
                                          <th>Price</th>
                                          <td><?php 
                                            if($reviews->price == 1){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:20%;"></div>
                                                </div>
                                            <?php }else if($reviews->price == 2){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:40%;"></div>
                                                </div>
                                            <?php }else if($reviews->price == 3){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:60%;"></div>
                                                </div>
                                            <?php }else if($reviews->price == 4){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:80%;"></div>
                                                </div>
                                            <?php }else if($reviews->price == 5){ ?>
                                                <div class="rating-box">
                                                    <div class="rating" style="width:100%;"></div>
                                                </div>
                                            <?php }
                                        ?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <div class="review">
                                            <h6><a ><?= $reviews->summary?></a></h6>
                                            <small>Review by <span><?= $reviews->nick_name?> </span>on <?= $reviews->created_at ?>
                                            </small>
                                            <div class="review-txt"> <?= $reviews->review?></div>
                                        </div>
                                  </li>
                           <?php }
                        }
                      ?>
                    
            
                    
                  </ul>
                </div>
        </div>
        <div class = "col-md-2"></div>
    </div>
  </div>

@endsection