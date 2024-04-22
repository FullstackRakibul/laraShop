@extends('frontEnd.layouts.master')
@section('title','Customer Profile')
@section('content')
    <!--common html-->
        <section class="customer-profile ">
            <div class="container-fluid">
                <div class="row">
                    <div class="paddleft-120 col-lg-12 col-md-12 col-sm-4">
                        <div class="customer-profile">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3 col-md-3">
                                    <div class="cprofile-sidebar">
                                         @include('frontEnd.layouts.pages.customer.sidebar')
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <div class="cprofile-details">
                                        <p class="account-title">Account Information</p>
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col">Information</th>
                                              <th scope="col"><a class="anchor" data-toggle="modal" data-target="#editProfile"><i class="fa fa-edit"></i> Edit</a></th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php
                                                $customerId = Session::get('customerId');
                                                $customerInfo=App\Customer::find($customerId);
                                            @endphp
                                            <tr>
                                              <th scope="row">Image</th>
                                              <td><img src="{{asset($customerInfo->image)}}" alt="" style="width:50px; height:50px;border-radius: 50%"></td>
                                            </tr>
                                            <tr>
                                            <tr>
                                              <th scope="row">Name</th>
                                              <td>{{$customerInfo->fullName}}</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Phone</th>
                                              <td>{{$customerInfo->phoneNumber}}</td>
                                            </tr>
                                            @if($customerInfo->email)
                                            <tr>
                                              <th scope="row">Email</th>
                                              <td>{{$customerInfo->email}}</td>
                                            </tr>
                                            @endif
                                            @if($customerInfo->address)
                                            <tr>
                                              <th scope="row">Address</th>
                                              <td>{{$customerInfo->address}}</td>
                                            </tr>
                                            @endif
                                          </tbody>
                                        </table>
                                        <section>
                                       <div id="editProfile" class="modal" role="dialog">
                                          <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header"> 
                                              <strong>Profile Edit</strong>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              </div>
                                              <div class="modal-body">
                                                 <div class="row">
                                                    <div class="col-sm-12">
                                                        <form action="{{url('customer/profile-edit')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label>Full Name</label>
                                                                <input type="text" class="form-control" name="fullName" value="{{$customerInfo->fullName}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Phone</label>
                                                                <input type="text" class="form-control" name="phoneNumber" value="{{$customerInfo->phoneNumber}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="text" class="form-control" name="email" value="{{$customerInfo->email}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <textarea class="form-control" name="address">{!! $customerInfo->address !!}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <input type="file" class="form-control" name="image">
                                                                <img src="{{asset($customerInfo->image)}}" alt="" style="width:50px; height:50px;border-radius: 50%;margin-top:5px;">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="submit" class="btn btn-success" value="Save Change">
                                                            </div>
                                                        </form>
                                                     </div>
                                                   </div>
                                                   <!-- col end -->
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                   </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection