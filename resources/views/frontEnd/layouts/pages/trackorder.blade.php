 @extends('frontEnd.layouts.master')
 @section('title','Forget Password')
 @section('content')
<!--common html-->
<div class="custom-breadcrumb">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <ul>
                    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                    <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                    <li><a class="anchor">Track Order</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--custom breadcrumb end-->
<section class="section-padding">
   <div class="container-fluid">
     <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="forget-password">
            <h4>Track Order</h4>
            <form action="{{url('customer/forget-password')}}" method="POST">
              @csrf
               <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="number" name="phoneNumber" id="phoneNumber" class="form-control{{$errors->has('phoneNumber')? 'is-invalid' : ''}}" value="{{ old('phoneNumber') }}">
                @if ($errors->has('phoneNumber'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('phoneNumber') }}</strong>
                    </span>
                @endif
              </div>
               <div class="form-group">
                <label for="trackingId">Tracking Number</label>
                <input type="number" name="trackingId" id="trackingId" class="form-control{{$errors->has('trackingId')? 'is-invalid' : ''}}" value="{{ old('trackingId') }}">
                @if ($errors->has('trackingId'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('trackingId') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <input type="submit" class="form-control submit-btn" value="Track Order">
              </div>
            </form>
          </div>
        </div>
      </div>
   </div>
</section>
    
@endsection