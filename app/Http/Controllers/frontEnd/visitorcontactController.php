<?php

namespace App\Http\Controllers\frontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Post;
use App\Customerapply;
 use Mail;
class visitorcontactController extends Controller
{
   public function visitorcontact(Request $request){
      $this->validate($request, [
         'contact_subject'=>'required',
         'contact_email'=>'required',
         'name'=>'required',
         'contact_phone'=>'required',
         'contact_text'=>'required',
        ]);
      $data = array(
         'contact_subject' => $request->contact_subject,
         'contact_email' => $request->contact_email,
         'name' => $request->name,
         'contact_phone' => $request->contact_phone,
         'contact_text' => $request->contact_text,
        );
        
        return $data;

        $send = Mail::send('frontEnd.emails.email', $data, function($textmsg) use ($data){
         $textmsg->from($data['contact_email']);
         $textmsg->to('info@ekroy.com.bd');
         $textmsg->subject($data['contact_text']);
        });

        Toastr::success('message', 'Thanks! your message send successfully!');
        return redirect()->back();
        }

    public function customerapply(Request $request){
      $this->validate($request, [
         'customer_name'=>'required',
         'customer_address'=>'required',
         'customer_designation'=>'required',
         'customer_phone'=>'required',
         'cv'=>'required',
        ]);

      $file = $request->file('cv');
        $name = time().$file->getClientOriginalName();
        $uploadPath = 'public/uploads/cv/';
        $file->move($uploadPath,$name);
        $fileUrl =$uploadPath.$name;

      $store_data = new Customerapply();
        $store_data->customer_name          = $request->customer_name;
        $store_data->customer_address       = $request->customer_address;
        $store_data->customer_designation   = $request->customer_designation;
        $store_data->customer_phone         = $request->customer_phone;
        $store_data->cv                     = $fileUrl;

        $store_data->save();
        if($store_data){
          Toastr::success('message', 'Registration successfully!');
          return redirect()->back();
        }else{
          Toastr::success('message', 'Registration successfully!');
          return redirect()->back();
        }
    }
}
