<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Expencecategory;

class ExpencecategoryController extends Controller
{
    public function add(){
    	return view('backEnd.expencecategory.add');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
    		'status'=>'required',
    	]);
    	$store_data           	  = 	new Expencecategory();
        $store_data->name         =     $request->name;
    	$store_data->slug      	  = 	preg_replace('/\s+/u', '-', trim($request->name));
    	$store_data->status  	  = 	$request->status;
    	$store_data->save();
    	Toastr::success('message', 'Expence Category add successfully!');
    	return redirect('admin/expence-category/manage');
    }
    public function manage(){
    	$show_data = Expencecategory::orderBy('id','DESC')->get();
    	return view('backEnd.expencecategory.manage',compact('show_data'));
    }
    public function edit($id){
        $edit_data =   Expencecategory::find($id);
        return view('backEnd.expencecategory.edit',compact('edit_data'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ]);

    	$update_data = Expencecategory::find($request->hidden_id);
		$update_data->name     		 = 	$request->name;
        $update_data->slug           =  preg_replace('/\s+/u', '-', trim($request->name));
    	$update_data->status  	  	 = 	$request->status;
    	$update_data->save();
        Toastr::success('message', 'Expence Category Update successfully!');
        return redirect('admin/expence-category/manage');
    }
    public function inactive(Request $request){
        $inactive_data           =   Expencecategory::find($request->hidden_id);
        $inactive_data->status   =   0;
        $inactive_data->save();
        Toastr::success('message', 'Expence Category inactive successfully!');
        return redirect('admin/expence-category/manage');   
    }
    public function active(Request $request){
        $active_data         =   Expencecategory::find($request->hidden_id);
        $active_data->status =   1;
        $active_data->save();
        Toastr::success('message', 'Expence Category active successfully!');
        return redirect('admin/expence-category/manage');   
    }
    public function destroy(Request $request){
        $delete_data = Expencecategory::find($request->hidden_id);  
        $delete_data->delete();
        Toastr::success('message', 'Expence Category delete successfully!');
        return redirect('/admin/expence-category/manage');
    }
}
