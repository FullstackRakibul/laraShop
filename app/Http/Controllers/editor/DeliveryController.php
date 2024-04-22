<?php

namespace App\Http\Controllers\editor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Delivery;
use File;
class DeliveryController extends Controller
{
    public function add(){
    	return view('backEnd.delivery.add');
    }
    public function store(Request $request){
        
    	$this->validate($request,[
            'area'   =>'required',
    	    'shipping_charge' =>'required',
            'status'=>'required',
        ]);
// dd($request->all());
        $store_data = new Delivery();
        $store_data->area               = $request->area;
    	$store_data->shipping_charge    = $request->shipping_charge;
        $store_data->status             = $request->status;
        $store_data->save();
        Toastr::success('message', 'delivery area add successfully!');
    	return redirect('/editor/delivery/manage');
    }
    public function manage(){
    	$show_data = Delivery::all();
        return view('backEnd.delivery.manage', [
            'show_data'=> $show_data,
        ]);
    }
    public function edit($id){
        $edit_data = Delivery::find($id);
        return view('backEnd.delivery.edit', ['edit_data'=>$edit_data]);
    }
     public function update(Request $request){
        $this->validate($request,[
            'area'   =>'required',
    	    'shipping_charge' =>'required',
            'status'=>'required',
        ]);
        $update_data = Delivery::find($request->hidden_id);
        $update_data->area               = $request->area;
    	$update_data->shipping_charge    = $request->shipping_charge;
        $update_data->status             = $request->status;
        $update_data->save();
        Toastr::success('message', 'delivery area update successfully!');
        return redirect('/editor/delivery/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Delivery::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'delivery area inactive successfully!');
        return redirect('/editor/delivery/manage');
    }

    public function active(Request $request){
        $publishId = Delivery::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'delivery area active successfully!');
        return redirect('/editor/delivery/manage');
    }
     public function destroy(Request $request){
        $deleteId = delivery::find($request->hidden_id);
         File::delete(public_path() . 'public/uploads/delivery', $deleteId->image);
        $deleteId->delete();
        Toastr::success('message', 'delivery area delete successfully!');
        return redirect('/editor/delivery/manage');
    }
}
