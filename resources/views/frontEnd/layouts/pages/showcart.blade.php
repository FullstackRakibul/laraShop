@extends('frontEnd.layouts.master')
@section('title','Show Cart')
@section('content')
<!--common html-->
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                            @include('frontEnd.layouts.includes.sidebar') 
                            <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Shopping <i class="fa fa-angle-right"></i></a></li>
                            <li><a class="anchor">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
                <!--custom breadcrumb end-->
        <section class="productarea section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="show-cart-body">
                            <table class="table table-bordered table-responsive-sm">
                                  <thead>
                                    <tr  class="thead-light">
                                      <th scope="col">Product</th>
                                      <th scope="col">Quantity</th>
                                      <th scope="col">Color</th>
                                      <th scope="col">Size</th>
                                      <th scope="col" class="mcart-item-hide">Price</th>
                                      <th scope="col">Total</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                     @foreach($cartInfos as $cartInfo)
                                    <tr>
                                      <td class="cart-product"><img src="{{asset($cartInfo->options->image)}}"  class="show-cart-image" alt=""> <a class="anchor" class="pcart-name">{{$cartInfo->name}}</a></td>
                                      <td><div class="cart-quantity text-center">
                                            <form action="{{url('/update-cart')}}" method="POST" class="cart-update">
                                                    @csrf
                                                    <input type="hidden" name="rowId" value="{{$cartInfo->rowId}}">
                                                    <input type="text" name="quantity" class="" value="{{$cartInfo->qty}}" min="1">
                                                <button type="submit" class="btn btn-info"><i class="fa fa-refresh"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="mcart-item-hide">{{$cartInfo->options->color}}</td>
                                    <td class="mcart-item-hide">{{$cartInfo->options->size}}</td>
                                    <td class="mcart-item-hide">৳ {{$cartInfo->price}}</td>
                                    <td> ৳ @php $subtotal= $cartInfo->qty*$cartInfo->price @endphp {{$subtotal}} <form action="{{url('/delete-cart')}}" method="POST" class="cart-delete">
                                               @csrf
                                               <input type="hidden" name="rowId" value="{{$cartInfo->rowId}}">
                                              <button type="submit" class="btn btn-danger"><i class="fa  fa-trash"></i></button>
                                            </form></td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot class="cart-footer">
                                      <tr>
                                          <td colspan="6"><strong>Items- {{Cart::instance('shopping')->content()->count()}}</strong>
                                      </tr>
                                      <tr>
                                          @php
                                            $subtotal=Cart::instance('shopping')->subtotal();
                                            $subtotal=str_replace(',','',$subtotal);
                                            $subtotal=str_replace('.00', '',$subtotal);
                                          @endphp
                                          <td colspan="6"><strong>Total- {{$subtotal}}</strong></td></tr>
                                  </tfoot>
                                </table>
                             </div>
                        </div>
                    </div>
                 <!--row end-->
                 <div class="row">
                    <div class="col-sm-12">
                        <div class="cart-bottom">
                            <a href="{{url('/')}}" class="continue-btn">Continue shopping</a>
                            <a href="{{url('customer/checkout')}}">Process checkout</a>
                        </div>
                    </div>
                 </div>
            </div>
        </section>
        <!--productarea end-->
   

@endsection