@extends('frontEnd.layouts.master')
@section('title','Order Track')
@section('content')
        <section class="section-padding">
           <div class="container">
             <div class="row">
               <div class="col-lg-2 col-md-2 col-sm-2"></div>
               <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="login-content">
                        <h2 class="login-title">Order Tracking</h2>
                        <p>Your search order track Id is : {{$orderfinds->trackingId}} </p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$orderfinds->trackingId}}</td>
                                    @php
                                      $orderstatus = App\Ordertype::find($orderfinds->orderStatus);
                                    @endphp
                                    <td>{{$orderstatus->name}}</td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--login content end-->
                </div>
                <!-- col end -->
             </div>
           </div>
        </section>
@endsection