@extends('layouts.master')

@section('content')

<?php if($user = Auth::user()){ ?>
    <input type="text" value="<?= Auth::id() ?>" class="user_id" hidden>
    <?php }else { ?>
    <input type="text" value="guest_user" class="user_id" hidden>
    <?php } ?>

  <section class="content-wrapper">
        <div class="container">
          <div class="std">
            <div class="page-not-found">
              <h2>404</h2>
              <h3><img src="/resources/images/signal.png" alt="404 error">Oops! The Page you requested was not found!</h3>
              <div><a href="/" class="btn-home"><span>Back To Home</span></a></div>
            </div>
          </div>
        </div>
      </section>
 @endsection