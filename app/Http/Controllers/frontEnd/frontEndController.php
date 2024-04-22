<?php
namespace App\Http\Controllers\frontEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Slider;
use App\Brand;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Childcategory;
use App\Customer;
use App\Contact;
use App\Delivery;
use App\Createpage;
use App\Blog;
use App\Blogcategory;
use App\Advertisement;
use App\Shippingaddress;
use App\Area;
use App\Pagecategory;
use App\Review;
use DB;
use Cart;
use Session;
class frontEndController extends Controller
{
    
    public function index(){

        $mainslider=Slider::where(['status'=>1])
        ->orderBy('id','DESC')
        ->limit(10,0)
        ->get();
        $frontcategories = Category::where(['frontProduct'=>1,'status'=>1])->orderBy('level')->get();
        $bestproducts = Product::where(['status'=>1,'bestsell'=>1])->with('image')->with('color')->with('size')->select('id','slug','proName','proOldprice','proNewprice','proQuantity')->limit(20)->latest()->get();
        $latestproducts = Product::latest()->where('status', 1)->with('image')->with('color')->with('size')->select('id','slug','proName','proOldprice','proNewprice','proQuantity')->limit(102)->get();
        return view('frontEnd.index',compact('mainslider','frontcategories','bestproducts','latestproducts'));
    }
    public function category(Request $request,$slug){
        $category = Category::where('slug',$slug)->first();
        $products = Product::where(['proCategory'=>$category->id,'status'=>1])
        ->orderBy('id','DESC')
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->with('image')
        ->paginate(20);
        return view('frontEnd.layouts.pages.category',compact('products','category'));  
    }   

    public function offerproduct(Request $request){
         $products = Product::where('status',1)
        ->orderBy('products.id','DESC')
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->whereNotNull('products.proOldprice')
        ->with('image')
        ->paginate(20);
        return view('frontEnd.layouts.pages.offerproduct',compact('products'));  
    }
    public function details($id,$slug){
        $productdetails = Product::where(['id'=>$id,'status'=>1])
        ->with('color')
        ->with('size')
        ->orderBy('products.id','DESC')
        ->firstOrfail();
       
        $relatedproduct = Product::where(['proCategory'=>$productdetails->proCategory,'status'=>1])
        ->select('id','slug','proName','proOldprice','proNewprice','proQuantity')
        ->orderBy('products.id')
        ->paginate(9);
        return view('frontEnd.layouts.pages.details',compact('productdetails','relatedproduct'));
    }


    public function shipping(){
        $deliveries = Delivery::where('status',1)->get();
        
        return view('frontEnd.layouts.pages.shipping', compact('deliveries'));       
    }

   public function moreinfo($slug){
        $pagecategory = Pagecategory::where('slug',$slug)->first();
        $moreinfoes=Createpage::where(['id'=>$pagecategory->id,'status'=>1])->first();
        return view('frontEnd.layouts.pages.moreinfo',compact('moreinfoes'));
    }
    public function errorpage(){
        return view('errors.404');
    }
    public function allproduct(){
        $products = Product::where('status',1)->orderBy('id','DESC')->paginate(20);;
        return view('frontEnd.layouts.pages.allproduct',compact('products'));
    }
    public function trackOrder(){
        return view('frontEnd.layouts.pages.trackorder');
    }

    //=============== Pages Controller ===================
    
}
