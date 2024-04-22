 @extends('frontEnd.layouts.master')
 @section('title','Shipping')
 @section('content')
  <!--common html-->
        <div class="custom-breadcrumb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                          @include('frontEnd.layouts.includes.sidebar')
                            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                            @if(Cart::content())
                            <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Shopping <i class="fa fa-angle-right"></i></a></li>
                            @endif
                            <li><a class="anchor">Shipping</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="ordernow-form checkout-form">
           <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-sm-6">
                <form action="{{url('customer/order-save')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label"> নাম <span>*</span></label>
                    <input type="text" placeholder="আপনার সম্পূর্ণ নাম লিখুন"  class="form-control" value="{{old('fullName')}}" name="fullName" required>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">মোবাইল নম্বর <span>*</span></label>
                    <input type="number" placeholder="আপনার মোবাইল নাম্বার লিখুন " class="form-control" name="phoneNumber" value="{{old('phoneNumber')}}" required minlength="11" maxlength="11">
                    @error('phoneNumber')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  
                  <!--<div class="form-group">-->
                  <!--  <label for="emailAddress" class="col-form-label">Email Address <span>*</span></label>-->
                  <!--  <input type="text" placeholder="Enter Your Email Address" class="form-control" name="emailAddress" value="{{old('emailAddress')}}">-->
                  <!--</div>-->
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">ঠিকানা <span>*</span> </label>
                    <input type="text" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন"  class="form-control" name="address" value="{{old('address')}}" required>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">নির্বাচন করুন <span>*</span></label>
                    <select type="text"  class="form-control" name="area" value="{{old('area')}}" required>
                        <option value=""selected disabled>নির্বাচন করুন  </option>
                        @foreach($deliveries as $delivery)
                        <option value="{{ $delivery->shipping_charge }}">{{ $delivery->area }} ({{ $delivery->shipping_charge }} টাকা)</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary">Order Now</button>
                  </div>
                </form>
              </div>
            </div>
             </div>
           </div>
        </section>
 @endsection