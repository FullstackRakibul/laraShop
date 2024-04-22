 @extends('frontEnd.layouts.master')
 @section('title','Email Verification')
 @section('content')
        <!--common html-->
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                            @include('frontEnd.layouts.includes.sidebar') 
                            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home <i class="fa fa-angle-right"></i></a></li>
                            <li><a href="{{url('/register')}}">Register <i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Verify</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section  class="loginregister verify  section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="login-content">
                            <h2 class="login-title">Email Verification</h2>
                            <p>Plese check your email in inbox or spam and put here 6-digit verify pin</p>
                            <form action="{{url('customer/verified')}}" method="POST">
                                @csrf
                                <div class="from-group">
                                    <label for="verifyPin">Pin Number</label>
                                    <input type="text" name="verifyPin" class="form-control {{ $errors->has('verifyPin') ? ' is-invalid' : '' }}" placeholder="****" value="{{ old('verifyPin') }}">
                                    @if ($errors->has('verifyPin'))
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('verifyPin') }}</strong>
                                      </span>
                                      @endif
                                </div>
                                <!-- form group -->
                                <input class="login-sub" type="submit" value="Submit">
                                @php
                                    $customerId = Session::get('customerId');
                                    $ifverified=App\Customer::where(['id'=>$customerId])->first();
                                @endphp
                                <a href="{{url('resend/code/'.$ifverified->id)}}" class="resendcode"><i class="fa fa-repeat"></i> resend code</a>

                            </form>
                        </div>
                        <!--login content end-->
                    </div>
                    <!--col end-->
                    <div class="col-sm-3"></div>
                </div>
            </div>
            <!--row end-->
        </section>
        <!--loginregister css end-->
    @endsection