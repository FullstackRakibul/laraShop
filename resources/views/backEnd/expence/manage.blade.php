@extends('backEnd.layouts.master')
@section('title','Expence Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="dashboard-filter">
              <form class="form-row">
                    <div class="col-sm-2">
                        <div class="from-group">
                             <label>Category</label>
                              <select name="category" class="form-control">
                                  <option value="">All</option>
                                  @foreach($expencetypes as $expencetype)
                                  <option value="{{$expencetype->id}}" {{ $category ==$expencetype->id  ? 'selected' : '' }} class="form-control">{{$expencetype->name}}</option>
                                  @endforeach
                             </select>
                         </div>
                     </div>
                    <div class="col-sm-2">
                        <label>Date Filter</label>
                        <select class="form-control" name="filter">
                            <option value="1" {{ $filter== 1 ? 'selected' : '' }}>All</option>
                            <option value="2" {{ $filter == 2 ? 'selected' : '' }}>Today</option>
                            <option value="3" {{ $filter == 3 ? 'selected' : '' }}>Yesterday</option>
                            <option value="4" {{ $filter == 4 ? 'selected' : '' }}>Current Month</option>
                            <option value="5" {{ $filter == 5 ? 'selected' : '' }}>Last Month</option>
                            <option value="6" {{ $filter == 6 ? 'selected' : '' }}>Current Year</option>
                            <option value="7" {{ $filter == 7 ? 'selected' : '' }}>Last Year</option>
                        </select>
                   </div>
                    <div class="col-sm-2">
                        <label>Start (optional)</label>
                        <input class="form-control mydate" name="start" type="date" value="{{old('mydate')}}">
                   </div>
                    <div class="col-sm-2">
                        <label>End (optional)</label>
                        <input class="form-control mydate"name="end" type="date" value="{{old('end')}}">
                   </div>
                    <div class="col-sm-2">
                        <label></label>
                        <input class="btn btn-success" value="Apply" type="submit">
                   </div>
              </form>
          </div>
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage Expence</h3>
            <div class="short_button">
              <a href="{{url('admin/expence/add')}}"><i class="fa fa-plus"></i>Add</a>
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table  class="example table table-responsive-sm table-bordered table-striped custom-table">
              <thead>
              <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php $total = 0; @endphp
                @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$value->expencecatname}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->ammount}}</td>
                  <td>{{$value->status==1? "Active":"Inactive"}}</td>
                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                      <li>
                          @if($value->status==1)
                          <form action="{{url('admin/expence/inactive')}}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$value->id}}">
                            <button type="submit" class="thumbs_down" title="unpublished"><i class="fa fa-thumbs-down"></i> Inactive</button>
                          </form>
                          @else
                            <form action="{{url('admin/expence/active')}}" method="POST">
                              @csrf
                              <input type="hidden" name="hidden_id" value="{{$value->id}}">
                              <button type="submit" class="thumbs_up" title="published"><i class="fa fa-thumbs-up"></i> Active</button>
                            </form>
                          @endif
                        </li>
                          <li>
                              <a class="edit_icon" href="{{url('admin/expence/edit/'.$value->id)}}" title="Edit"><i class="fa fa-edit"></i> Edit</a>
                          </li>
                          <li>
                            <form action="{{url('admin/expence/delete')}}" method="POST">
                              @csrf
                              <input type="hidden" name="hidden_id" value="{{$value->id}}">
                              <button type="submit" onclick="return confirm('Are you delete this this?')" class="trash_icon" title="Delete"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                          </li>
                      </ul>
                  </td>
                  @php
                    $total += $value->ammount;
                  @endphp
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <td></td>
                  <td><strong>Total</strong></td>
                  <td><strong>{{$total}}</strong></td>
                  <td></td>
                  <td></td>
                </tr>
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
    <script>
$(document).ready(function() {
  $('.example').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'copy',
              text: 'Copy',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'excel',
              text: 'Excel',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'csv',
              text: 'Csv',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'pdfHtml5',
              exportOptions: {
                 columns: [ 0, 1, 2, 3, 4]
              }
          },
          
          {
              extend: 'print',
              text: 'Print',
              exportOptions: {
                  columns: [ 0, 1, 2, 3, 4]
              }
          },
          {
              extend: 'print',
              text: 'Print all',
              exportOptions: {
                  modifier: {
                      selected: null
                  }
              }
          },
          {
              extend: 'colvis',
          },
          
      ],
      select: true
  } );
  
   table.buttons().container()
      .appendTo( '#example_wrapper .col-md-6:eq(11)' );
});
</script>
@endsection