<?php

namespace App\Http\Controllers\editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Orderdetails;
use App\Prescription;
use App\Customermessage;
use App\Comment;
use App\Order;
use App\Guestorder;
use App\Customerapply;
use App\Productrequest;
use App\Sellwithus;
use App\Ordertype;
use App\OrderStatusHistory;
use App\Product;
use App\Shipping;
use App\Customer;
use App\Payment;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReportsController extends Controller
{
     public function ordermanage($slug,Request $request){
        if(!empty($slug)){
            $status = Ordertype::where('slug',$slug)->first()->id;
            $filter = $request->filter;
        }else{
           $status = $request->status;
           $filter = $request->filter;
        }

         if($status && $request->filter && $request->start && $request->end){
              $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->where('orderStatus',$status)
            ->whereBetween('orders.created_at', [$request->start, $request->end])
            ->get();
         }elseif($status==NULL && $request->filter && $request->start && $request->end){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->whereBetween('orders.created_at', [$request->start, $request->end])
            ->get();
         }elseif($status==NULL && $request->filter==1){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==2){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::today())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
         }elseif($status==NULL && $request->filter==3){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::yesterday())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==4){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereMonth('orders.created_at',Carbon::now()->month)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==5){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::now()->subMonth())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            $filter = 1;
            $status = 1;
         }elseif($status==NULL && $request->filter==6){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->year)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status==NULL && $request->filter==7){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->subYear())
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==1){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->where('orders.orderStatus',$status)
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==2){
            //  return $request->all();
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::today())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
         }elseif($status && $request->filter==3){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::yesterday())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==4){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereMonth('orders.created_at',Carbon::now()->month)
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==5){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereDate('orders.created_at',Carbon::now()->subMonth())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==6){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->year)
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }elseif($status && $request->filter==7){
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->whereYear('orders.created_at',Carbon::now()->subYear())
            ->where('orders.orderStatus',$status)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
         }else{
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->where('orders.orderStatus',$status)
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
            $filter = 1;
            $status = 1;
            
         }
         return view('backEnd.reports.ordermanage',compact('show_data','filter','status'));
    	
    }
     public function allOrder(Request $request){
       
             $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            // return $show_data;
            $filter = 1;
            $status = 1;
            
         return view('backEnd.reports.ordermanage',compact('show_data','filter','status'));
    	
    }
    public function ordercancel(){
        $show_data = DB::table('orders')
            ->join('customers','orders.customerId','=','customers.id')
            ->select('orders.*','customers.fullName','customers.phoneNumber')
            ->where('cancelRequest',1)
            ->orderBy('orderIdPrimary','DESC')
            ->get();
            return view('backEnd.reports.ordercancel',compact('show_data'));
    }
    public function orderFilter(Request $request){
        // return $request->all();
    	$show_data = DB::table('orders')
        ->join('customers','orders.customerId','=','customers.id')
        ->where('orders.orderStatus',$status)
        ->whereDate('orders.created_at','<=',$request->enddate)
        ->whereDate('orders.created_at','>=',$request->startdate)
        ->select('orders.*','customers.fullName','customers.phoneNumber')
        ->orderBy('orders.orderIdPrimary','DESC')
        ->get();
        return view('backEnd.reports.filterorders',compact('show_data'));
    }
      public function stock(){
     	$show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
     	return view('backEnd.inventory.stock',compact('show_data'));
     }
      public function stockout(){
     	$show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->where('products.proQuantity','>', 0)
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
     	return view('backEnd.inventory.stockout',compact('show_data'));
     }
      public function stockwarning(){
        $show_data = DB::table('products')
        ->join('categories','products.proCategory','=','categories.id')
        ->where('products.proQuantity','<', 6)
        ->select('products.*','categories.name')
        ->orderBy('id','DESC')
        ->get();
        return view('backEnd.inventory.stockwarning',compact('show_data'));
     }
    public function details($shippingId,$customerId,$orderIdPrimary){
	   // 	$orderInfo = DB::table('orders')
	   //     ->join('customers','orders.customerId','=','customers.id')
	   //     ->join('payments','orders.orderIdPrimary','=','payments.orderId')
	   //     ->where('customers.id',$customerId)
	   //     ->select('orders.*','customers.fullName','customers.phoneNumber','customers.address','payments.paymentType')
	   //     ->first();
	        $orderInfo = DB::table('orders')
	        ->where('orderIdPrimary', $orderIdPrimary)
	        ->first();
            $id = $orderIdPrimary;
	        $paymentmethod = DB::table('payments')
	        ->join('orders','payments.orderId','=','orders.orderIdPrimary')
	        ->where('payments.orderId',$orderIdPrimary)
	        ->select('payments.*','orders.orderIdPrimary')
	        ->first();

	        $shippingInfo = DB::table('shippings')
	        ->join('orders','shippings.shippingPrimariId','=','orders.shippingId')
	        ->where('shippings.shippingPrimariId',$shippingId)
	        ->select('shippings.*','orders.*')
	        ->first();
	        $orderDetails = DB::table('orderdetails')
	        ->join('products','orderdetails.ProductId','=','products.id')
	        ->where('orderdetails.orderId',$orderIdPrimary)
	        ->select('orderdetails.*','products.*')
	        ->get();
	        return view('backEnd.reports.invoice',compact('orderInfo','shippingInfo','paymentmethod','orderDetails','id'));
	    }

	    
	   public function adminmessage(Request $request){
	   	$this->validate($request,[
            'message'=>'required',
        ]);
       $conversion              		=   new Adminmessage();
       $conversion->message     		=   $request->message;
       $conversion->prescription_id     =   $request->prescriptionId;
       $conversion->admin     			=   $request->admin;
       $conversion->save();
       Toastr::success('Message send successfully','success');
       return redirect()->back();
	   }

	   public function comment(){
	   	$comments = DB::table('comments')
          ->join('customers','comments.customer_id','=','customers.id')
          ->join('products','comments.product_id','=','products.id')
            ->where('comments.status',0)           
             ->select('comments.*','customers.fullName','products.id as product_id')
            ->get();
	    return view('backEnd.reports.comment',compact('comments'));
	   }

	   public function commentAnswer($id){
	   	$acomments = DB::table('comments')
          ->join('customers','comments.customer_id','=','customers.id')
          ->join('products','comments.product_id','=','products.id')
            ->where('comments.id',$id)        
             ->select('comments.*','customers.fullName','products.id as product_id')
            ->first();
	    return view('backEnd.reports.answer',compact('acomments'));
	   }

	   public function sendAnswer(Request $request){
        $update_data             =   Comment::find($request->hidden_id);
        $update_data->answer     =    $request->answer;
        $update_data->admin_id   =    $request->admin_id;
        $update_data->status     =    1;
        $update_data->save();
        Toastr::success('message', 'Your message send successfully!');
        return redirect('editor/comment/unread');
    }
       public function allComments(){
	   	$allComments = DB::table('comments')
          ->join('customers','comments.customer_id','=','customers.id')
          ->join('products','comments.product_id','=','products.id')      
          ->join('users','comments.admin_id','=','users.id')      
             ->select('comments.*','customers.fullName','products.id as product_id','users.name')
            ->get();
	    return view('backEnd.reports.allcomment',compact('allComments'));
	   }
	   public function deleteComment(Request $request){
        $delete_data = Comment::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('message', 'Comment delete successfully!');
        return redirect('/editor/comment/all');
    }
    
    public function orderstatus($id,$status){
        // dd(Auth::user()->id);
        $published_data = Order::where('orderIdPrimary',$id)->update(['orderStatus' => $status]);
        
        // Store status change history
        $history = new OrderStatusHistory();
        $history->order_id = $id;
        $history->status = $status;
        $history->updated_by = Auth::user()->id;
        $history->updated_at = now();
        $history->save();
        Toastr::success('message', 'Order status change successfully!');
        return redirect()->back();
    }
    
     public function orderlist($status){
        $ordertype = Ordertype::find($status);
        $show_data = DB::table('orders')
        ->join('customers','orders.customerId','=','customers.id')
        ->select('orders.*','customers.fullName','customers.phoneNumber')
        ->where('orderStatus',$status)
        ->orderBy('orderIdPrimary','DESC')
        ->get();
        return view('backEnd.reports.orderlist',compact('show_data','ordertype'));
    }

    public function manage(){
      $show_data = Customerapply::orderBy('id','DESC')->get();
      return view('backEnd.reports.manage',compact('show_data'));
    }


    public function destroy(Request $request){
      $deleteId = Customerapply::find($request->hidden_id);
        $deleteId->delete();
        Toastr::success('message', 'reports  delete successfully!');
        return redirect('/editor/register/manage');
    }
    public function productrequestlist(){
        $show_data = Productrequest::orderBy('id','DESC')->get();
        return view('backEnd.reports.productrequestlist',compact('show_data'));
    }
    public function sellwithuslist(){
        $show_data = Sellwithus::orderBy('id','DESC')->get();
        return view('backEnd.reports.sellwithuslist',compact('show_data'));
    }
    public function sellwithusdetails(){
        $show_data = Sellwithus::orderBy('id','DESC')->get();
        return view('backEnd.reports.sellwithusdetails',compact('show_data'));
    }
    
    public function customerlist(){
        $show_data = Customer::orderBy('id','DESC')->get();
        return view('backEnd.reports.customerlist',compact('show_data'));
    }
    public function orderEdit($orderIdPrimary, $shippingIdPrimary){
        // dd($shippingIdPrimary);
        
        $orderDetails = DB::table('orderdetails')
	        ->join('products','orderdetails.ProductId','=','products.id')
	        ->where('orderdetails.orderId',$orderIdPrimary)
	        ->select('orderdetails.*','products.*')
	        ->get();
	    $products = Product::with('image')->latest()->get();
	    $order = Order::where('orderIdPrimary', $orderIdPrimary)->latest()->first();     
	    $shippingInfo = Shipping::where('shippingPrimariId', $shippingIdPrimary)->latest()->first();     
	        return view('backEnd.reports.orderEdit',compact('orderDetails','shippingInfo','products',('order')));
    }
    public function orderInfoUpdate(Request $request, $shippingIdPrimary){
        // dd($request->all());
        
        DB::table('shippings')
        ->where('shippingPrimariId', $shippingIdPrimary)
        ->update([
            'name'         => $request->name,
            'phone'        => $request->phone,
            'address'      => $request->address,
        ]);
        Toastr::success('message', 'Customer Info Update Successfully');
            return back();
    }
    
        
    /**
     * Update courier Info
     * 
     */
    public function updateInfo( Request $request,$shippingPrimariId )
    {
        $validator = validator($request->all(),[
            'couriername'      => 'required',
            'cityname'         => 'required',
            'zonename'         => 'required',
            'storename'        => 'required',
            'itemweight'       => 'required',
            'deliverytype'     => 'required',
            'itemtype'         => 'required',
        ]);


        if ( $validator->fails() ){
            foreach ($validator->errors() as $key => $error) {
                Toastr::error('Required',$error);
            }
            return redirect()->back();
        }

        DB::table('shippings')
        ->where('shippingPrimariId', $shippingPrimariId)
        ->update([
            'courier'  => $request->couriername,
            'courier_info' => serialize([
                'city'         => $request->cityname,
                'zone'         => $request->zonename,
                'area'         => $request->areaname,
                'store'        => $request->storename,
                'weight'       => $request->itemweight,
                'deliverytype' => $request->deliverytype,
                'itemtype'     => $request->itemtype,
                'specialnote'  => $request->specialnote,
                'readable'     => $request->courier_readable_info
            ]),
        ]);

        Toastr::success('Success','Courier Info Updated');
        return redirect()->back();
    }
    
    public function orderDelete($id)
    {
        $orderDetail = Orderdetails::where('orderDetails', $id);
    
        if (!$orderDetail) {
            Toastr::success('message', 'Order detail not found');
            return back();
        }
    
        $id = Orderdetails::where('orderDetails', $id)->first();
        $orderId = $id->orderId;
        $order = Order::where('orderIdPrimary', $orderId)->first();
        $newPrice = $order->orderTotal - $id->productPrice;
        DB::table('orders')
        ->where('orderIdPrimary', $orderId)
        ->update([
            'orderTotal' => $newPrice,
        ]);
        
        $orderDetail->delete();
        Toastr::success('message', 'Order detail Deleted Successfully');
            return back();
    }
    public function orderAdd(Request $request, $id)
    {

        $product = Product::find($request->product_id);
        // dd($product);
        if (!$product) {
            Toastr::success('message', 'Product not found');
            return back();
        }
    
        // Add productdetails
        
                $orderDetails = new Orderdetails();
                $orderDetails->orderId          =   $id;
                $orderDetails->ProductId        =   $product->id;
                $orderDetails->productName      =   $product->proName;
                $orderDetails->productImage     =   $product->image?$product->image->image:'';
                $orderDetails->productPrice     =   $product->proNewprice;
                $orderDetails->productSize      =   '';
                $orderDetails->productColor     =   '';
                $orderDetails->proPurchaseprice =   $product->proPurchaseprice;
                $orderDetails->productQuantity  =   1;
                $orderDetails->created_at       =   Carbon::now();
                $orderDetails->save();
    
    //   Update total Price in order table
        $order   = Order::where('orderIdPrimary', $id)->first();
        $newPrice = $order->orderTotal + $product->proNewprice;
        
        DB::table('orders')
        ->where('orderIdPrimary', $id)
        ->update([
            'orderTotal' => $newPrice,
        ]);

        Toastr::success('message', 'Add Product Successfully');
            return back();
    }
    public function orderUpdate(Request $request, $id)
    {
        $order = Order::where('orderIdPrimary', $id)->first();
        // dd($request->discount);
       if ($order) {
        $discount = $request->discount;
         DB::table('orders')
        ->where('orderIdPrimary', $id)
        ->update([
            'discount' => $discount,
            'orderTotal' => $order->orderTotal - $discount,
        ]);
        
    } else {
        Toastr::success('message', 'Order not found');
            return back();
    }
        Toastr::success('message', 'Discount applied Successfully');
            return back();
    }
    
}
