@extends('backEnd.layouts.master')
@section('title','Expence Category Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage Expence Category</h3>
            <div class="short_button">
              <a href="{{url('admin/expence-category/add')}}"><i class="fa fa-plus"></i>Add</a>
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-responsive-sm table-bordered table-striped custom-table">
              <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->status==1? "Active":"Inactive"}}</td>
                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                        <li>
                          @if($value->status==1)
                          <form action="{{url('admin/expence-category/inactive')}}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$value->id}}">
                            <button type="submit" class="thumbs_down" title="unpublished"><i class="fa fa-thumbs-down"></i> Inactive</button>
                          </form>
                          @else
                            <form action="{{url('admin/expence-category/active')}}" method="POST">
                              @csrf
                              <input type="hidden" name="hidden_id" value="{{$value->id}}">
                              <button type="submit" class="thumbs_up" title="published"><i class="fa fa-thumbs-up"></i> Active</button>
                            </form>
                          @endif
                        </li>
                          <li>
                              <a class="edit_icon" href="{{url('admin/expence-category/edit/'.$value->id)}}" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                          </li>
                          <!-- <li>
                            <form action="{{url('admin/expence-category/delete')}}" method="POST">
                              @csrf
                              <input type="hidden" name="hidden_id" value="{{$value->id}}">
                              <button type="submit" onclick="return confirm('Are you delete this this?')" class="trash_icon" title="Delete"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                          </li> -->
                      </ul>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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