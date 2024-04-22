@extends('backEnd.layouts.master')
@section('title','Product Add')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Product information</h3>
          <div class="short_button">
            <a href="{{url('/editor/product/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
            <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="custom-bg">
                    <form action="{{url('/editor/product/save')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="col-sm-6">
                               <div class="form-group">
                                <label for="title">Category <span>*</span></label>
                                <select class="form-control select2{{ $errors->has('proCategory') ? ' is-invalid' : '' }}" value="{{ old('proCategory') }}" id="proCategory" name="proCategory">
                                    <option value="">Select Category...</option>
                                    @foreach($categories as $key=>$value) 
                                    <option value="{{$value->id}}" required>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                  @if ($errors->has('proCategory'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('proCategory') }}</strong>
                                  </span>
                                  @endif
                             </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-6">
                           <div class="form-group">
                            <label for="title">Brand  (Optional)</label>
                                <select name="proBrand" id="proBrand" class="select2 form-control{{ $errors->has('proBrand') ? ' is-invalid' : '' }}" >
                                  <option value="">====Select Brand====</option>
                                  @foreach($brands as $key=>$value)
                                  <option value="{{$value->id}}">{{$value->brandName}}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('proBrand'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('proBrand') }}</strong>
                                  </span>
                                  @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                               <div class="form-group">
                                <label for="title">Color (Optional)</label>
                                <select class="form-control select2{{ $errors->has('colorName') ? ' is-invalid' : '' }}" value="{{ old('colorName') }}" id="proCategory" name="colorName[]" multiple="multiple">
                                    <option value="" disabled>Select Color...</option>
                                    @foreach($colors as $key=>$value) 
                                    <option value="{{$value->id}}">{{$value->colorName}}</option>
                                    @endforeach
                                </select>
                                  @if ($errors->has('colorName'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('colorName') }}</strong>
                                  </span>
                                  @endif
                             </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-6">
                           <div class="form-group">
                            <label for="title">Size  (Optional)</label>
                                <select name="sizeName[]" id="sizeName" class="select2 form-control{{ $errors->has('sizeName') ? ' is-invalid' : '' }}" multiple="multiple">
                                  <option value="" disabled>====Select Size====</option>
                                  @foreach($sizes as $key=>$value)
                                  <option value="{{$value->id}}">{{$value->sizeName}}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('sizeName'))
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('sizeName') }}</strong>
                                  </span>
                                  @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                      <!-- /.form-group -->
                        <div class="col-sm-8">
                            <div class="form-group">
                              <label>Product Name <span>*</span></label>
                              <input type="text" name="proName" class="form-control{{ $errors->has('proName') ? ' is-invalid' : '' }}" value="{{ old('proName') }}">

                              @if ($errors->has('proName'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proName') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <!-- form group end -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Purchase Price <span>*</span></label>
                              <input type="number" name="proPurchaseprice" class="form-control{{ $errors->has('proPurchaseprice') ? ' is-invalid' : '' }}" value="{{ old('proPurchaseprice') }}">

                              @if ($errors->has('proPurchaseprice'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proPurchaseprice') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Old Price (Optional)</label>
                              <input type="number" name="proOldprice" class="form-control{{ $errors->has('proOldprice') ? ' is-invalid' : '' }}" value="{{ old('proOldprice') }}">

                              @if ($errors->has('proOldprice'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proOldprice') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>New Price(Sale) <span>*</span></label>
                          <input type="number" name="proNewprice" class="form-control{{ $errors->has('proNewprice') ? ' is-invalid' : '' }}" value="{{ old('proNewprice') }}">

                          @if ($errors->has('proNewprice'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('proNewprice') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="col-lg-4">
                    <div class="form-group">
                          <label for="image"> Product Image <span>*</span></label>
                          <input type="file" name="image[]" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" value="{{ old('image') }}" multiple="multiple">

                          @if ($errors->has('image'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                          </span>
                          @endif
                        </div>
                      <!-- /.form-group -->
                  </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label>Product Quantity <span>(Optional)</span></label>
                          <input type="number" name="proQuantity" class="form-control{{ $errors->has('proQuantity') ? ' is-invalid' : '' }}" value="{{ old('proQuantity') }}" min="1">

                          @if ($errors->has('proQuantity'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('proQuantity') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="col-sm-4">
                        <div class="form-group">
                          <label>Product Unit <span>(Optional)</span></label>
                          <input type="text" name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" value="{{ old('unit') }}" min="1">

                          @if ($errors->has('unit'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('unit') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                  <!-- /.form-group -->
                        <div class="col-sm-4">
                            <div class="form-group">
                              <label>Product Code (Optional)</label>
                              <input type="text" name="proCode" class="form-control{{ $errors->has('proCode') ? ' is-invalid' : '' }}" value="{{ old('proCode') }}">

                              @if ($errors->has('proCode'))
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('proCode') }}</strong>
                              </span>
                              @endif
                            </div>
                        </div>
                      <!-- /.form-group -->
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label for="text">Description</label>
                            <textarea name="proDescription" class="summernote form-control{{ $errors->has('proDescription') ? ' is-invalid' : '' }}" value="">{{ old('proDescription') }}</textarea>

                            @if ($errors->has('proDescription'))
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('proDescription') }}</strong>
                           </span>
                           @endif
                        </div>
                  </div>
                  <!-- /.form-group -->
                      <div class="col-sm-3">
                          <div class="form-group">
                            <label class="custom-label" for="bestsell"> Top Sell (Optional)</label>
                             <input type="checkbox" class="{{ $errors->has('bestsell') ? ' is-invalid' : '' }}" value="1" id="bestsell" name="bestsell" id="front">
                             @if ($errors->has('bestsell'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('bestsell') }}</strong>
                                </span>
                              @endif
                          </div>
                      </div>

                     <div class="col-sm-12">
                        <div class="form-group">
                            <label for="status">Publication Status</label>
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
                              @if ($errors->has('status'))
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('status') }}</strong>
                              </span>
                              @endif
                          </div>
                      </div>
                      <div class="col-sm-12 mrt-30">
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