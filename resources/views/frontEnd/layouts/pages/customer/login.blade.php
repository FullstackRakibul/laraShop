 @extends('frontEnd.layouts.master')
 @section('title','Login')
 @section('content')
        <!--common html-->
       <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                             @include('frontEnd.layouts.includes.sidebar')  
                            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                            @if(Cart::content())
                            <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Shopping <i class="fa fa-angle-right"></i></a></li>
                            @endif
                            <li><a class="anchor">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="section-padding">
           <div class="container-fluid">
             <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="auth-image">
                        <img src="{{asset('public/frontEnd/images/register.jpg')}}" alt="">
                        <div class="auth-short">
                          <h4>Register</h4>
                          <a href="{{url(('customer/register'))}}" >Login for click here</a>
                        </div>
                    </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="login-content">
                        <h2 class="login-title">Login</h2>
                        <p>If you have already account please login here</p>
                        <form action="{{url('customer/panel/login')}}" method="POST">
                            @csrf
                            <div class="from-group">
                                <label for="phoneOremail">Email Or Phone</label>
                                <input type="text" name="phoneOremail" autocomplete="off" class="form-control {{ $errors->has('phoneOremail') ? ' is-invalid' : '' }}"  value="{{ old('phoneOremail') }}" required="required">
                                @if ($errors->has('phoneOremail'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phoneOremail') }}</strong>
                                  </span>
                                  @endif
                            </div>
                            <!-- form group -->
                            <div class="form-group">
                              <label for="password">Password</label>
                                <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" >
                                @if ($errors->has('password'))
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <input class="login-sub" type="submit" value="Login">
                            <a href="{{url('/customer/forget-password')}}" style="margin-left:10px; text-decoration: underline;">Forget Password</a>
                        </form>
                    </div>
                    <!--login content end-->
                </div>
                <!-- col end -->
             </div>
           </div>
        </section>
        
    @endsection