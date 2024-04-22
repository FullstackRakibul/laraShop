@extends('backEnd.layouts.master')
@section('title','User Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage user information</h3>
      			<div class="short_button">
              <a href="{{url('superadmin/user/add')}}"><i class="fa fa-plus"></i>Add</a>
      			</div>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Role</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($show_datas as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->phone}}</td>
                  <td>{{$value->user_role}}</td>
                  <td><img src="{{asset($value->image)}}" class="backend_image" alt=""></td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                  <td>
                  	<ul class="action_buttons">
                  		<li>
                  			@if($value->status==1)
                  			<form action="{{url('superadmin/user/inactive')}}" method="POST">
                  				@csrf
                  				<input type="hidden" name="hidden_id" value="{{$value->id}}">
                  				<button type="submit" class="thumbs_up"><i class="fa fa-thumbs-up"></i></button>
                  			</form>
                  			@else
	                  			<form action="{{url('superadmin/user/active')}}" method="POST">
	                  				@csrf
	                  				<input type="hidden" name="hidden_id" value="{{$value->id}}">
	                  				<button type="submit" class="thumbs_down"><i class="fa fa-thumbs-down"></i></button>
	                  			</form>
                  			@endif
                  		</li>
                  		<li>
                  			<a class="edit_icon" href="{{url('superadmin/user/edit/'.$value->id)}}"><i class="fa fa-edit"></i></a>
                  		</li>
                  		<li>
                  			<form action="{{url('superadmin/user/delete')}}" method="POST">
                  				@csrf
                  				<input type="hidden" name="hidden_id" value="{{$value->id}}">
                  				<button type="submit" onclick="return confirm('Are you delete this user?')" class="trash_icon"><i class="fa fa-trash"></i></button>
                  			</form>
                  		</li>
                  	</ul>
                  </td>
                </tr>
                @endforeach
                </tfoot>
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