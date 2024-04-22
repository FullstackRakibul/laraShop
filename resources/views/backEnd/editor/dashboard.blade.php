@extends('backEnd.layouts.master')
@section('title','Dashboard')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header">
          <div class="dashboard-filter">
              <form class="form-row">
                    <div class="col-sm-2">
                        <label>Select Filter</label>
                        <select class="form-control" name="filter">
                            <option value="1" {{ $query== 1 ? 'selected' : '' }}>All</option>
                            <option value="2" {{ $query == 2 ? 'selected' : '' }}>Today</option>
                            <option value="3" {{ $query == 3 ? 'selected' : '' }}>Yesterday</option>
                            <option value="4" {{ $query == 4 ? 'selected' : '' }}>Current Month</option>
                            <option value="5" {{ $query == 5 ? 'selected' : '' }}>Last Month</option>
                            <option value="6" {{ $query == 6 ? 'selected' : '' }}>Current Year</option>
                            <option value="7" {{ $query == 7 ? 'selected' : '' }}>Last Year</option>
                        </select>
                   </div>
                    <div class="col-sm-2">
                        <label>Start (optional)</label>
                        <input class="form-control mydate" name="start" type="date">
                   </div>
                    <div class="col-sm-2">
                        <label>End (optional)</label>
                        <input class="form-control mydate"name="end" type="date">
                   </div>
                    <div class="col-sm-2">
                        <label></label>
                        <input class="btn btn-success" value="Apply" type="submit">
                   </div>
              </form>
          </div>
          <div class="row">
              @foreach($ordertypes as $key=>$value)
                @if($start==NULL)
                <div class="col-sm-3">
                  <div class="report-box rbox-{{$value->id}}">
                      @if($query==1)
                          <a href="{{url('editor/order/manage/'.$value->slug)}}">
                            <h4>{{$value->name}}</h4>
                            @php
                              $ordercount = App\Order::where('orderStatus',$value->id)->count();
                            @endphp
                            <p>{{$ordercount}}</p>
                          </a>
                      @elseif($query==2)
                       <a href="{{url('editor/order/manage/'.$value->slug)}}">
                          <h4>{{$value->name}}</h4>
                          @php
                            $ordercount = App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::today())->count();
                          @endphp
                          <p>{{$ordercount}}</p>
                          </a>
                      @elseif($query==3) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                          <h4>{{$value->name}}</h4>
                          @php
                            $ordercount = App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::yesterday())->count();
                          @endphp
                          <p>{{$ordercount}}</p>
                          </a>
                      @elseif($query==4) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                          <h4>{{$value->name}}</h4>
                          @php
                            $ordercount = App\Order::where('orderStatus',$value->id)->whereMonth('created_at', Carbon\Carbon::now()->month)->count();
                          @endphp
                          <p>{{$ordercount}}</p>
                          </a>
                      @elseif($query==5) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                          <h4>{{$value->name}}</h4>
                          @php
                            $ordercount = App\Order::where('orderStatus',$value->id)->whereDate('created_at',Carbon\Carbon::now()->subMonth())->count();
                          @endphp
                          <p>{{$ordercount}}</p>
                          </a>
                      @elseif($query==6) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                          <h4>{{$value->name}}</h4>
                          @php
                            $ordercount = App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->year)->count();
                          @endphp
                          <p>{{$ordercount}}</p>
                          </a>
                      @else <a href="{{url('editor/order/manage/'.$value->slug)}}">
                          <h4>{{$value->name}}</h4>
                          @php
                            $ordercount = App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->subYear())->count();
                          @endphp
                          <p>{{$ordercount}}</p>
                          </a>
                      @endif
                      
                  </div>
              </div>
                @else
                  <div class="col-sm-3">
                      <div class="report-box rbox-{{$value->id}}">
                          @if($query==1) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                              </a>
                          @elseif($query==2) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::today())->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                              </a>
                          @elseif($query==3) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereDate('created_at', Carbon\Carbon::yesterday())->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                              </a>
                          @elseif($query==4) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereMonth('created_at', Carbon\Carbon::now()->month)->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                              </a>
                          @elseif($query==5) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereDate('created_at',Carbon\Carbon::now()->subMonth())->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                              </a>
                          @elseif($query==6) <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->year)->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                              </a>
                          @else
                           <a href="{{url('editor/order/manage/'.$value->slug)}}">
                              <h4>{{$value->name}}</h4>
                              @php
                                $ordercount = App\Order::where('orderStatus',$value->id)->whereYear('created_at', Carbon\Carbon::now()->subYear())->whereBetween('created_at', [$start, $end])->count();
                              @endphp
                              <p>{{$ordercount}}</p>
                            </a>
                          @endif
                          
                      </div>
                  </div>
                @endif
              @endforeach
          </div>
          <!--row end-->
          <div class="row mrt-30">
            <div class="col-sm-8">
               <div class="card">
                 <div class="card-header">
                   <h3>Order Statistics</h3>
                 </div>
                 <div class="card-body">
                   <canvas id="myChart"></canvas>
                 </div>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="card">
                 <div class="card-header">
                   <h3>Today Reports</h3>
                 </div>
                 <div class="card-body dashboard-today-reports">
                   <div class="info-box">
                      <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-bag"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Today Sell</span>
                        <span class="info-box-number">
                          {{$todaysalesamount}}
                          <small>Tk</small>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- info box end -->
                   <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-cart-plus"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Stock</span>
                        <span class="info-box-number">
                          {{$totalstock}}
                          <small>Pcs</small>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- info box end -->
                   <div class="info-box">
                      <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-list"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Today Expence</span>
                        <span class="info-box-number">
                          {{$todayexpence}}
                          <small>Tk</small>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- info box end -->
                 </div>
               </div>
            </div>
          </div>
      </div>
    </div>
  </div>
 </section>
 <script>
   var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: [@foreach($ordertypes as $ordertype)'{{$ordertype->name}}',@endforeach],
        datasets: [{
            label: 'Order Statistics',
            backgroundColor:['#1D2941','#55A25A','#431753','#8E2FC4','#345491','#488E74','#2094A0','#BB2757','#663E3E'],
            borderColor:['#1D2941','#55A25A','#431753','#8E2FC4','#345491','#488E74','#2094A0','#BB2757','#663E3E'],
             data: [@foreach($ordertypes as $ordertype)
             @php
             $parcelcount = App\Order::where('orderStatus',$ordertype->id)->count();
             @endphp {{$parcelcount}}, @endforeach]
        }]
    },

    // Configuration options go here
    options: {}
});
 </script>
@endsection