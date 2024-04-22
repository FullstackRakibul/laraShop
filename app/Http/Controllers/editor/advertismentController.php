<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Advertisement;
use App\Adcategory;
use DB;
use File;

class advertismentController extends Controller
{
    public function add(){
    	$adcategories = Adcategory::where('status',1)->orderBy('id','DESC')->get();
    	return view('backEnd.advertisment.add',compact('adcategories'));
    }
    public function store(Request $request){
    	$this->validate($request,[
            'adcategory_id'=>'required',
            'image'=>'required',
    		'status'=>'required',
    	]);

        // image upload
        $file = $request->file('image');
        $name = time().'-'.$file->getClientOriginalName();
        $uploadPath = 'public/uploads/adadvertisement/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

    	$store_data            = new Advertisement();
    	$store_data->adcategory_id  = $request->adcategory_id;
    	$store_data->link      = $request->link;
         $store_data->image    = $fileUrl;
    	$store_data->status    = $request->status;
    	$store_data->save();
    	Toastr::success('message', 'Advertisement add successfully!');
    	return redirect('/editor/advertisment/manage');
    }
    public function manage(){
    	$show_data = DB::table('advertisements')
    	->join('adcategories','advertisements.adcategory_id','=','adcategories.id')
    	->select('advertisements.*','adcategories.name')
    	->get();
    	return view('backEnd.advertisment.manage',['show_data'=>$show_data]);
    }
    public function edit($id){
        $edit_data    = Advertisement::find($id);
        $adcategories = Adcategory::where('status',1)->orderBy('id','DESC')->get();
        return view('backEnd.advertisment.edit',compact('edit_data','adcategories'));
    }

    public function update(Request $request){
         $update_data           =   Advertisement::find($request->hidden_id);
         $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/advertisement/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->adcategory_id      =    $request->adcategory_id;
        $update_data->link      =    $request->link;
        $update_data->image     =    $fileUrl;
        $update_data->status    =    $request->status;
        $update_data->save();
        Toastr::success('message', 'Advertisement Update successfully!');
        return redirect('editor/advertisment/manage');
    }
    public function inactive(Request $request){
        $Unpublished_data           =   Advertisement::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'Advertisement inactive successfully!');
        return redirect('editor/advertisment/manage');   
    }
    public function active(Request $request){
        $published_data         =   Advertisement::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Advertisement active successfully!');
        return redirect('editor/advertisment/manage');   
    }
    public function destroy(Request $request){
        $delete_data = Advertisement::find($request->hidden_id);
        File::delete(public_path() . 'public/uploads/advertisment', $delete_data->image); 
        $delete_data->delete();
        Toastr::success('message', 'Advertisement  delete successfully!');
        return redirect('/editor/advertisment/manage');
    }
    
}
