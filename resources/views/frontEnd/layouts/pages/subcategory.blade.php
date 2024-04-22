@extends('frontEnd.layouts.master')
@section('title',$bredcrumb->subcategoryName)
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
                        <li><a herf="{{url('category/'.$bredcrumb->slug.'/'.$bredcrumb->id)}}">{{$bredcrumb->subcategoryName}} </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
        <section class="productarea section-padding">
            <div class="container">
                <div class="row">
                  <div class="col-lg-3 col-sm-3 pc-sidebar">
                    <div class="sidebar">
                      <div class="custom-tree">
                        <div class=" title ">
                          <h6>Product category</h6>
                        </div>
                          <ul class="mtree transit">
                                @foreach($categories as $key=>$value)
                                @php
                                    $productCount = App\Product::where('proCategory',$value->id)->count();
                                @endphp
                                <li><a href="{{url('category/'.$value->slug)}}">{{$value->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar">
                      <div class="custom-tree">
                        <div class=" title ">
                          <h6>Brand</h6>
                        </div>
                          <ul class="mtree transit">
                                @foreach($brands as $brand)
                                @php
                                    $bproductCount = App\Product::where('proBrand',$brand->id)->count();
                                @endphp
                                <li><a href="{{url('brand/'.$brand->slug)}}">{{$brand->brandName}} <span>({{$bproductCount}})</span></a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar">
                      <div class="custom-tree">
                        <div class=" title ">
                          <h6>Price</h6>
                        </div>
                          <form id="pricefilter">
                            @csrf
                              <input type="text" name="minprice" placeholder="Min" class="width40 minprice">
                              <input type="text" name="maxprice" placeholder="Max" class="width40 maxprice">
                               <button type="submit" class="width20">Send</button>
                          </form>
                        </div>
                    </div>
                  </div>
                    <div class="col-lg-9 col-md-9 col-sm-9">
                          <div class="category-bar">
                            <div class="row">
                              <div class="col-sm-8">
                                <h4> {{$bredcrumb->subcategoryName}}</h4>
                              </div>
                              <div class="col-sm-4">
                                <div class="sort-form">
                                  <form action="">
                                          <select name="sort" class="form-control" onchange="this.form.submit()">
                                              <option value="" @if($sort== '') selected @endif>Sorting</option>
                                              <option value="1" @if($sort==1) selected @endif>Newest</option>
                                              <option value="2" @if($sort==2) selected @endif>Oldest</option>
                                              <option value="3" @if($sort==3) selected @endif>High Price</option>
                                              <option value="4" @if($sort==4) selected @endif>Low Price</option>
                                              <option value="5" @if($sort==5) selected @endif>Z-A</option>
                                              <option value="6" @if($sort==6) selected @endif>A-Z</option>
                                          </select>
                                      </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <div class="shop">
                            <div class="row">
                                @foreach($products as $key=>$value)
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <div class="hproduct-item">
                                        <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">
                                        <div class="hproduct-img">
                                            @foreach($productimage as $proimage)
                                             @if($value->id==$proimage->product_id)
                                             <img  data-original="{{asset($proimage->image)}}"  alt="">
                                                
                                              @break
                                              @endif
                                              @endforeach

                                              @if($value->proOldprice)
                                              <p class="discount">Save 
                                                @php $discount=(((($value->proOldprice)-($value->proNewprice))*100) / ($value->proOldprice)) @endphp -{{number_format($discount,0)}}%</p>
                                              @endif
                                        </div>

                                        </a>
                                        <div class="hproduct-info">
                                            <p class="hproduct-name">  <a href="{{url('product-details/'.$value->id.'/'.$value->slug)}}">{{str_limit($value->proName,40)}} </a></p> 
                                           <ul>
                                             <li> <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                                              {{$value->proOldprice}} 
                                            @endif</span></p></li>
                                             
                                           </ul>
                                        </div>
                                        <div class="product-actions">
                                          @if($value->proQuantity >  1)
                                           <div class="wishcompare">
                                                <ul>

                                                  <li>
                                                    <a data-id="{{$value->id}}"  class="comparecartbutton custtooltip">
                                                      <span class="tooltiptext">Compare</span>
                                                      <i class="fa fa-signal"></i>
                                                    </a>
                                                  </li>
                                                  <li>
                                                    <a data-id="{{$value->id}}"  class="custtooltip wishcartbutton ">
                                                      <span class="tooltiptext">Wishlist</span>
                                                      <i class="fa fa-heart"></i>
                                                    </a>
                                                  </li>

                                                  <li>
                                                    <a data-id="{{$value->id}}" class="addcartbutton custtooltip ">
                                                      <span class="tooltiptext">Add To Cart</span>
                                                      <i class="fa fa-shopping-basket"></i>
                                                    </a>
                                                  </li>
                                                </ul>
                                            </div>
                                             @else
                                             <div class="productbtn">
                                              <div class="bwid100">
                                                   <div class="bwid50 cartbtn">
                                                       <input type="hidden" value="1" id="quantity"/>
                                                         <button class="btn btn-primary" >Stock Out
                                                         </button>
                                                     </div>
                                                </div>
                                            </div>
                                           @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!--col end-->
                            </div>
                            <!--row end-->
                             <div class="row">
                              <div class="col-sm-12">
                                <div class="custom-paginate">
                                  {!!$links!!}
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