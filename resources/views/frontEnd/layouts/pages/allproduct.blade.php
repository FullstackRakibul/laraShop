@extends('frontEnd.layouts.master')
@section('title','All Product')
@section('content')
   <!--common html-->
        <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                        @include('frontEnd.layouts.includes.sidebar')  
                        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                        <li><a class="anchor"><i class="fa fa-long-arrow-right"></i></a></li>
                       
                         <li><a class="anchor">Per page show ({{$products->count()}}) product  </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
 
      <section class="productarea section-padding">
            <div class="container">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="sidebar">
                      <div class="custom-tree">
                        <div class=" title ">
                          <h6>product category</h6>
                        </div>
                          <ul class="all-category transit">
                                @foreach($categories as $value)
                                <li><a href="{{url('category/'.$value->slug.'/'.$value->id)}}">{{$value->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                  </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                        <div class="shop">
                            <div class="row">
                                @foreach($products as $key=>$value)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                  <div class="hproduct-item">
                                    <a href="{{url('product-details/'.$value->id)}}">
                                    <div class="hproduct-img">
                                        @foreach($productimage as $proimage)
                                         @if($value->id==$proimage->product_id)
                                         <img src="{{asset($proimage->image)}}" alt="">
                                            
                                          @break
                                          @endif
                                          @endforeach

                                          @if($value->proOldprice)
                                          <p class="discount">-{{$value->proOldprice}}%</p>
                                          @endif
                                    </div>

                                    </a>
                                    <div class="hproduct-info">
                                        
                                        <p class="hproduct-name">{{str_limit($value->proName,25)}}</p>
                                        <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                                          @php $offertaka= (($value->proOldprice*$value->proNewprice)/100);
                                           $oldprice = $offertaka+$value->proNewprice; 
                                          @endphp 
                                          
                                          {{$oldprice}} 
                                        @endif</span></p>
                                    </div>
                                    <div class="product-actions">
                                      <div class="wishcompare">
                                            <ul>
                                                <li><a class="comparecartbutton anchor" data-id="{{$value->id}}"><i class="fa fa-exchange"></i></a></li>
                                                <li><a  class="wishcartbutton anchor" data-id="{{$value->id}}"><i class="fa fa-heart-o"></i></a></li>
                                                <li><a href="{{url('product-details/'.$value->id)}}"><i class="fa fa-search"></i></a></li>
                                              </ul>
                                        </div>
                                        <div class="productbtn">
                                          <div class="bwid100">
                                               <div class="bwid50 cartbtn">
                                                   <input type="hidden" value="1" id="quantity"/>
                                                     <button type="button" value="{{$value->id}}" class="addcartbutton" >Add To Cart
                                                     </button>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                                @endforeach
                                <!--col end-->
                            </div>
                            <!--row end-->
                             <div class="row">
                                <div class="col-sm-12">
                                    <div class="custompaginate down">
                                        {{$products->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--show end-->
                    </div>
                    <!--col end-->
                </div>
            </div>
        </section>
        <!--productarea end-->
@endsection