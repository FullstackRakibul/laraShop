<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Expencecategory;
use App\Expence;
use Carbon\Carbon;
use DB;
class ExpenceController extends Controller
{
    public function add(){
    	$expencecategories = Expencecategory::where('status',1)
    	->get();
    	return view('backEnd.expence.add',compact('expencecategories'));
    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
    		'status'=>'required',
    	]);

    	$store_data           	  = 	new Expence();
        $store_data->name         =     $request->name;
    	$store_data->slug      	  = 	preg_replace('/\s+/u', '-', trim($request->name));
        $store_data->date         =     $request->date;
        $store_data->ammount      =     $request->ammount;
        $store_data->expencecategory_id      =     $request->expencecategory_id;
    	$store_data->status  	  = 	$request->status;
    	$store_data->save();
    	Toastr::success('message', 'Expence add successfully!');
    	return redirect('admin/expence/manage');
    }
    public function manage(Request $request){
            if($request->category && $request->filter && $request->start && $request->end){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
             ->where('expences',$request->category)
            ->whereBetween('expences.created_at', [$request->start, $request->end])
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter && $request->start && $request->end){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
             ->whereBetween('expences.created_at', [$request->start, $request->end])
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter==1){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter==2){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
             ->whereDate('expences.created_at',Carbon::today())
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter==3){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereDate('expences.created_at',Carbon::yesterday())
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter==4){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
             ->whereMonth('expences.created_at',Carbon::now()->month)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter==5){
            
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
             ->whereDate('expences.created_at',Carbon::now()->subMonth())
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = 1;
            $category = 1;
         }elseif($request->category==NULL && $request->filter==6){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereYear('expences.created_at',Carbon::now()->year)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category==NULL && $request->filter==7){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereYear('expences.created_at',Carbon::now()->subYear())
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==1){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==2){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereDate('expences.created_at',Carbon::today())
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==3){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereDate('expences.created_at',Carbon::yesterday())
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==4){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereMonth('expences.created_at',Carbon::now()->month)
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==5){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
             ->whereDate('expences.created_at',Carbon::now()->subMonth())
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==6){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereYear('expences.created_at',Carbon::now()->year)
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }elseif($request->category && $request->filter==7){
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->whereYear('expences.created_at',Carbon::now()->subYear())
            ->where('expences.expencecategory_id',$request->category)
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = $request->filter;
            $category = $request->category;
         }else{
            $show_data = DB::table('expences')
            ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
            ->select('expences.*', 'expencecategories.name as expencecatname')
            ->orderby('expences.id', 'DESC')
            ->get();
            $filter = 1;
            $category = 1;
         }
		return view('backEnd.expence.manage', compact('category','show_data','filter','category'));
		    
    }
    public function expencereports(){
        $expencecategories = Expencecategory::where('status',1)
        ->get();
       $show_data = DB::table('expences')
        ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
        ->select('expences.*', 'expencecategories.name as expencecatname')
        ->orderby('expences.id', 'DESC')
        ->get();
        return view('backEnd.reports.expence.show',compact('show_data','expencecategories'));
    }
    public function expencefilter(Request $request){
        $this->validate($request,[
            'expencecat'=>'required',
            'enddate'=>'required|date',
            'startdate'=>'required|date|before_or_equal:enddate',
        ]);
        $expencecategories = Expencecategory::where('status',1)
        ->get();
       $show_data = DB::table('expences')
        ->join('expencecategories', 'expences.expencecategory_id', '=', 'expencecategories.id')
        ->where('expences.expencecategory_id',$request->expencecat)
        ->whereDate('date','<=',$request->enddate)
        ->whereDate('date','>=',$request->startdate)
        ->orderby('expences.id', 'DESC')
        ->select('expences.*', 'expencecategories.name as expencecatname')
        ->get();
        return view('backEnd.reports.expence.filter',compact('show_data','expencecategories'));
    }
    public function edit($id){
        $expencecategories = Expencecategory::where('status',1)
        ->get();
        $edit_data =   Expence::find($id);
        return view('backEnd.expence.edit',compact('edit_data','expencecategories'));
    }

    public function update(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ]);

    	$update_data = Expence::find($request->hidden_id);
		$update_data->name     		 = 	$request->name;
        $update_data->slug           =  preg_replace('/\s+/u', '-', trim($request->name));
        $update_data->date         	 =     $request->date;
        $update_data->ammount        =     $request->ammount;
        $update_data->expencecategory_id        =     $request->expencecategory_id;
    	$update_data->status  	  	 = 	$request->status;
    	$update_data->save();
        Toastr::success('message', 'Expence Update successfully!');
        return redirect('admin/expence/manage');
    }
    public function inactive(Request $request){
        $inactive_data           =   Expence::find($request->hidden_id);
        $inactive_data->status   =   0;
        $inactive_data->save();
        Toastr::success('message', 'Expence inactive successfully!');
        return redirect('admin/expence/manage');   
    }
    public function active(Request $request){
        $active_data         =   Expence::find($request->hidden_id);
        $active_data->status =   1;
        $active_data->save();
        Toastr::success('message', 'Expence active successfully!');
        return redirect('admin/expence/manage');   
    }
    public function destroy(Request $request){
        $delete_data = Expence::find($request->hidden_id);  
        $delete_data->delete();
        Toastr::success('message', 'Expence delete successfully!');
        return redirect('/admin/expence/manage');
    }
}
