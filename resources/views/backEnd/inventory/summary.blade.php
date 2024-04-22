@extends('backEnd.layouts.master')
@section('title','Dashboard')
@section('main_content')
<section class="content">
  <div class="container-fluid">
    <div class="dashboard-filter">
        <form class="form-row">
              <div class="col-sm-4">
                  <label>Start Date</label>
                  <input class="form-control mydate" name="start" type="date">
             </div>
              <div class="col-sm-4">
                  <label>End Date</label>
                  <input class="form-control mydate"name="end" type="date">
             </div>
              <div class="col-sm-2">
                  <label></label>
                  <input class="btn btn-success" value="Apply" type="submit">
             </div>
        </form>
    </div>

    <div class="card card-default">
      <div class="card-header">
        <h4>Stock Reports</h4>
      </div>
      <div class="card-body summary">
          <div class="row">
            <div class="col-sm-3">
              <div class="small-box bg-warning">
                  <div class="inner">
                    <h3>{{$totalproduct}}</h3>
                    <p>Total Product</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check-circle"></i>
                  </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-3">
              <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{$totalstock}}</h3>
                    <p>Total Product (Pcs)</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-stack-exchange"></i>
                  </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-3">
              <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>{{$stockpurchase}}</h3>
                    <p>Total Stock Purchase (Tk)</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-bar-chart"></i>
                  </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-3">
              <div class="small-box bg-info">
                  <div class="inner">
                    <h3>{{$stocksales}}</h3>
                    <p>Total Stock Sales (Tk)</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-diamond"></i>
                  </div>
                </div>
            </div>
            <!-- col end -->
          </div>
      </div>
    </div>
    <div class="card card-default">
      <div class="card-header">
        <h4>Monthly Transection</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="info-box bg-primary">
              <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Sales</span>
                <span class="info-box-number">{{$salesamount}} Tk</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total sales summery
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          <!-- col end -->
          <div class="col-sm-4">
            <div class="info-box bg-danger">
              <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Expense</span>
                <span class="info-box-number">{{$totalexpence}} Tk</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total expense summery
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          <!-- col end -->
          <div class="col-sm-4">
            <div class="info-box bg-success">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Revinue</span>
                <span class="info-box-number">{{$salesamount - ($totaldiscount+$purchaseamount+$totalexpence)}} Tk</span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                <span class="progress-description">
                  Total revenue summery
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
          <!-- col end -->
        </div>
      </div>
    </div>
  </div>
 </section>
@endsection