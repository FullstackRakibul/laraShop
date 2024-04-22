@extends('backEnd.layouts.master')
@section('title','Customer List')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Customer List</h3>
            <div class="short_button">
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->fullName}}</td>
                  <td>{{$value->phoneNumber}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->address}}</td>
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