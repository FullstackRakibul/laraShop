<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Blogcategory;

class BlogcategoryController extends Controller
{
    public function index(){
    	return view('backEnd.blogcategory.add');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
    		'status'=>'required',
    	]);

    	$store_data            = new Blogcategory();
    	$store_data->name      = $request->name;
        $store_data->slug      = Str::slug($request->get('name'));
    	$store_data->status    = $request->status;
    	$store_data->save();
    	Toastr::success('message', 'Blog Category add successfully!');
    	return redirect('/editor/blogcategory/manage');
    }
    public function manage(){
    	$show_data = Blogcategory::orderBy('id','DESC')->get();
    	return view('backEnd.blogcategory.manage',['show_data'=>$show_data]);
    }
    public function edit($id){
        $edit_data =   Blogcategory::find($id);
        return view('backEnd.blogcategory.edit',[
            'edit_data'=>$edit_data
        ]);
    }

    public function update(Request $request){
        $update_data           =   Blogcategory::find($request->hidden_id);
        
        $update_data->name     =    $request->name;
        $update_data->slug      =   Str::slug($request->get('name'));
        $update_data->status   =    $request->status;
        $update_data->save();
        Toastr::success('message', 'Blog Category Update successfully!');
        return redirect('editor/blogcategory/manage');
    }
    public function unpublished(Request $request){
        $Unpublished_data           =   Blogcategory::find($request->hidden_id);
        $Unpublished_data->status   =   0;
        $Unpublished_data->save();
        Toastr::success('message', 'Blog Category inactive successfully!');
        return redirect('editor/blogcategory/manage');   
    }
    public function published(Request $request){
        $published_data         =   Blogcategory::find($request->hidden_id);
        $published_data->status =   1;
        $published_data->save();
        Toastr::success('message', 'Blog Category active successfully!');
        return redirect('editor/blogcategory/manage');   
    }
   

  
 }
