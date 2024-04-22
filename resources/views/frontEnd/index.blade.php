@extends('frontEnd.layouts.master')
@section('title','Great Deal trends of ecommerce marketplace')
@section('content')
    <section class="menuandslider">
      <div id="slider" class="main-slider owl-carousel ">
        @foreach($mainslider as $key=>$value)
        <div class="slider-item">
            <div class="slider-image">
              <a href="{{url($value->burl)}}">
                <img src="{{asset($value->image)}}" alt="slider image">
                </a>
            </div>
        </div>
        @endforeach
      </div>
    </section>
    <!--main slider section end-->
	<!--main slider section end-->
<!--  <section class="section-padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="mobile-category">
            <h2>browse products category</h2>
            <ul>
              @foreach($categories as $key=>$mcategory)
              <li><a href="{{url('category/'.$mcategory->slug)}}">{{$mcategory->name}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
    <section class="dpadding-bottom section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-6">
            <div class="section-title">
             <h2>হট ডিল !!</h2>
            </div>
          </div>
          <div class="col-sm-6 col-6">
             <div class="pview-all">
              <a href="{{url('hot-deal')}}">view all</a>
             </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="category-area">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="category-slider allproduct-slider common-slider owl-carousel">
                   @foreach($bestproducts as $value)
                    <div class="hproduct-item">
                      <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">
                      <div class="hproduct-img">
                           <img  data-original="{{asset($value->image?$value->image->image:'')}}"  alt="">
                      </div>
                            <div class="percent">
                               @if($value->proOldprice)
                                <p> 
                                @php $discount=(((($value->proOldprice)-($value->proNewprice))*100) / ($value->proOldprice)) @endphp -{{number_format($discount,0)}}%</p>
                               @endif
                            </div>
                      </a>
                      <div class="hproduct-info">
                          <p class="hproduct-name">  <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">{{str_limit($value->proName,30)}} </a></p> 
                         <ul>
                           <li> <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                            {{$value->proOldprice}} 
                          @endif</span></p></li>
                         </ul>
                          @if (!$value->color->isEmpty() || !$value->size->isEmpty())
                            <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}" class="order-now addcartbutton text-center">অর্ডার করুন</a>
                            <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}" class="order-now addcartbutton text-center" style="background-color:#2d2d2d;">অ্যাড টু কার্ট</a>
                         
                         @else
                            <button class="order-now addcartbutton" data-id="{{$value->id}}"  data-toggle="modal" data-target="#orderNow">অর্ডার করুন</button>
                            <button class="order-now addcartbutton" data-id="{{$value->id}}" style="background-color:#2d2d2d;">অ্যাড টু কার্ট</button>
                         @endif
                      </div>
                  </div>
                  @endforeach
                  </div>   
               </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>
@foreach($frontcategories as $category)
  @php
      $products = App\Product::where(['proCategory'=>$category->id,'status'=>1])->orderBy('id','DESC')->select('id','slug','proName','proOldprice','proNewprice','proQuantity')->limit(10)->get();
  @endphp
@if($products->count() > 0)
<section class="dpadding-bottom section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-6">
            <div class="section-title">
             <h2>{{$category->name}}</h2>
            </div>
          </div>
          <div class="col-sm-6 col-6">
             <div class="pview-all">
              <a href="{{url('category/'.$category->slug)}}">view all</a>
             </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="category-area">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="category-slider allproduct-slider common-slider owl-carousel">
                   @foreach($bestproducts as $value)
                    <div class="hproduct-item">
                      <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">
                      <div class="hproduct-img">
                           <img  data-original="{{asset($value->image?$value->image->image:'')}}"  alt="">
                      </div>
                            <div class="percent">
                               @if($value->proOldprice)
                                <p> 
                                @php $discount=(((($value->proOldprice)-($value->proNewprice))*100) / ($value->proOldprice)) @endphp -{{number_format($discount,0)}}%</p>
                               @endif
                            </div>
                      </a>
                      <div class="hproduct-info">
                          <p class="hproduct-name">  <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">{{str_limit($value->proName,30)}} </a></p> 
                         <ul>
                           <li> <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                            {{$value->proOldprice}} 
                          @endif</span></p></li>
                         </ul>
                          @if (!$value->color->isEmpty() || !$value->size->isEmpty())
                            <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}" class="order-now addcartbutton text-center">অর্ডার করুন</a>
                            <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}" class="order-now addcartbutton text-center" style="background-color:#2d2d2d;">অ্যাড টু কার্ট</a>
                         
                         @else
                            <button class="order-now addcartbutton" data-id="{{$value->id}}"  data-toggle="modal" data-target="#orderNow">অর্ডার করুন</button>
                            <button class="order-now addcartbutton" data-id="{{$value->id}}" style="background-color:#2d2d2d;">অ্যাড টু কার্ট</button>
                         @endif
                      </div>
                  </div>
                  @endforeach
                  </div>   
               </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>

@endif
@endforeach
<!-- All Product end -->
<!-- Latest Product  -->
<section class="dpadding-bottom section-padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-6">
            <div class="section-title">
             <h2>লেটেস্ট প্রোডাক্ট</h2>
            </div>
          </div>
          <div class="col-sm-6 col-6">
             <div class="pview-all">
              <a href="{{url('hot-deal')}}">view all</a>
             </div>
          </div>
        </div>
        <div class="row d-flex">
                   @foreach($latestproducts as $value)
                   <div class="col-lg-2 col-md-2 custom-col-6">
                    <div class="hproduct-item">
                      <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">
                      <div class="hproduct-img">
                           <img  data-original="{{asset($value->image?$value->image->image:'')}}"  alt="">
                      </div>
                            <div class="percent">
                               @if($value->proOldprice)
                                <p> 
                                @php $discount=(((($value->proOldprice)-($value->proNewprice))*100) / ($value->proOldprice)) @endphp -{{number_format($discount,0)}}%</p>
                               @endif
                            </div>
                      </a>
                      <div class="hproduct-info">
                          <p class="hproduct-name">  <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">{{str_limit($value->proName,25)}} </a></p> 
                         <ul>
                           <li> <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                            {{$value->proOldprice}} 
                          @endif</span></p></li>
                         </ul>
                         @if (!$value->color->isEmpty() || !$value->size->isEmpty())
                            <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}" class="order-now addcartbutton text-center">অর্ডার করুন</a>
                            <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}" class="order-now addcartbutton text-center" style="background-color:#2d2d2d;">অ্যাড টু কার্ট</a>
                         
                         @else
                            <button class="order-now addcartbutton" data-id="{{$value->id}}"  data-toggle="modal" data-target="#orderNow">অর্ডার করুন</button>
                            <button class="order-now addcartbutton" data-id="{{$value->id}}" style="background-color:#2d2d2d;">অ্যাড টু কার্ট</button>
                         @endif
                      </div>
                  </div>
                  </div>
                  @endforeach
                
        </div>
      </div>
    </section>
<!-- All Product end -->
@endsection