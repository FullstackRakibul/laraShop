@extends('backEnd.layouts.master')
@section('title','Register')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage Register information</h3>
      			<div class="short_button">
              <a href="{{url('editor/register/manage')}}"><i class="fa fa-plus"></i>Manage</a>
      			</div>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Designation</th>
                  <th>Phone</th>
                  <th>Cv</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->customer_name}}</td>
                  <td>{{$value->customer_address}}</td>
                  <td>{{$value->customer_designation}}</td>
                  <td>{{$value->customer_phone}}</td>
                  <td><a href="{{url($value->cv)}}" download class="btn btn-success"><i class="fa fa-download"></i> Download</a></td>

                  <td>
                  	<ul class="action_buttons">
                  		<li>
                  			<form action="{{url('editor/register/delete')}}" method="POST">
                  				@csrf
                  				<input type="hidden" name="hidden_id" value="{{$value->id}}">
                  				<button type="submit" onclick="return confirm('Are you delete this information')" class="trash_icon" title="Delete"><i class="fa fa-trash"></i></button>
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