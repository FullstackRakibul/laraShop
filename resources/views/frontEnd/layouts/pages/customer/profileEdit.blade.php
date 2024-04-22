@extends('frontEnd.layouts.master')
@section('title','Profile Edit')
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
                                <p class="account-title">Profile Edit</p>
                                <section class="profile_edit">     
                                    <form action="{{url('customer/profile-update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="fullName" value="{{$customerInfo?$customerInfo->fullName:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phoneNumber" value="{{$customerInfo?$customerInfo->phoneNumber:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{$customerInfo?$customerInfo->email:''}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address">{!! $customerInfo?$customerInfo->address:'' !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image">
                                        <img src="{{asset($customerInfo?$customerInfo->image:'')}}" alt="" style="width:50px; height:50px;border-radius: 50%;margin-top:5px;">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="Save Change">
                                    </div>
                                </form>                       
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