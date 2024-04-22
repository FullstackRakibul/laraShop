@extends('backEnd.layouts.master')
@section('title','delivery Add')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Add delivery information</h3>
          <div class="short_button">
            <a href="{{url('/editor/delivery/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('/editor/delivery/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                         <div class="col-sm-12">
                            <div class="form-group">
                              <label>shipping Area</label>
                              <input type="text" name="area" class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}">

                              @if ($errors->has('area'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('area') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="col-sm-12">
                            <div class="form-group">
                              <label>shipping Charge</label>
                              <input type="text" name="shipping_charge" class="form-control{{ $errors->has('shipping_charge') ? ' is-invalid' : '' }}">

                              @if ($errors->has('shipping_charge'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('shipping_charge') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                        <!-- form-group end -->
                        <div class="col-sm-12">
                          <label for="">Publication Status <span>*</span></label>
                          <div class="box-body pub-stat display-inline">
                              
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" id="active" name="status" value="1">
                              <label for="active">Active</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>

                          <div class="box-body pub-stat display-inline">
                              <input class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" type="radio" name="status" value="0" id="inactive">
                              <label for="inactive">Inactive</label>
                              @if ($errors->has('status'))
                              <span class="invalid-feedback">
                                <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                       </div>
                        </div>
                      <div class="col-sm-6">
                          <div class="form-group mrt-30">
                              <button type="submit" class="btn submit-button">submit</button>
                              <button type="reset" class="btn btn-default">clear</button>
                          </div>
                      </div>
                      <!-- /.form-group -->
                 </div>
                </div>
              </div>
            <!-- /.col -->
              </form>
          </div>
        <!--card-body-->
      </div>
      <!--card-->
    </div>
  <!--container-fluid-->
  </section>
  <!-- /.content -->
@endsection