<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Customer;
use App\Shipping;
use App\Area;
use App\Order;
use App\Payment;
use App\Orderdetails;
use App\Shippingfee;
use Cart;
use Session;
use App\Post;
use App\Shippingaddress;
use Mail;
use File;
use Auth;
use Exception;
use DB;
class CustomerController extends Controller
{
    private function customers(){
        $customer=Customer::get();
        return $customer;
    }
    public function customerRegister(Request $request){
		
    	 $customerEmail=Customer::where('email',$request->email)->first();
    	 $customerPhone=Customer::where('phoneNumber',$request->phoneNumber)->first();
    	 if($customerEmail && $customerPhone){
    	   Toastr::error('message', 'Email Already Exist');
    	   Toastr::error('message', 'Phone Number Already Exist');
    	     $this->validate($request,[
                'email'=>'unique:customers',
                'phoneNumber'=>'required|unique:customers',
            ]);
    	   return redirect()->back();
    	 
    	 }elseif($customerEmail){
    	     Toastr::error('message', 'Email Already Exist');
    	     $this->validate($request,[
                'email'=>'unique:customers',
            ]);
    	   return redirect()->back();
    	 }elseif($customerPhone){
    	   Toastr::error('message', 'Phone Number Already Exist');
    	   $this->validate($request,[
                'phoneNumber'=>'required|unique:customers',
            ]);
    	   return redirect()->back();
    	 }else{
      		 $verifyToken=rand(111111,999999);
      		 $store_data				= 	new Customer();
             $store_data->fullName      =   $request->fullName;
    	     $store_data->phoneNumber 	=	$request->phoneNumber;
             $store_data->email         = $request->email;
    	     $store_data->verifyToken 	=	1;
    	     $store_data->status 	    =	1;
    	     $store_data->password 		=	bcrypt(request('password'));
    	     $store_data->save();

          // customer id put
          $customerId=$store_data->id;
          Session::put('customerId',$customerId);
          
        //   if($store_data->email !=NULL){
        //       $data=$store_data->toArray();
        //         $send = Mail::send('frontEnd.emails.register', $data, function($textmsg) use ($data){
        //           $textmsg->to($data['email']);
        //           $textmsg->subject('Account Create Successfully');
        //         });
        //   }
          Toastr::success('message', 'Your information add successfully!');
          return redirect('customer/account');
    	 }
    }
    public function registerPage(){
      return view('frontEnd.layouts.pages.customer.register');
    }
    public function customerLoginPage(){
      return view('frontEnd.layouts.pages.customer.login');
    }
    public function customerLogin(Request $request){
       $customerCheck =Customer::orWhere('email',$request->phoneOremail)
       ->orWhere('phoneNumber',$request->phoneOremail)
       ->first();
        if($customerCheck){
          if($customerCheck->status == 0){
            Toastr::success('message', 'Opps! your account has been suspends');
             return redirect()->back();
         }else{
          if(password_verify($request->password,$customerCheck->password)){
            if(Cart::instance('shopping')->count()!=0){
                    $customerId = $customerCheck->id;
                    Session::put('customerId',$customerId);
               Toastr::success('congratulation you login successfully', 'success!');
               return redirect('/checkout');
            }else{
              $customerId = $customerCheck->id;
                   Session::put('customerId',$customerId);
                   Toastr::success('congratulation you login successfully', 'success!');
              return redirect('/customer/account');
            }
          }else{
            Toastr::error('message', 'Opps! your password wrong');
              return redirect()->back();
          }

           }
        }else{
          Toastr::error('message', 'Sorry! You have no account');
          return redirect()->back();
        }
       
    }

    public function customerVerifyForm(){
        $customerId = Session::get('vcustomerId');
        if($customerId==!Null){
        return view('frontEnd.layouts.pages.customer.verify');
        }
        return redirect('/');
    }

    public function customerVerify(Request $request){
        $this->validate($request,[
            'verifyPin'=>'required',
        ]);
        $verified=Customer::where('id',Session::get('vcustomerId'))->first();

        $verifydbtoken = $verified->verifyToken;
        $verifyformtoken= $request->verifyPin;
       if($verifydbtoken==$verifyformtoken){
            $verified->verifyToken = 1;
            $verified->save();
            Session::put('customerId',$verified->id);
            Session::forget('vcustomerId');
            Toastr::success('Your account is verified', 'success!');
            return redirect('customer/account');
       }else{
        Toastr::error('sorry your verify token wrong', 'Opps!');
        return redirect()->back();
       }
    }

    public function resendcode($id){
        $findcustomer=Customer::find($id);
        $verifyToken=rand(111111,999999);
        $findcustomer->verifyToken=$verifyToken;
        $findcustomer->save();
        // verify code send to customer mail
      $data=$findcustomer->toArray();
        $send = Mail::send('frontEnd.emails.email', $data, function($textmsg) use ($data){
          $textmsg->to($data['email']);
          $textmsg->subject('account veriry code');
        });
      return redirect('customer/verify');
    }
    
    public function profileEdit(){
        $customerInfo = Customer::find(Session::get('customerId'));
        return view('frontEnd.layouts.pages.customer.profileEdit',compact('customerInfo'));
    }
    public function profileUpdate(Request $request){
       $update_data = Customer::find(Session::get('customerId'));
           $update_image = $request->file('image');
	        if ($update_image) {
	           $file = $request->file('image');
	            $name = time().'-'.$file->getClientOriginalName();
	            $uploadPath = 'public/uploads/customer/';
	            $file->move($uploadPath,$name);
	            $fileUrl =$uploadPath.$name;
	        }else{
	            $fileUrl = $update_data->image;
	        }
       $update_data->fullName    =   $request->fullName;
       $update_data->phoneNumber =   $request->phoneNumber;
       $update_data->address     =   $request->address;
       $update_data->image       =   $fileUrl;
       $update_data->email       =   $request->email;
       $update_data->save();
       Toastr::success('Thanks! Your information update','success');
       return redirect()->back();
    }
    
    public function orderSave(Request $request){
       
        $this->validate($request,[
            'fullName'=>'required',
            'phoneNumber'=>'required|digits:11',
            'area'=>'required',
            'address'=>'required',
        ], [
    'phoneNumber.required' => 'The phone number field is required.',
    'phoneNumber.digits' => 'The phone number must be exactly 11 digits.',
]);
        $existCustomer = Customer::where('phoneNumber',$request->phoneNumber)->first();
        if($existCustomer){
            $customerId = $existCustomer->id;
            Session::put('customerId',$customerId);
        }else{
             $store_data                =   new Customer();
             $store_data->fullName      =   $request->fullName;
             $store_data->phoneNumber   =   $request->phoneNumber;
            //  $store_data->email         =   $request->phoneNumber;
             $store_data->verifyToken   =   1;
             $store_data->status        =   1;
             $store_data->password      =   bcrypt(request('phoneNumber'));
             $store_data->save();
             $customerId = $store_data->id;
             Session::put('customerId',$customerId);
        }

       $cartqty=Cart::instance('shopping')->content()->count();
        if($cartqty){

            $subtotal=Cart::instance('shopping')->subtotal();
            $subtotal=str_replace(',','',$subtotal);
            $subtotal=str_replace('.00', '',$subtotal);

           // shipping calculte
           $shipping              =   new Shipping();
           $shipping->name        =   $request->fullName;
           $shipping->phone       =   $request->phoneNumber;
           $shipping->address     =   $request->address;
           $shipping->district    =   $request->district;
           $shipping->shippingfee =   $request->area;
           $shipping->area        =   $request->area;
           $shipping->note        =   $request->note;
           $shipping->customerId  =   $customerId;
           $shipping->save();
           
           $order             = new Order();
           $order->customerId = $customerId;
           $order->shippingId = $shipping->id;
           $order->orderTotal = ($subtotal+$request->area);
           $order->discount   = 0;
           $order->trackingId = rand(111111,999999);
           $order->created_at = Carbon::now();
           $order->save();

           $payment                 = new Payment();
           $payment->orderId        = $order->id;
           $payment->paymentType    = 'cod';
           $payment->senderId       = NULL;
           $payment->transectionId  = NULL;
           $payment->bkashFee       = NULL;
           $payment->paymentStatus  = 'Pending';
           $payment->save();

           $cartProducts = Cart::instance('shopping')->content();
            foreach($cartProducts as $cartProduct){
                $orderDetails = new Orderdetails();
                $orderDetails->orderId          =   $order->id;
                $orderDetails->ProductId        =   $cartProduct->id;
                $orderDetails->productName      =   $cartProduct->name;
                $orderDetails->productImage     =   $cartProduct->options['image'];
                $orderDetails->productPrice     =   $cartProduct->price;
                $orderDetails->productSize      =   $cartProduct->options->size? $cartProduct->options->size:'';
                $orderDetails->productColor     =   $cartProduct->options->color? $cartProduct->options->color:'';
                $orderDetails->proPurchaseprice =   $cartProduct->options->proPurchaseprice;
                $orderDetails->productQuantity  =   $cartProduct->qty;
                $orderDetails->created_at       =   Carbon::now();
                $orderDetails->save();
            }

          Cart::instance('shopping')->destroy();
          Toastr::success('Thanks, Your order send successfully', 'Success!');
          return redirect('customer/order/invoice/'.$order->id);

        }else{
            Toastr::error('Opps please shopping first', 'Cart Empty');
            return redirect('/');
        }
    }


    
    public function customerAccount(){
      return view('frontEnd.layouts.pages.customer.customerProfile');
    }


    public function customerLogout(){
        Session::flush();
        Toastr::success('You are logout successfully', 'success!');
        return redirect('/');
    }

    public function customerOrder(){
      return view('frontEnd.layouts.pages.customer.order');
    }
    public function corderInvoice($orderIdPrimary){
      $orderInfo=Order::where(['orderIdPrimary'=>$orderIdPrimary, 'customerId'=>Session::get('customerId')])->first();
      if($orderInfo !=NULL){
      $customerInfo = Customer::where('id',$orderInfo->customerId)->first();
      $shippingInfo=Shipping::where('shippingPrimariId',$orderInfo->shippingId)->first();
      // return $shippingInfo;
      $orderDetails=Orderdetails::where('orderId',$orderInfo->orderIdPrimary)->get();

      return view('frontEnd.layouts.pages.customer.orderinvoice',compact('orderInfo','customerInfo','shippingInfo','orderDetails'));
      }else{
          Toastr::error('Opps !', 'You are rong!');
          return redirect('customer/order');
      }
    }
 public function applyCoupon(Request $request){
      $findcoupon = Couponcode::where('couponcode',$request->couponcode)->first();
      if($findcoupon==NULL){
        Toastr::error('Opps! your entre promo code not valid');
        return redirect('show-cart');
      }else{
        $currentdata = date('Y-m-d');
        $expairdate=$findcoupon->expairdate;
        if($currentdata <= $expairdate){
        $totalcart = Cart::instance('shopping')->subtotal();
        $totalcart = str_replace('.00','',$totalcart);
        $totalcart = str_replace(',','',$totalcart);
         if($totalcart >= $findcoupon->buyammount){
           $useCode = CouponUsed::where(['customerId'=>Session::get('customerId'),'couponcode'=>Session('usecouponcode')])->first();
           if($useCode!=NULL){
               Toastr::error('Opps! Sorry you already use this coupon');
                return redirect('show-cart');
           }else{
               if($totalcart >= $findcoupon->buyammount){
                  if($findcoupon->offertype==1){
                    $discountammount =  (($totalcart*$findcoupon->amount)/100);
                    Session::forget('couponamount');
                    Session::put('couponamount',$discountammount);
                    Session::put('usecouponcode',$findcoupon->couponcode);
                  }else{
                    Session::put('couponamount',$findcoupon->amount);
                    Session::put('usecouponcode',$findcoupon->couponcode);
                  }
                  
                 Toastr::success('Success! your promo code accepted');
                 return redirect('show-cart');
             }
           }
       }else{
         Toastr::error('Opps! Sorry your total shopping amount not available for offer');
         return redirect('show-cart');
       }
        }else{
          Toastr::error('Opps! Sorry your promo code date expaire');
          return redirect('show-cart');
        }
      }
    }
    public function orderTrackScan($id){
          $orderfinds = Order::where('trackingId',$id)->first();
          if($orderfinds){
             return view('frontEnd.layouts.pages.trackorder',compact('orderfinds')); 
          }else{
              Toastr::error('Sorry, Your tracking Id is wrong');
              return redirect()->back();
          }
          
    }
    
    public function orderCancelRequest(Request $request){
        $this->validate($request,[
            'hidden_id'=>'required',
          ]);
          $orderfinds =  Order::where('orderIdPrimary',$request->hidden_id)->update(['cancelRequest'=>1]);
          //  Admin Notification
         $orderInfo =  Order::where('orderIdPrimary',$request->hidden_id)->first();
         $data2 = array(
             'email' => 'info@websolutionit.com',
             'trackingId'    => $orderInfo->trackingId,
            );
          $send = Mail::send('frontEnd.emails.cancelnotification', $data2, function($textmsg) use ($data2){
              $textmsg->to($data2['email']);
              $textmsg->subject('A Order Cancel Request');
            });
            
          Toastr::success('Done, Your order cancel request send');
          return redirect()->back();

     }

     // =========== Password Forget =============
    public function forgetpassword(){
      return view('frontEnd.layouts.pages.customer.forgetpassword');
    }
    public function forgetpassemailcheck(Request $request){
        $this->validate($request,[
            'email'=>'required',
        ]);
       $checkEmail = Customer::where('email',$request->email)->first();
      if($checkEmail){
        $passResetToken=rand(111111,999999);
        $checkEmail->passResetToken=$passResetToken;
        $checkEmail->save();

        // verify code send to customer mail
        $data = array(
         'contact_email' => $request->email,
         'passResetToken' => $passResetToken,
        );
        $send = Mail::send('frontEnd.emails.forgetpassword', $data, function($textmsg) use ($data){
         $textmsg->to($data['contact_email']);
         $textmsg->subject('Forget password code');
        });
        Toastr::success('Your are send a forget password verify code in your email','Success');
        Session::put('fcustomerId',$checkEmail->id);
        return redirect('customer/forget-password/reset');
      }else{
        Toastr::error('Your email address not found','Opps');
        return redirect()->back();
      }
    }
    public function passresetpage(){
       if(Session::get('fcustomerId')){
        return view('frontEnd.layouts.pages.customer.passwordreset');
        }else{
           Toastr::error('Your request process rong','Opps!');
           return redirect('customer/forget-password'); 
        }
    }

    public function fpassreset(Request $request){
        $this->validate($request,[
            'verifycode'=>'required',
            'newpassword'=>'required',
        ]);
       $memberInfo = Customer::find(Session::get('fcustomerId'));
      if($memberInfo->passResetToken == $request->verifycode){
        $memberInfo->password=bcrypt(request('newpassword'));
        $memberInfo->passResetToken=NULL;
        $memberInfo->save();
        Toastr::success('Your password reset successfully','Success');
        Session::put('customerId',$memberInfo->id);
        return redirect('/customer/account');
      }else{
        Toastr::error('Your verified code not match','Opps');
        return redirect()->back();
      }
    }



}
