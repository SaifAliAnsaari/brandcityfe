<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ParentController;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends ParentController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showResetForm(){
        parent::navFunction();
        return view('auth.passwords.reset')->with(['cart_detail' => $this->get_cart_items_detail, 'all_product_cats' => $this->get_all_productCats,
        'nav_links' => $this->navigationData]);
    }
}