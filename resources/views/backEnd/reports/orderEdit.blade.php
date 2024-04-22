@extends('backEnd.layouts.master')
@section('title', 'Order Manage')
@section('main_content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order information</h3>
                        <div class="short_button">
                        </div>
                    </div>
                    <table class="table table-bordered" style="border: 2px solid #ddd !important">
                        <thead>
                            <tr style="text-align: center;">
                                <td style="background: #eee !important;">Description</td>
                                <td style="background: #eee !important;"> Price</td>
                                <td style="background: #eee !important;"> Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @php
                                $subtotal = 0;
                            @endphp
                            
                            @foreach ($orderDetails as $key => $value)
                                <tr style="border: 2px solid #ddd !important">
                                    <td style="border: 2px solid #ddd !important">{{ $value->productName }} <div
                                            class="smallnote">
                                            <p>
                                                @if (!$value->productSize == '')
                                                    size: {{ $value->productSize }}
                                                @endif
                                                @if (!$value->productColor == '')
                                                    Color: {{ $value->productColor }}
                                                @endif
                                            </p>
                                        </div>
                                    </td style="border: 2px solid #ddd !important">
                                    <td>{{ $value->productPrice }} x {{ $value->productQuantity }} = 
                                        {{ $value->productPrice * $value->productQuantity }} BDT</td>
                                    <td>
                                        <form action="{{ url('editor/order/delete', $value->orderDetails) }}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-outline-danger mx-2"
                                                onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $subtotal += $value->productPrice * $value->productQuantity;
                                    
                                    $order = APP\Order::where('orderIdPrimary', $value->orderId)->first();
                                @endphp
                            @endforeach
                            
                            <tr style="border: 2px solid #ddd !important">
                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>Total</strong>
                                </td>
                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>{{ $subtotal }} BDT</strong>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #ddd !important">
                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>Shipping Fee</strong>
                                </td>
                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong> {{ $shippingInfo->shippingfee }} BDT</strong>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #ddd !important">
                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>Discount</strong>
                                </td>
                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>{{ $order->discount }} BDT</strong>
                                </td>
                            </tr>
                            <tr style="border: 2px solid #ddd !important">
                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>Sub Total</strong>
                                </td>
                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important">
                                    <strong>{{ $order->orderTotal }} BDT</strong>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        
        <!-- /.col -->
        <section class="mb-5">
            <div class="flex-end" style="text-align:center;">
          <h2>Add Products</h2>
           <form action="{{ url('editor/order/add', $order->orderIdPrimary) }}"
            method="post">
            @csrf
            @method('post')
           <div class="form-group">
              <!--<label for="product">Select Product</label>-->
              <select class="form-control" id="product" name="product_id" required>
                <option value="" selected disabled>Select Product</option>  
                @foreach($products as $key=>$value)
                    <option value="{{$value->id}}">{{substr($value->proName,0,50)}} - ({{$value->proNewprice}} BDT)</option>
                @endforeach
              </select>
            </div>
            <button class="btn btn-success" type="submit">Add</button>
          </form>
          </div>
        </section>
        <section>
            <div class="flex-end" style="text-align:center;">
          <h2>Give Discount</h2>
           <form action="{{ url('editor/order/update', $order->orderIdPrimary) }}"
            method="post">
            @csrf
            @method('post')
            <label for="discountCode">Discount Amount:</label>
            <input type="text" id="discountCode" name="discount" required>
            <button class="btn btn-primary" type="submit">Apply</button>
          </form>
          </div>
        </section>
        <div class="row my-5 justify-content-center">
            <div class="col-10" style="border:1px solid black;">
                <h3 class="">Customer information</h3>
                 <form action="{{ url('editor/order/customer-info/'.$shippingInfo->shippingPrimariId) }}" method="POST" id="edit-form">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->orderIdPrimary }}">

                    <div class="row d-flex">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="orderDate">Order Date</label>
                                <input type="text" class="form-control" id="orderDate"
                                    value="{{ $order->created_at->format('F d, Y \a\t h:i A') }}" name="order_crated" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="invoiceID">Tracking ID</label>
                                <input type="text" class="form-control" id="invoiceID" name="invoice_id" value="{{ $order->trackingId }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="customerName">Customer Name</label>
                                <input type="text" class="form-control" id="customerName" name="name" value="{{ $shippingInfo->name }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="customerPhone">Customer Phone</label>
                                <input type="text" class="form-control" id="customerPhone" name="phone" value="{{ $shippingInfo->phone }}" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="customerAddress">Customer Address</label>
                                <input type="text" class="form-control" id="customerAddress" name="address" value="{{ $shippingInfo->address }}" required>
                            </div>
                            @error('address')
                                <p style="color:red;font-size:12px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="my-3 form-group d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="margin-left:50px;">Submit</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
