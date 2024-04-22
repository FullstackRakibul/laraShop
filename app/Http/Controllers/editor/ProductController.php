<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Category;
use App\Subcategory;
use App\Childcategory;
use App\Product;
use App\Productcolor;
use App\Productsize;
use App\Productimage;
use App\Orderdetails;
use App\Customer;
use App\Order;
use App\Delivery;
use App\Shipping;
use App\Payment;
use App\Size;
use App\Color;
use DB;
use Carbon\Carbon;
use Alert;
class ProductController extends Controller
{
	// ajax code
	public function getSubcategory(Request $request){
            $category = DB::table("subcategories")
                        ->where("category_id",$request->category_id)
                        ->pluck('subcategoryName','id');
            return response()->json($category);
        }
        public function getChildcategory(Request $request){
            $childcategory = DB::table("childcategories")
                        ->where("subcategory_id",$request->category_id)
                        ->pluck("childcategoryName","id");
            return response()->json($childcategory);
        }
		// ajax code
    public function add(){
    	$categories = Category::where('status',1)->get();
    	$colors     = Color::where('status',1)->get();
    	$sizes      = Size::where('status',1)->get();
    	return view('backEnd.product.add',compact('categories','colors', 'sizes'));
    }
     public function store(Request $request){
        $this->validate($request,[
            'proCategory'			=>	'required',
            'proName'				=>	'required',
    		'proPurchaseprice'		=>	'required',
    		'proNewprice'			=>	'required',
    		'image'					=>	'required',
    		'proDescription'		=>	'required',
    		'status'		        =>	'required',

    	]);


    	$store_data           	 		  = 	new Product();
    	$store_data->proCategory      	  = 	$request->proCategory;
    	$store_data->proBrand  		      = 	$request->proBrand;
    	$store_data->proName  			  = 	$request->proName;
    	$store_data->proCode    		  = 	$request->proCode;
    	$store_data->slug  			      = 	strtolower(preg_replace('/\s+/', '-', $request->proName));
    	$store_data->proPurchaseprice  	  = 	$request->proPurchaseprice;
    	$store_data->proOldprice  		  = 	$request->proOldprice;
    	$store_data->proNewprice  		  = 	$request->proNewprice;
    	$store_data->proDescription       = 	$request->proDescription;
    	$store_data->proQuantity    	  = 	$request->proQuantity;
    	$store_data->unit    	          = 	$request->unit;
        $store_data->bestsell             =     $request->bestsell;
    	$store_data->status    		      = 	$request->status;
    	$store_data->save();

        $productId=$store_data->id;
        $images = $request->file('image');
        foreach($images as $image)
        {
           // image01 upload
            $name =  time().'-'.$image->getClientOriginalName();
            $uploadpath = 'public/uploads/product/';
            $image->move($uploadpath, $name);
            $imageUrl = $uploadpath.$name;  

             $proimage= new Productimage();
             $proimage->product_id = $productId;
             $proimage->image=$imageUrl;
             $proimage->save(); 
        }
        $store_data->sizes()->attach($request->sizeName);
        $store_data->colors()->attach($request->colorName);


    	Toastr::success('message', 'Product information upload successfully!');
    	return redirect('/editor/product/add');
        }
     public function manage(){
     	$show_data = Product::with('category','image')
        ->latest()->get();
     	return view('backEnd.product.manage',compact('show_data'));
     }
     public function edit($id){
     	$edit_data      = Product::with('image')->find($id);
     	$category       = Category::where('status',1)->get();
        $categoryId     = Product::find($id)->proCategory;
        $subcategory    = Subcategory::where('category_id','=',$categoryId)->get();
        $subcategoryId  = Product::find($id)->proSubcategory;
        $colors         = Color::where('status',1)->get();
    	$sizes          = Size::where('status',1)->get();
    	$productColors  = Productcolor::where('product_id', $id)->get();
    	$productSizes   = Productsize::where('product_id', $id)->get();

        return view('backEnd.product.edit',compact('category','subcategory','edit_data', 'colors','sizes','productColors','productSizes'));
     }
     public function update(Request $request){
            $this->validate($request,[
                'proCategory'           =>  'required',
                'proName'               =>  'required',
                'proPurchaseprice'      =>  'required',
                'proNewprice'           =>  'required',
                'proDescription'        =>  'required',
                'status'        =>  'required',

            ]);
     	$update_data = Product::find($request->hidden_id);

    	$update_data->proCategory          =     $request->proCategory;
        $update_data->proBrand             =     $request->proBrand;
        $update_data->proName              =     $request->proName;
        $update_data->proCode              =     $request->proCode;
        $update_data->slug                 =     strtolower(preg_replace('/\s+/', '-', $request->proName));
        $update_data->proPurchaseprice     =     $request->proPurchaseprice;
        $update_data->proOldprice          =     $request->proOldprice;
        $update_data->proNewprice          =     $request->proNewprice;
        $update_data->proDescription       =     $request->proDescription;
        $update_data->proQuantity          =     $request->proQuantity;
        $update_data->unit                 =     $request->unit;
        $update_data->bestsell             =     $request->bestsell;
        $update_data->status               =     $request->status;
    	$update_data->save(); 

    	$productId=$update_data->id;
    	$update_images=Productimage::where('product_id',$productId)->get();
		$images = $request->file('image');
		if($images){
	        foreach($images as $image)
		        {
		           // image01 upload
		        $name =  time().'-'.$image->getClientOriginalName();
		        $uploadpath = 'public/uploads/product/';
		        $image->move($uploadpath, $name);
		        $imageUrl = $uploadpath.$name;	

	             $proimage= new Productimage();
		         $proimage->product_id = $productId;
		         $proimage->image=$imageUrl;
		         $proimage->save(); 
		        }
        }else{
        	foreach($update_images as $update_image){
        	$uimage=$update_image->image;
        	$update_image->image 	=	$uimage;
			$update_image->save();
        	}
        }
        $update_data->sizes()->sync($request->sizeName);
        $update_data->colors()->sync($request->colorName);
       
    	Toastr::success('message', 'Product information update successfully!');
    	return redirect('/editor/product/manage');
     }
      public function inactive(Request $request){
		$Unpublished_data			=	Product::find($request->hidden_id);
		$Unpublished_data->status 	=	0;
		$Unpublished_data->save();
		Toastr::success('message', 'Product unpublished successfully!');
		return redirect('editor/product/manage');	
	}
	public function active(Request $request){
		$published_data			=	Product::find($request->hidden_id);
		$published_data->status 	=	1;
		$published_data->save();
		Toastr::success('message', 'Product published successfully!');
		return redirect('editor/product/manage');	
	}
     public function productimgdel($id){
        $delete_img = Productimage::find($id);
        $delete_img->delete();
        Toastr::success('message', 'advertisments image  delete successfully!');
        return redirect()->back();
    }

	public function destroy(Request $request){
		$delete_data = Product::find($request->hidden_id);
		$delete_data->delete();
		Toastr::success('message', 'Product delete successfully!');
		return redirect('editor/product/manage');	
	}
	
	public function bulkAction(Request $request) {

        
        $action = $request->input('action');
        $productIds = $request->input('product_id');
        // Order
        if ($action == 4) {
            // If product not select
            if (!$productIds) {
                Toastr::error('Please select product!');
                return redirect()->back();
            }
            // dd($productIds);
            // Riderct to shipping form
                $customers  = Customer::all();
                $deliveries = Delivery::all();
                return view('backEnd.product.order',compact('productIds','customers','deliveries'));
            }

        // If product not select
        if (!$productIds) {
                Toastr::error('Please select product!');
                return redirect()->back();
            }else{
                
        // Perform the specified action for each product ID
        foreach ($productIds as $productId) {
            $product = Product::find($productId);

            if (!$product) {
                // Product not found
                Toastr::error('Product not found!');
                return redirect()->back();
                
            }

            // Perform the action based on the action value
            switch ($action) {
                case 1:
                    $product->status = 1;
                    $product->save();
                    break;
                case 2:
                    $product->status = 0;
                    $product->save();
                    break;
                case 3:
                    $product->delete();
                    break;
                default:
                    
                    break;
            }
        }

        Toastr::success('message', 'Successfull!');
        return redirect()->back();

      }
    }
    
    public function orderplace(Request $request){
        // dd($request->product_ids);
        $productIds   = $request->input('product_ids');
        $productArray = explode(",", $productIds);
        // dd($productIds);
            // shipping calculte
           $shipping              =   new Shipping();
           $shipping->name        =   $request->fullName;
           $shipping->phone       =   $request->phoneNumber;
           $shipping->address     =   $request->address;
           $shipping->district    =   $request->district;
           $shipping->shippingfee =   $request->area;
           $shipping->area        =   $request->area;
           $shipping->note        =   $request->note;
           $shipping->customerId  =   $request->customer;
           $shipping->save();    

           $order = new Order();
           $order->customerId = $request->customer;
           $order->shippingId = $shipping->id;
           $order->orderTotal = 0;
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


            foreach($productArray as $productId){
                $product = Product::find($productId);
                // $product = Product::where('id', $productId)->with('image')->first();
                // dd($product);
                $orderDetails = new Orderdetails();
                $orderDetails->orderId          =   $order->id;
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
            }

    $totalprice = OrderDetails::where('orderId', $order->id)->sum('productPrice');
        $total = $totalprice + $shipping->area;
        $data = [
        'orderTotal' => $total,
    ];

    DB::table('orders')
        ->where('orderIdPrimary', $order->id)
        ->update($data);
 
		Toastr::success('message', 'Order successfull!');
		return redirect('editor/product/manage');	
	}
    
}
