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
                            @if(Cart::content())
                            <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Customer <i class="fa fa-angle-right"></i></a></li>
                            @endif
                            <li><a class="anchor">Forget Password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-sm-6">
                      <div class="forget-password">
                        <h4>Forget Password</h4>
                        <form action="{{url('customer/forget-password')}}" method="POST">
                          @csrf
                           <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control{{$errors->has('email')? 'is-invalid' : ''}}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                          <div class="form-group">
                            <input type="submit" class="form-control submit-btn" value="send">
                          </div>
                        </form>
                      </div>
                    </div>
                </div>
            </div>
        </section>
        
    @endsection