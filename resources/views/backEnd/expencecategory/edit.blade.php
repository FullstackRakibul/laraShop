@extends('backEnd.layouts.master')
@section('title','Expence category Edit')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Expence category edit</h3>
          <div class="short_button">
            <a href="{{url('admin/expence-category/manage')}}"><i class="fa fa-cogs"></i>Manage</a>
          </div>
      </div>
      <!--card-header -->
          <div id="form_body" class="card-body">
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-md-8">
                  <div class="custom-bg">
                    <form action="{{url('admin/expence-category/update')}}" method="POST" enctype="multipart/form-data" name="editForm">
                      @csrf
                      <div class="main-body">
                        <div class="row">
                           <input type="hidden" value="{{$edit_data->id}}" name="hidden_id">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="name">Expence Category</label>
                              <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$edit_data->name}}">
                               @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                           
                          </div>
                          <!-- column end -->

                          <div class="col-sm-12">
                            <div class="form-group">
                              <div class="custom-label">
                                <label>Publication Status</label>
                              </div>
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
                          <div class="col-sm-12 mrt-15">
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
               </div>
            </div>
        </div>
        <!--card-body-->
      </div>
      <!--card-->
  </div>
  <!--container-fluid-->
  <script type="text/javascript">
        document.forms['editForm'].elements['status'].value={{$edit_data->status}}
    </script>
  </section>
  <!-- /.content -->
@endsection