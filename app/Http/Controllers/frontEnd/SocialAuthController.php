<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Customer;
use Socialite;
use Session;
use Cart;
use App\SocialCustomer;
class SocialAuthController extends Controller
{
     public function redirect($provider)
    {
       return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        
        $getInfo = Socialite::driver($provider)->user();
        $findcustomer= Customer::orWhere('provider_id',$getInfo->id)->orWhere('email',$getInfo->email)->first();
        if(!$findcustomer){
             $randnumber = Str::random(8);
             $customer              =   new Customer();
             $customer->fullName    =   $getInfo->name;
             $customer->email       =   $getInfo->email;
             $customer->provider    =   $provider;
             $customer->provider_id =   $getInfo->id;
             $customer->phoneNumber =   $getInfo->id;
             $customer->status      =   1;
             $customer->verifyToken =   1;
             $customer->password =   bcrypt($randnumber);
             $customer->save();
            Toastr::success('Thanks', 'Thanks you are login successfully');
            Session::put('customerId',$customer->id);
            if(Cart::instance('shopping')->count()!=0){
            return redirect('show-cart');
            }else{
                return redirect('/customer/account');
            }
            
        }else{
            Session::put('customerId',$findcustomer->id);
            if(Cart::instance('shopping')->count()!=0){
                return redirect('show-cart');
            }else{
                return redirect('/customer/account');
            }
        }
        
    }
}
