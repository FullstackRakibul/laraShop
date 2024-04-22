<?php

namespace App\Http\Middleware;

use Closure;
use App\Customer;
use Session;
class ValidCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validCustomer=Customer::where(['id'=>Session::get('customerId'),'status'=>1,'verifyToken'=>1])->first();
        if($validCustomer!=NULL) {
            if($validCustomer->verifyToken==1){
            return $next($request); 
            }else{
                Toastr::error('Sorry, Your account is not verified.','Opps!!');
                return redirect('customer/verify');
            }  
        }else{
            return redirect('customer/login');
        }
    }
}
