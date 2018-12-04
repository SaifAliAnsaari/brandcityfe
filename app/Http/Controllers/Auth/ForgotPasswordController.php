<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ParentController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends ParentController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm(){
        parent::navFunction();
        return view('auth.passwords.email')->with(['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }

    // public function sendResetLinkEmail(){
    //     parent::navFunction();
    //     return view('auth.passwords.email')->with(['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
    //     'nav_links' => $this->navigationData]);
    // }
}
