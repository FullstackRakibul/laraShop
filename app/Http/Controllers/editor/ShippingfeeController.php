<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Shippingfee;

class ShippingfeeController extends Controller
{
        public function index(){
    	return view('backEnd.shippingfee.add');

    }
    public function store(Request $request){
    	$this->validate($request,[
            'minprice'=>'required',
            'maxprice'=>'required',
            'shippingfee'=>'required',
    		'status'=>'required',
    	]);

    	
    	$store_data                    = new Shippingfee();
    	$store_data->minprice   	   = $request->minprice;
        $store_data->maxprice          = $request->maxprice;
        $store_data->shippingfee       = $request->shippingfee;
    	$store_data->status            = $request->status;
    	$store_data->save();
    	Toastr::success('message', 'Shippingfee add successfully!');
    	return redirect('/editor/shippingfee/manage');
    }
     public function manage(){
        $show_data =Shippingfee::
             orderBy('id','DESC')
            ->get();
    	return view('backEnd.shippingfee.manage',compact('show_data'));
    }
     public function edit($id){
        $edit_data = Shippingfee::find($id);
        return view('backEnd.shippingfee.edit',compact('edit_data'));
    }
      public function update(Request $request){
        $this->validate($request,[
            'minprice'=>'required',
            'maxprice'=>'required',
            'shippingfee'=>'required',
            'status'=>'required',
        ]);
      	$update_data = Shippingfee::find($request->hidden_id);
        $update_data->minprice   	    = $request->minprice;
        $update_data->maxprice          = $request->maxprice;
        $update_data->shippingfee       = $request->shippingfee;
    	$update_data->status            = $request->status;
    	$update_data->save();
        Toastr::success('message', 'Shippingfee Update successfully!');
        return redirect('editor/shippingfee/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Shippingfee::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Shippingfee active successfully!');
        return redirect('/editor/shippingfee/manage');
    }

    public function active(Request $request){
        $publishId = Shippingfee::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Shippingfee active successfully!');
        return redirect('/editor/shippingfee/manage');
    }
    public function destroy(Request $request){
        $destroy_id =Shippingfee::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Shippingfee  delete successfully!');
        return redirect('/editor/shippingfee/manage');         
    }
}
