<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Cookie;
use Redirect;

class FormsController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // parent::__construct();
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact_info(Request $request){
        if(Auth::id()){
            $update = DB::table('users')
            ->whereRaw('id = "'.Auth::id().'" ')
            ->update(['first_name' => $request->contact_info_firstname,
                'last_name' => $request->contact_info_lastname,
                'email' => $request->contact_info_email
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
        }else{
            $update = DB::table('guest_info')
            ->whereRaw(' session = "'.cookie::get('GI').'" ')
            ->update(['first_name' => $request->contact_info_firstname,
                'last_name' => $request->contact_info_lastname,
                'email' => $request->contact_info_email
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }   
        }
    }  
    
    public function billing_address(Request $request){
        if(Auth::id()){
            $update = DB::table('users')
            ->whereRaw('id = "'.Auth::id().'" ')
            ->update(['email' => $request->billling_address_email,
                'country' => $request->billling_address_country,
                'address' => $request->billling_address_address,
                'city' => $request->billling_address_city,
                'phone' => $request->billling_address_phone
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
        }else{
            $update = DB::table('guest_info')
            ->whereRaw('session = "'.cookie::get('GI').'"')
            ->update(['email' => $request->billling_address_email,
                'country' => $request->billling_address_country,
                'address' => $request->billling_address_address,
                'city' => $request->billling_address_city,
                'phone' => $request->billling_address_phone
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
        }
    }

    public function manage_address(Request $request){
        $update = DB::table('users')
            ->whereRaw('id = "'.Auth::id().'" ')
            ->update(['address' => $request->primary_add,
                'secondary_address' => $request->secondary_add
                ]);
            if($update){
                return redirect()->back()->with('update_success', 'Updated successfully!'); 
            }else{
                return redirect()->back()->with('update_failed', 'Unable to update, try again!');
            }
    }

    public function save_address_checkout(Request $request){
        if(Auth::id()){
            $select_p_address = DB::table('users')->select('address')->whereRaw('id = "'.Auth::id().'" ')->first();
            if(empty($select_p_address)){
                $update = DB::table('users')
                ->whereRaw('id = "'.Auth::id().'" ')
                ->update(['secondary_address' => $request->secondary_address,
                    'secondary_email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }else{
                $update = DB::table('users')
                ->whereRaw('id = "'.Auth::id().'" ')
                ->update(['address' => $request->secondary_address,
                    'email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }
            
        }else{
            $select_p_address = DB::table('guest_info')->select('address')->whereRaw('session = "'.cookie::get('GI').'" ')->first();
            if(empty($select_p_address)){
                $update = DB::table('guest_info')
                ->whereRaw('session = "'.cookie::get('GI').'" ')
                ->update(['secondary_address' => $request->secondary_address,
                    'secondary_email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }else{
                $update = DB::table('guest_info')
                ->whereRaw('session = "'.cookie::get('GI').'" ')
                ->update(['address' => $request->secondary_address,
                    'email' => $request->secondary_email
                    ]);
                if($update){
                    return redirect()->back()->with('update_success', 'Updated successfully!'); 
                }else{
                    return redirect()->back()->with('update_failed', 'Unable to update, try again!');
                }
            }
           
        }
       
    }

}
