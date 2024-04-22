  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/superadmin/dashboard')}}" class="brand-link">
      <img src="{{asset('public/backEnd')}}/dist/img/AdminLTELogo.png" alt="Great Deal Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>Great Deal</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="padding: 20px 0" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="image ">
              <img src="{{asset(auth::user()->image)}}" class="img-circle elevation-2" alt="User brand-imagee">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="info">
              <i class="fa fa-circle"></i>
              <a href="#" class="d-block">{{auth::user()->name}}</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-bar-chart"></i>
              <p>
               Order Reports
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{url('/editor/order/all-order')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>All Order</p>
                </a>
              </li>
              @foreach($ordertypes as $ordertype)
              <li class="nav-item">
                <a href="{{url('/editor/order/manage/'.$ordertype->slug)}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>{{$ordertype->name}} @php $products = App\Order::where('orderStatus',$ordertype->id)->count(); @endphp <span>({{$products}})</span>
                  </p>

                </a>
              </li>
              @endforeach
              <li class="nav-item">
                <a href="{{url('/editor/order/cancel/request')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Cancel Request</p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- nav item end -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-pie-chart"></i>
              <p>
               Inventory
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/product/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>All Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/stock')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/stock-warning')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Stok Warning</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product/stock-out')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Stock Out</p>
                </a>
              </li>
              @if(Auth::user()->role_id <= 2)
              <li class="nav-item">
                <a href="{{url('/admin/expence-category/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Expence Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/expence/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Expence</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/reports/summary')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Summary</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <!-- nav item end -->
          @if(Auth::user()->role_id==1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-user"></i>
              <p>
                Users
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/superadmin/user/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Admin </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/customer/list')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Customers</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-shopping-bag"></i>
              <p>
               Our Products
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{url('/editor/product/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/category/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/brand/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product-color/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Color</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/product-size/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Size</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-apple"></i>
              <p>
                Logo
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/logo/add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/logo/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-apple"></i>
              <p>
                Delivery Area
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/delivery/add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/delivery/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-sliders"></i>
              <p>
                Slider
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/slider/add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/slider/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
           <i class="fa fa-file"></i>
              <p>
                Create Page
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/pagecategory/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Page Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/createpage/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Page Content</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
             <i class="fa fa-codiepie"></i>
              <p>
               Social Icon
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/social-media/add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/social-media/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fa fa-image"></i>
              <p>
                Contact Us
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/contactinfo/add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/contactinfo/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="fa fa-image"></i>
              <p>
                Facebook Api
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/editor/facebook/add')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/editor/facebook/manage')}}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Manage</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- nav item end -->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
