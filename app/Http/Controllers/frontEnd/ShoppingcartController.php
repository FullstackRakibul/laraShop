<?php

namespace App\Http\Controllers\frontEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use App\Shippingaddress;
use App\Couponcode;
use Session;
use Cart;

class ShoppingcartController extends Controller
{
    public function getDistrict(Request $request){
        $area = DB::table("areas")
        ->where("district_id",$request->district_id)
        ->pluck('area','id');
        return $area;
        return response()->json($area);
    }
    
    //======= Add To Cart Product Start=========== 
   public function addTocartGet($id,Request $request){
        $qty=1;
        $productInfo = DB::table('products')->where('id',$id)->first();
        $productImage = DB::table('productimages')->where('product_id',$id)->first();
        $cartinfo=Cart::instance('shopping')->add(['id'=>$productInfo->id,'name'=>$productInfo->proName,'qty'=>$qty,'price'=>$productInfo->proNewprice,'options' => ['image'=>$productImage->image,'proPurchaseprice'=>$productInfo->proPurchaseprice]]);
        return response()->json($cartinfo);  
    } 


    public function cartContent() {
        return view('frontEnd.layouts.includes.cartcontent');
    }

    public function cartMobileContent() {
        return view('frontEnd.layouts.includes.mobilecontent');
    }
    public function updateCart(Request $request){
         $rowId = $request->rowId;
         $quantity = $request->quantity;
         $cart=Cart::instance('shopping')->update($rowId,$quantity);
         $findcoupon = Couponcode::where('couponcode',Session::get('usecouponcode'))->first();
         if($findcoupon !=NULL){
           $subtotal=Cart::instance('shopping')->subtotal();
            $subtotal=str_replace(',','',$subtotal);
            $subtotal=str_replace('.00', '',$subtotal);
             if($subtotal >= $findcoupon->buyammount){
                  if($findcoupon->offertype==1){
                    $discountammount =  (($subtotal*$findcoupon->amount)/100);
                    Session::forget('couponamount');
                    Session::put('couponamount',$discountammount);
                    Session::put('usecouponcode',$findcoupon->couponcode);
                  }else{
                    Session::put('couponamount',$findcoupon->amount);
                    Session::put('usecouponcode',$findcoupon->couponcode);
                  }
                  
                 Toastr::success('Success! your promo code accepted');
                 return redirect('show-cart');
             }else{
                Session::forget('couponamount');
            } 
        }
        
        Toastr::success('Cart Updated successfully','Thanks');
        return redirect()->back();
    }

     public function deleteCart(Request $request) {
        $rowId = $request->rowId;
        $quantity = $request->quantity;
        $cartinfo= Cart::instance('shopping')->update($rowId,0);
        $findcoupon = Couponcode::where('couponcode',Session::get('usecouponcode'))->first();
         if($findcoupon !=NULL){
           $subtotal=Cart::instance('shopping')->subtotal();
            $subtotal=str_replace(',','',$subtotal);
            $subtotal=str_replace('.00', '',$subtotal);
             if($subtotal >= $findcoupon->buyammount){
                  if($findcoupon->offertype==1){
                    $discountammount =  (($subtotal*$findcoupon->amount)/100);
                    Session::forget('couponamount');
                    Session::put('couponamount',$discountammount);
                    Session::put('usecouponcode',$findcoupon->couponcode);
                  }else{
                    Session::put('couponamount',$findcoupon->amount);
                    Session::put('usecouponcode',$findcoupon->couponcode);
                  }
                  
                 Toastr::success('Success! your promo code accepted');
                 return redirect('show-cart');
             }else{
                Session::forget('couponamount');
            } 
        }
        Toastr::success('Product remove from cart', 'Thanks');
        return redirect()->back();
    }
    public function addToCartPost(Request $request, $id){
        $qty = $request->qty;
        $productInfo = DB::table('products')->where('id',$id)->first();
        $productImage = DB::table('productimages')->where('product_id',$id)->first();
         if($request->proColor && $request->proSize){
            Cart::instance('shopping')->add(['id'=>$productInfo->id,'name'=>$productInfo->proName,'qty'=>$qty,'price'=>$productInfo->proNewprice,'options' => ['image'=>$productImage->image,'size'=>$request->proSize,'color'=>$request->proColor,'proPurchaseprice'=>$productInfo->proPurchaseprice]]);
         Toastr::success('Cart added successfully', 'Successfully');
         }
         elseif($request->proSize && $request->proColor==0){
         Cart::instance('shopping')->add(['id'=>$productInfo->id,'name'=>$productInfo->proName,'qty'=>$qty,'price'=>$productInfo->proNewprice,'options' => ['image'=>$productImage->image,'size'=>$request->proSize,'proPurchaseprice'=>$productInfo->proPurchaseprice]]);
         Toastr::success('Cart added successfully', 'Successfully');
         }
         elseif($request->proColor && $request->proSize==0){
            Cart::instance('shopping')->add(['id'=>$productInfo->id,'name'=>$productInfo->proName,'qty'=>$qty,'price'=>$productInfo->proNewprice,'options' => ['image'=>$productImage->image,'color'=>$request->proColor,'proPurchaseprice'=>$productInfo->proPurchaseprice]]);
         Toastr::success('Cart added successfully', 'Successfully');
         }else{
            Cart::instance('shopping')->add(['id'=>$productInfo->id,'name'=>$productInfo->proName,'qty'=>$qty,'price'=>$productInfo->proNewprice,'options' => ['image'=>$productImage->image,'proPurchaseprice'=>$productInfo->proPurchaseprice]]);
             Toastr::success('Cart added successfully', 'Successfully');
         }
         return redirect()->back(); 
    }
    
    
    public function showCart(){

        $cartInfos = Cart::instance('shopping')->content();
        if($cartInfos->count()!=0){
        return view('frontEnd.layouts.pages.showcart',compact('cartInfos'));
             
        }else{
            Toastr::error('Your cart is empty', 'Opps!');
            return redirect('/');
        }
        
    }

    // =========== Add To Cart Oparation End =============

}
