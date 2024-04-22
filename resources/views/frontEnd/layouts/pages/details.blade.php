@extends('frontEnd.layouts.master')
@section('title','Product Details')
@section('content')
<style>
    @media only screen and (max-width: 767px) {
        .custom-breadcrumb {
            display: none;
        }
        .productdetails-slider{
            height:300px;
        }
        .gallery-thumbs {
            height:25%;
    }
        .details-cart-part button {
          width: 30%;
          margin-left: 200px;
          margin-bottom: 10px;
          position: fixed;
          bottom: 10px;
          z-index: 999;
          
        }
    .details-cart-part .cartbtn{
        margin-left: 85px !important;
        margin-bottom: 10px !important;
        position: fixed;
        bottom: 10px;
         z-index: 999;
        
    }
    .details-call a {
        width:95%;
    }
    .sku {
            display: none;
        }
        .main-search {
            margin-top: 0px;
            margin-bottom: 5px;
        }
        .details-quantity-area .input-group  {
            /*width: 60%;*/
            position: fixed;
            bottom: 4px;
            left: 18px;
            z-index: 999;
        }
        .quantity-label {
        display: none;
    }
    .quantity-left-minus, .quantity-right-plus {
        padding:3px 6px;
    }
    .dbform input {
    border-top: 1px solid #ddd !important;
    height: 33px;
    width: 35px;
    }
    .scrolltop {
        display: none !important;
    }
    
   body::after {
    content: "";
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 70px;
    background-color: white;
    z-index: 5;
  }

</style>

    <!--common html-->
    <div class="custom-breadcrumb">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ul>
                       @include('frontEnd.layouts.includes.sidebar')  
                        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home <i class="fa fa-angle-right"></i></a></li>
                        <li><a class="anchor">Product <i class="fa fa-angle-right"></i></a></li>
                        <li><a class="anchor">Details <i class="fa fa-angle-right"></i></a></li>
                        <li><a class="anchor">{{str_limit($productdetails->proName,100)}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--custom breadcrumb end-->
    <div class="product-details section-padding">
        <div class="container-fluid">
              <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="productdetails-slider">
                        <!-- Swiper -->
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
                                @foreach($productdetails->images as $image)<div class="swiper-slide"> <img src="{{asset($image->image)}}" class="block__pic" alt=""></div>
                                  @endforeach
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @foreach($productdetails->images as $image) 
                                  <div class="swiper-slide"> <img src="{{asset($image->image)}}"  alt=""></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                 </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="productdetails-info">
                          <p class="dproduct-name">{{$productdetails->proName}}</p>
                         
                          <div class="discount-share">
                            <div class="discount">
                              @if($productdetails->proOldprice)
                                <p>Save 
                                @php $discount=(((($productdetails->proOldprice)-($productdetails->proNewprice))*100) / ($productdetails->proOldprice)) @endphp -{{number_format($discount,0)}}%</p>
                               @endif
                               <h6 class="sku"><strong>SKU : </strong> {{$productdetails->proCode}}</h6>
                            </div>
                            <div class="share">
                              <div class="addthis_inline_share_toolbox_x78a"></div>
                            </div>
                          </div>
                          <p style="font-weight:600;">{{$productdetails->unit}}</p>
                            <div class="details-pro-price">
                              <p> Price : <span> Tk {{$productdetails->proNewprice}}</span>
                              <del>Tk {{$productdetails->proOldprice}}</del></p>
                              <p> Status : @if($productdetails->proQuantity > 0)<strong> In Stock</strong> @else <strong>Out Of Stock</strong> @endif</p>
                            </div>
                            <form action="{{url('/add-to-cart/'.$productdetails->id)}}" method="POST" class="dbform" name="formName">
                                   @csrf
                             @if( ! $productdetails->color->isEmpty() )
                              <div class="pro-color">
                                <div class="color_inner">
                                  
                                  <ul style="margin-top:15px;">
                                      <li style="color:black !important; margin-right:10px; padding-top:5px;">Color : </li>
                                        @foreach($productdetails->color as $color)
                                        <li>
                                          <input type="radio" id="fc-option{{$color->id}}" class="emptyalert" value="{{$color->colorName}}" name="proColor" required />
                                          <label for="fc-option{{$color->id}}" class=" selecSize">
                                              
                                          </label>
                                          <div class="check" style="background-color: {{$color->color}};"></div>
                                        </li>
                                        @endforeach
                                  </ul>
                                </div>
                              </div>
                              @endif
                              @if( ! $productdetails->size->isEmpty() )
                              <div class="size-select nt-3">
                                  <p>Select Size: </p>
                                  @foreach($productdetails->size as $size)
                                  <input type="radio" id="size-{{$size->id}}" value="{{$size->sizeName}}" name="proSize" required>
                                  <label for="size-{{$size->id}}">{{ $size->sizeName }}</label>
                                  @endforeach
                              </div>
                              @endif
                            <div class="details-quantity-area">
                              
                              <div class="quantity-part">
                                    <div class="quantity-part-label">
                                      <label for=""><strong class="quantity-label">Quantity </strong><span>*</span></label>
                                    </div>
                                    <div class="quantity-part-input">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        
                                            <button type="button" id="quantity-left" class="quantity-left-minus" data-type="minus" data-field="">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                            @csrf
                                            <input type="text" name="qty"id="quantity" class="input-number" value="1" min="1">
                                        <span class="input-group-btn">
                                            <button type="button" id="quantity-right" class="quantity-right-plus " data-type="plus" data-field="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </span>
                                     </div>
                                  </div>
                              </div>
                              </div>
                               @if($productdetails->proQuantity >  1)
                              <div class="details-cart-part" style="margin-top:10px;">
                                    <button type="submit" class="dbutton cartbtn text-dark" data-id="{{$productdetails->id}}" onclick="return sendSuccess()" style="background-color:yellow;">অ্যাড টু কার্ট</button>
                              </div>
                              </form>
                              <div class="details-cart-part" >
                              <button class="addcartbutton" data-id="{{$productdetails->id}}" data-toggle="modal" data-target="#orderNow">অর্ডার করুন</button>
                              </div>
                              @else
                              <div class="details-cart-part">
                               <a class="ordernow addcartbutton" >Stock Out</a>
                              </div>
                              @endif
                              <div class="details-call">
                                  <a href="tel:01733692222"><i class="fa fa-phone"></i>  সরাসরি কল করুন  01733692222</a>
                              </div>
                              <!--</form>-->
                            </div>
                      </div>
                      <div class="product-description col-12">
                      <h3>Product Description</h3>
                      <div>
                        {!! $productdetails->proDescription !!}
                      </div>
                    </div>
                  </div>
              </div> 
              <!-- row end -->
          </div>
          <!-- container end -->
    </div>
    <!--product-details end-->
    <div class="relatedproduct">                  
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="product-description-title">
                <p>Related Product</p>
            </div>
        </div>
            <div class="col-sm-12">
              <div class="category-slider allproduct-slider common-slider owl-carousel">
               @foreach($relatedproduct as $value)
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
            <div class="col-sm-12">
              <div class="custompaginate">
                {{$relatedproduct->links()}}
              </div>
            </div>
        </div>
      </div>
     </div>
</div>  

<script>
 function sendSuccess() {
    //  console.log('sendSuccess() function called');
    // size validation
    size = document.forms["formName"]["proSize"].value;
    if (size !='') {
      // access
    } else {
      toastr.warning('Please select size');
      return false;
    }

@if (!$productdetails->color->isEmpty())
    color = document.forms["formName"]["proColor"].value;
    if (color !='') {
      // access
    } else {
      toastr.error('Please select color');
      return false;
    }
@endif
  }
   $(document).ready(function() {
    $('#submit-button').on('click', function(e) {
      sendSuccess(); // Call the sendSuccess() function
    });
  });
</script>
@endsection