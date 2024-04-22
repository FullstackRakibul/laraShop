@extends('backEnd.layouts.master')
@section('title','product Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Order product</h3>
      			<div class="short_button">
              <!--<a href="{{url('editor/product/add')}}"><i class="fa fa-plus"></i>Add</a>-->
      			</div>
            </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
                <form action="{{url('editor/product/order')}}" method="POST" id="myform" class="bulk-status-form">
                      @csrf
                      <div class="form-group">
                    <label for="recipient-name" class="col-form-label">কাস্টমার নির্বাচন করুন <span>*</span></label>
                    <select type="text"  class="form-control" name="customer" value="{{old('customer')}}" required>
                        <option value=""selected disabled>নির্বাচন করুন  </option>
                         @foreach($customers as $customer)
                         <option value="{{ $customer->id }}">{{ $customer->fullName }}</option>
                         @endforeach
                    </select>
                  </div>
                      <div class="form-group">
                    <label for="recipient-name" class="col-form-label"> নাম <span>*</span></label>
                    <input type="text" placeholder="কাস্টমার সম্পূর্ণ নাম লিখুন"  class="form-control" value="{{old('fullName')}}" name="fullName" required>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">মোবাইল নম্বর <span>*</span></label>
                    <input type="number" placeholder="কাস্টমার মোবাইল নাম্বার লিখুন " class="form-control" name="phoneNumber" value="{{old('phoneNumber')}}" required minlength="11" maxlength="11">
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
                    <input type="text" placeholder="কাস্টমার সম্পূর্ণ ঠিকানা লিখুন"  class="form-control" name="address" value="{{old('address')}}" required>
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
                       <input type="hidden" name="product_ids" value="{{ implode(',', $productIds) }}">
                     <button type="submit" class="btn btn-success"  style="padding:6px 20px; margin-bottom:4px; margin-left:25px;">Confirm</button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection