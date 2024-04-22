 @extends('frontEnd.layouts.master')
 @section('title','Forget Password')
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
		<div class="row">
			<div class="col-lg-4 col-sm-4"></div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<div class="forget-password">
					<h4>Forget Password Reset</h4>
					<p>Please check your email and collect your verify token</p>
					<form action="{{url('customer/forget-password/reset')}}" method="POST">
						@csrf
						  <div class="form-group">
							<label for="verifycode">Verify Token</label>
							<input type="text" name="verifycode" id="verifycode" class="form-control{{$errors->has('verifycode')? 'is-invalid' : ''}}" value="{{ old('verifycode') }}">
							@if ($errors->has('verifycode'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('verifycode') }}</strong>
                                </span>
                            @endif
						</div>

						 <div class="form-group">
							<label for="newpassword">New Password</label>
							<input type="password" name="newpassword" id="newpassword" class="form-control{{$errors->has('newpassword')? 'is-invalid' : ''}}" value="{{ old('newpassword') }}">
							@if ($errors->has('newpassword'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('newpassword') }}</strong>
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
	</div>
	@endsection