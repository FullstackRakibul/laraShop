@extends('frontEnd.layouts.master')
@section('title',$category->name)
@section('content')
    <!--common html-->
        <div class="custom-breadcrumb">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                        @include('frontEnd.layouts.includes.sidebar')  
                        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>
                        <li><a herf="{{url('category/'.$category->slug.'/'.$category->id)}}">{{$category->name}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="productarea section-padding">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="product-wrapper">
                      @foreach($products as $value)
                        <div class="hproduct-item">
                          <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">
                          <div class="hproduct-img">
                               <img  data-original="{{asset($value->image?$value->image->image:'')}}"  alt="">
                          </div>

                          </a>
                          <div class="hproduct-info">
                              <p class="hproduct-name">  <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">{{str_limit($value->proName,40)}} </a></p> 
                             <ul>
                               <li> <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                                {{$value->proOldprice}} 
                              @endif</span></p></li>
                             </ul>
                             <button class="order-now addcartbutton" data-id="{{$value->id}}"  data-toggle="modal" data-target="#orderNow">অর্ডার করুন</button>
                             <button class="order-now addcartbutton" data-id="{{$value->id}}" style="background-color:#2d2d2d;" >অ্যাড টু কার্ট</button>
                          </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="custompaginate">
                       {{$products->links()}}
                     </div>
                  </div>
                </div>
            </div>
        </section>
        <!--productarea end-->
         <script>
            $('.mpcatshow').on("click", function(){  
                 jQuery('.mpcatcontent').toggle('show');
            });
        </script>
@endsection