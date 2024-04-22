<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Product;
use App\Orderdetails;
use App\Expence;
use App\Order;
use Carbon\Carbon;
use DB;
class DashboardController extends Controller
{
   public function index(Request $request){
        if($request->filter && $request->start && $request->end){
            $start = $request->start;
            $end = $request->end;
            $query = $request->filter;
        }elseif($request->filter && $request->start==NULL && $request->end==NULL){
            $query = $request->filter;
            $start = NULL;
        }else{
            $query = 1;
            $start = NULL;
        }
        $todayexpence = Expence::whereDate('created_at',Carbon::today())->sum('ammount');
        $totalstock = Product::sum('proQuantity');
        $todaysalesamount = Orderdetails::whereDate('created_at',Carbon::today())->get()->sum(function($stotal){
                return $stotal->productPrice * $stotal->productQuantity; });
        return view('backEnd.admin.dashboard',compact('query','start','todayexpence','totalstock','todaysalesamount'));
        
    }

    public function reportsummaery(Request $request){
        if($request->start && $request->end){
            $totalexpence = Expence::whereBetween('created_at', [$request->start, $request->end])->sum('ammount');
            $totaldiscount = Order::whereBetween('created_at', [$request->start, $request->end])->sum('discount');
            $salesamount = Orderdetails::whereBetween('created_at', [$request->start, $request->end])->get()->sum(function($stotal){
                return $stotal->productPrice * $stotal->productQuantity; });
            $purchaseamount = Orderdetails::whereBetween('created_at', [$request->start, $request->end])->get()->sum(function($ptotal){
                return $ptotal->proPurchaseprice * $ptotal->productQuantity; });
        }else{
            $totalexpence = Expence::whereMonth('created_at',Carbon::now()->month)->sum('ammount');
            $totaldiscount = Order::whereMonth('created_at',Carbon::now()->month)->sum('discount');
            $salesamount = Orderdetails::whereMonth('created_at',Carbon::now()->month)->get()->sum(function($stotal){
                return $stotal->productPrice * $stotal->productQuantity; });
            $purchaseamount = Orderdetails::whereMonth('created_at',Carbon::now()->month)->get()->sum(function($ptotal){
                return $ptotal->proPurchaseprice * $ptotal->productQuantity; });
        }
        $totalproduct = Product::count();
        $totalstock = Product::sum('proQuantity');
        $stockpurchase = Product::sum('proPurchaseprice');
        $stocksales = Product::all()->sum(function($sproduct){ 
            return $sproduct->proPurchaseprice * $sproduct->proQuantity; });
        $stocksales = Product::all()->sum(function($sproduct){ 
            return $sproduct->proNewprice * $sproduct->proQuantity; });
        return view('backEnd.inventory.summary',compact('totalproduct','totalstock','stockpurchase','stocksales','salesamount','purchaseamount','totalexpence','totaldiscount'));
    }
}
