<?php

namespace App\Http\Controllers\editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Facebook;

class FbController extends Controller
{
    public function add(){
    	return view('backEnd.facebook.add');
    }
    public function store(Request $request){
    	$this->validate($request,[
            'code'=>'required',
    	]);
    	$store_data            = new Facebook();
        $store_data->code      = $request->code;
    	$store_data->save();
    	Toastr::success('message', 'facebook source code add successfully!');
    	return redirect('/editor/facebook/manage');
    }
    public function manage(){
    	$show_data = Facebook::latest()->get();
    	return view('backEnd.facebook.manage',['show_data'=>$show_data]);
    }
     public function destroy(Request $request){
        $deleteId = Facebook::find($request->hidden_id);
        $deleteId->delete();
        Toastr::success('message', 'facebook source code delete successfully!');
        return redirect('/editor/facebook/manage');
    }
}
