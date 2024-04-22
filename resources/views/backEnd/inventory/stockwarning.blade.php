@extends('backEnd.layouts.master')
@section('title','Stock Out')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Manage Stock Out</h3>
            <div class="short_button">
              <a href="{{url('editor/product/stock')}}"><i class="fa fa-plus"></i>Stock</a>
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body user-border">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Name</th>
                  <th>Basic Info</th>
                  <th>Image</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Purchase</th>
                </tr>
                </thead>
                <tbody>
                  @php
                    $total = 0;
                  @endphp
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{substr($value->proName,0,50)}}</td>
                  <td><strong>Category =</strong> {{$value->name}}
                  </td>
                 <td>
                  @foreach($productimage as $image)
                    @if($value->id==$image->product_id) <img src="{{asset($image->image)}}" alt="" class="small_image">
                    @endif
                  @endforeach
                  </td>
                  <td> {{$value->proQuantity}}</td>
                  <td> {{$value->status==1?'Active':'Inactive'}}</td>
                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li>
                            <a class="edit_icon" href="{{url('editor/product/edit/'.$value->id)}}" title="Edit"><i class="fa fa-edit"></i> Edit
                             </a>
                          </li>
                        </ul>
                    </ul>
                  </td>
                  @php
                    $total +=$value->proQuantity;
                  @endphp
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td><strong>{{$total}} Pcs</strong></td>
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
@endsection