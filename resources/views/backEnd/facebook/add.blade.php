@extends('backEnd.layouts.master')
@section('title','color Add')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Add Facebook Api Source Code</h3>
          <div class="short_button">
            <a href="{{url('/editor/facebook/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('/editor/facebook/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                         <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="text">Source Code</label>
                                    <textarea name="code" class="summernote form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="">{{ old('code') }}</textarea>
        
                                    @if ($errors->has('code'))
                                   <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('code') }}</strong>
                                   </span>
                                   @endif
                                </div>
                          </div>
                      <div class="col-sm-12">
                          <div class="form-group">
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