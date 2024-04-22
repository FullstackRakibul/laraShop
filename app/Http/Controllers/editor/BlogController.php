<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Blog;
use App\Blogcategory;
use File;
use DB;
use Auth;

class BlogController extends Controller
{
    public function index(){
    	$blogcategories = Blogcategory::orderBy('id','DESC')->get();
    	return view('backEnd.blog.add',compact('blogcategories'));
    }
    public function store(Request $request){
    	$this->validate($request,[
            'title'=>'required',
            'blogcategory_id'=>'required',
            'description'=>'required',
            'image'=>'required',
            'status'=>'required',
        ]);

        // image upload
        $file = $request->file('image');
        $name = $file->getClientOriginalName();
        $uploadPath = 'public/uploads/blog/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

        $store_data = new Blog();
        $store_data->title              = $request->title;
        $store_data->slug               = strtolower(preg_replace('/\s+/', '-', $request->title));
        $store_data->blogcategory_id    = $request->blogcategory_id;
        $store_data->description        = $request->description;
        $store_data->userid             = Auth::user()->id;
        $store_data->image              = $fileUrl;
        $store_data->status             = $request->status;
        $store_data->save();
        Toastr::success('message', 'Blog  add successfully!');
    	return redirect('/editor/blog/manage');
    }
    public function manage(){
    	$show_data = DB::table('blogs')
    	->join('blogcategories','blogs.blogcategory_id','=','blogcategories.id')
    	->select('blogcategories.name','blogs.*')
    	->get();
        return view('backEnd.blog.manage',compact('show_data'));
    }
    public function edit($id){
    	$blogcategories = Blogcategory::orderBy('id','DESC')->get();
        $edit_data = Blog::find($id);
        return view('backEnd.blog.edit', compact('edit_data','blogcategories'));
    }
     public function update(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'blogcategory_id'=>'required',
            'description'=>'required',
            'status'=>'required',
        ]);

        $update_data = Blog::find($request->hidden_id);
        $update_image = $request->file('image');
        if ($update_image) {
           $file = $request->file('image');
            File::delete(public_path() . 'public/uploads/blog', $update_data->image); 
            $name = time().'-'.$file->getClientOriginalName();
            $uploadPath = 'public/uploads/blog/';
            $file->move($uploadPath,$name);
            $fileUrl =$uploadPath.$name;
        }else{
            $fileUrl = $update_data->image;
        }

        $update_data->title           = $request->title;
        $update_data->blogcategory_id = $request->blogcategory_id;
        $update_data->slug            = strtolower(preg_replace('/\s+/', '-', $request->title));
        $update_data->description     = $request->description;
        $update_data->image           = $fileUrl;
        $update_data->userid          = Auth::user()->id;
        $update_data->status          = $request->status;
        $update_data->save();
        Toastr::success('message', 'Blog  update successfully!');
        return redirect('/editor/blog/manage');
    }

    public function unpublished(Request $request){
        $unpublish_data = Blog::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Blog  inactive successfully!');
        return redirect('/editor/blog/manage');
    }

    public function published(Request $request){
        $publishId = Blog::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Blog  active successfully!');
        return redirect('/editor/blog/manage');
    }
     public function destroy(Request $request){
        $deleteId = Blog::find($request->hidden_id);
         File::delete(public_path() . 'public/uploads/blog', $deleteId->image);
        $deleteId->delete();
        Toastr::success('message', 'Blog  delete successfully!');
        return redirect('/editor/blog/manage');
    }
}
