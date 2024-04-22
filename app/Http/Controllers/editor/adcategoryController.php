<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Adcategory;

class adcategoryController extends Controller
{
    public function add(){
    	return view('backEnd.adcategory.add');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
    		'status'=>'required',
    	]);

       

    	$store_data            = new Adcategory();
    	$store_data->name      = $request->name;
    	$store_data->status    = $request->status;
    	$store_data->save();
    	Toastr::success('message', 'Ad Category add successfully!');
    	return redirect('/editor/adcategory/manage');
    }
    public function manage(){
    	$show_data = Adcategory::orderBy('id','DESC')->get();
    	return view('backEnd.adcategory.manage',['show_data'=>$show_data]);
    }
    public function edit($id){
        $edit_data =   Adcategory::find($id);
        return view('backEnd.adcategory.edit',[
            'edit_data'=>$edit_data
        ]);
    }

    public function update(Request $request){
        $update_data           =   Adcategory::find($request->hidden_id);
         $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/adcategory/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->name     =    $request->name;
        $update_data->status   =    $request->status;
        $update_data->save();
        Toastr::success('message', 'Ad Category Update successfully!');
        return redirect('editor/adcategory/manage');
    }
    public function inactive(Request $request){
        $Unpublished_data           =   Adcategory::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'Ad Category inactive successfully!');
        return redirect('editor/adcategory/manage');   
    }
    public function active(Request $request){
        $published_data         =   Adcategory::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Ad Category active successfully!');
        return redirect('editor/adcategory/manage');   
    }
   

    
}
