<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Logo;
use App\Product;
use App\Brand;
use App\Customer;
use App\District;
use App\Area;
use App\Delivery;
use App\Facebook;
use App\Productimage;
use App\Location;
use App\Pagecategory;
use App\Socialmedia;
use App\Blogcategory;
use App\Createpage;
use App\Ordertype;
use App\Contact;
use App\Expencecategory;
use DB;
use Session;
use Cart;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Schema::defaultStringLength(191);
            // main logo here
            $mainlogo=Logo::where('status',1)->orderBy('id','DESC')->limit(1,0)->get(); 
            view()->share(compact('mainlogo'));
            // Facebook Api source code here
            $sourceCode = Facebook::orderBy('id','DESC')->first(); 
            view()->share(compact('sourceCode'));
            // Facebook Api
            $categories = Category::where('status',1)->orderBy('level')->get();
            view()->share(compact('categories'));
            // category
            $contactinfoes = Contact::where('status',1)->get();
            view()->share(compact('contactinfoes'));
            // category
            $frontcategories = Category::where(['status'=>1,'frontProduct'=>1])->get();
            view()->share(compact('frontcategories'));
            // Front category
            $hcategories = Category::where('status',1)->orderBy('id','ASC')->get();
            view()->share(compact('hcategories'));
            // category
            $sidebarmenu = Category::where('status',1)->get();
            view()->share(compact('sidebarmenu'));
            // brand
            $brands = Brand::where('status',1)->get();
            view()->share(compact('brands'));
            // product image
            $productimage =Productimage::orderBy('id','DESC')
            ->get();
             view()->share(compact('productimage'));
            // district
             $districts = District::where('status',1)->get();
             view()->share(compact('districts'));
             // Delivery area
            $deliveries = Delivery::where('status',1)->get();
             view()->share(compact('deliveries'));
             // area
            $areas = Area::where('status',1)->get();
             view()->share(compact('areas'));
             $shippingCharg=Location::get();
             view()->share(compact('shippingCharg'));
             // all page
             $allpage = Createpage::where(['status'=>1])->get();
            view()->share(compact('allpage'));
            // footrleftmenu
            $footermenuleft = Pagecategory::where(['status'=>1,'menu_id'=>1])->get();
            view()->share(compact('footermenuleft'));
            // footerrightmenu
            $footermenuright = Pagecategory::where(['status'=>1,'menu_id'=>2])->get();
            view()->share(compact('footermenuright'));
            // social icon
            $socialicons = Socialmedia::where(['status'=>1])-> orderBy('id','DESC')->get();
            view()->share(compact('socialicons'));
            // Blog Categories 
            $ordertypes = Ordertype::get();
            view()->share(compact('ordertypes'));
            // order type
            $expencetypes = Expencecategory::where('status',1)->get();
            view()->share(compact('expencetypes'));
            // order type
            // cart
            $cartInfos = Cart::instance('shopping')->content();
            view()->share(compact('cartInfos'));
            // cart
          
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
