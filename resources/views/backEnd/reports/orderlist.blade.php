@extends('backEnd.layouts.master')
@section('title','Order  Manage')
@section('main_content')
 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">{{$ordertype->name}} Order</h3>
            <div class="short_button">
            </div>
          </div>
          <!-- /.card-header -->
            <div class="card-body">
              <table id="example" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl</th>
                  <th>Track Id</th>
                  <th>Customer Name</th>
                  <th>Customer Phone</th>
                  <th>Total Price</th>
                  <th>Order Time</th>
                  <th>Cancel Request</th>
                  <th>Order Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($show_data as $key=>$value)
                <tr>
                  <td>{{$loop->iteration}}</td>
                   <td>{{$value->trackingId}}</td>
                  <td>{{$value->fullName}}</td>
                  <td>{{$value->phoneNumber}}</td>
                  <td>BTD {{$value->orderTotal}}</td>
                  <td>{{$value->cancelRequest==1?'Yes':'No'}}</td>
                  <td><p><strong>Date: </strong> {{date('F d, Y', strtotime($value->updated_at))}}</p>
                    <p><strong>Time: </strong> {{date('h:i:s a', strtotime($value->updated_at))}}</p></td>
                  <td>
                    {{$ordertype->name}}
                  </td>

                  <td>
                    <ul class="action_buttons dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action Button
                        <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a class="edit_icon" href="{{url('editor/order/details/'.$value->shippingId.'/'.$value->customerId.'/'.$value->orderIdPrimary)}}"><i class="fa fa-eye"></i> Details View </a></li>
                         @foreach($ordertypes as $orderstatus)
                          <li>
                              <a href="{{url('editor/order/status/'.$value->orderIdPrimary.'/'.$orderstatus->id)}}" class="rbox-{{$orderstatus->id}}" onclick="return confirm('are you want change status?')"> @if($orderstatus->id == $ordertype->id)<i class="fa fa-check"></i> @endif {{$orderstatus->name}}</a>
                          </li>
                          @endforeach
                        </ul>
                    </ul>
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