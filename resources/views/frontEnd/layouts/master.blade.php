<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Great Deal - @yield('title','Great Deal trends of ecommerce marketplace')</title>
    <!--website title-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0, minimum-scale=1.0">
    @foreach($mainlogo as $key=>$value)
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/frontEnd/images/')}}/faveicon.png">
    <link rel="icon" rel="apple-touch-icon" sizes="120x120" href="{{asset('public/frontEnd/images/')}}/faveicon.png"/>
    @endforeach
    <!--faveicon image-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/bootstrap.min.css">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/animate.css">
    <!--animate css>-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/font-awesome.min.css">
    <!--font awesome css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/line-awesome.min.css">
    <!--line-awesome.min-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/icofont.min.css">
    <!--feathericon css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/owl.carousel.min.css">
    <!--owl.carousel.min.css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/owl.theme.default.min.css">
    <!--owl.theme.default.min-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/swiper.min.css">
    <!-- swiper slider -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/mobile-menu.css">
    <!--mobilemenu css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/jquery.mtree.css">
    <!-- nice select -->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/nice-select.css">
      <!-- toastr css -->
    <link rel="stylesheet" href="{{asset('public/backEnd')}}/css/toastr.min.css">
    <!--mtree css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/mtree.css">
    <!--news.css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/zoom.css">
    <!--zoom.css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/style.css">
    <!--style css-->
    <link rel="stylesheet" href="{{asset('public/frontEnd/')}}/css/responsive.css">
    <!--responsive css-->
    <script src="{{asset('public/frontEnd/')}}/js/jquery-3.3.1.min.js"></script>
    <!--jquery library-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
     <!-- ajax library -->
<script>
    $(function(){

    $('.navigation .toggle-wrapper .show').on('click',function(){
      $('.navigation').addClass('open');
    });
    $('.navigation .toggle-wrapper .hide').on('click',function(){
      $('.navigation').removeClass('open');
    });
    $('.navigation .has-menu a').on('click',function(e){
      e.stopPropagation();
    });
    $('.navigation .has-menu').on('click',function(){
      $(this).toggleClass('open');
    });
  
    });
   </script>


<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '317665830635484');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=317665830635484&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<!-- Domain Verify Code -->
<meta name="facebook-domain-verification" content="7743dw5jz4ykskn7z32s9nfthnjp9l" />

</head>

<body class="gotop">
    @php
        $customerInfo = App\Customer::find(Session::get('customerId'));
    @endphp

     <div class="mobile-header-top">
        <div class="container">
             <div class="row">
                <div class="col-2">
                    <div class="mobile-hot-line">
                    <span class="toggle hc-nav-trigger hc-nav-1"><i class="fa fa-bars"></i></span>
                    </div>
                </div>
                <div class="col-10">
                    <div class="mobile-header-right">
                         <ul>
                            <li>
                                <a href="#" class="trackorder" data-toggle="modal" data-target="#myModal"><i class="fa fa-truck"></i> Track Order</a>
                            </li> 
                        @if(Session::get('customerId'))

                           <li>
                                <a href="{{url('customer/account')}}">
                               {{$customerInfo->fullName}}
                            </a>
                           </li>
                            @else
                           <li>
                               <a href="{{url('/customer/register')}}"><i class="fa fa-address-book-o"></i> Register</a>
                           </li>
                           <li>
                               <a href="{{url('customer/login')}}"><i class="fa fa-sign-in"></i> Login</a>
                           </li>
                           @endif
                         </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- Mobile header top End -->
   <section class="mobile-header-design hidden-lg hidden-md">
            <div id="mobile-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div id="main-nav" class="mobile-menu">
                                <ul class="first-nav">
                                  <li><a href="{{url('offer')}}">Offers</a>
                                  </li>
                                @foreach($categories as $category)
                                <li class="parent"><a href="{{url('category/'.$category->slug)}}">{{$category->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                             <ul class="mobile-emenu">
                                <li> <a href="{{url('/offer')}}">Offer Product</a></li>
                            </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- mobile header end -->
        <section class="mlogo-cart">
            <div class="container">
                 <div class="row">
                    <div class="col-6">
                        @forelse($mainlogo as $key=>$value)
                        <div class="mlogo logo">
                            <a href="{{url('/')}}"><img src="{{asset($value->image)}}" alt=""></a>
                        </div>
                        @empty
                        <p>No Data Available Here..</p>
                        @endforelse
                    </div>
                    <!--col end-->
                    <div class="col-6">
                       <div class="cartArea">
                       <ul>
                           <li class="cartTable"><a href="{{url('show-cart')}}"><i class="fa fa-shopping-cart"></i> <span>{{Cart::instance('shopping')->count()}}</span></a></li>
                       </ul>
                   </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                       <div class="main-search">
                            <form action="#">
                                <input type="text" class="search_data" placeholder="search here...">
                                <button><i class="fa fa-search"></i></button>
                            </form>
                       </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Header Top End -->
<nav class="sticky-top">
    <div class="main-header">
        <div class="container-fluid  ">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-6 align-middle">
                    @forelse($mainlogo as $key=>$value)
                    <div class="logo align-middle">
                        <a href="{{url('/')}}"><img src="{{asset($value->image)}}" alt=""></a>
                    </div>
                    @empty
                    <p>No Data Available Here..</p>
                    @endforelse
                </div>
                <!--col end-->
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <div class="main-search search-form">
                        <form action="#">
                            <input type="text" class="search_data" placeholder="search here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                        <div class="search-product-inner" id="live_data_show"></div> 
                   </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-5" style="margin-right:-15px; padding-right:0px; padding-left:0px;">
                   <div class="hot-line">
                       <a href="tel:01733692222"> <i class="fa fa-phone"></i> 01733692222</a>
                   </div>
                   </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-5" style="padding-right:0px; padding-left:0px;">
                    @if(Session::get('customerId'))
                    <div class="auth-login">
                        <a class="anchor"><i class="fa fa-user"></i>  {{$customerInfo->fullName}} <i class="fa fa-angle-down"></i></a>
                        <div class="popup-login">
                            <ul>
                                <li><a href="{{url('customer/order')}}">My Order</a></li>
                                <li><a href="{{url('customer/account')}}">My Profile</a></li>
                                <li><a href="{{url('customer/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    @else
                    <div class="auth-login">
                        <a class="anchor"><i class="fa fa-user"></i> Login / Signup <i class="fa fa-angle-down"></i></a>
                        <div class="popup-login">
                            <form action="{{url('customer/login')}}">
                                @csrf
                                <h4>Login to my account</h4>
                                <div class="form-group">
                                    <label for="phoneNumber"> Mobile Number</label>
                                    <input type="text" name="phoneNumber" placeholder="0174289..." class="form-control  {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"  value="{{ old('phoneNumber') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password"> Password</label>
                                    <input type="password" name="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="******" value="{{old('password')}}" required>
                                </div>
                                <div class="form-group">
                                    <button>Login</button>
                                </div>
                                <p>New Customer <a href="{{url('customer/register')}}">Create your account</a></p>
                                <p>Forgot Password <a href="{{url('customer/forget-password')}}">Recover password</a></p>
                            </form>
                        </div>
                    </div>
                    @endif
                   <div class="cartArea">
                       <ul>
                           <li class="cartTable"><a href="{{url('show-cart')}}"><i class="fa fa-shopping-cart"></i> <span>{{Cart::instance('shopping')->count()}}</span></a></li>
                       </ul>
                   </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <!--main header end-->
    <section class="main-menu-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <div class="main-menu">
                        <ul>
                            @foreach($categories as $key=>$value)
                            <li> <a href="{{url('/category/'.$value->slug)}}">{{$value->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-8 col-sm-2">
                    <div class="other-menu">
                        <ul>
                            <li><a href="{{url('/offer')}}">All Offer</a></li>
                            <li><a href="{{url('/track/order')}}" class="track-btn">Track Order</a></li>
                        </ul>
                    </div>
                </div>
                <!--Track order dropdown-->
                <!--<div class="col-lg-2 col-md-8 col-sm-2">-->
                <!--  <div class="other-menu">-->
                <!--    <ul>-->
                <!--        <li><a href="{{url('/offer')}}">All Offer</a></li>-->
                <!--      <li class="apply-btn"><a href="#">Track Order</a>-->
                <!--        <div class="dropdown-content-track">-->
                <!--          <form>-->
                <!--            <label for="name">Name:</label>-->
                <!--            <input type="text" id="name" name="name" required>-->
                <!--            <label for="email">Email:</label>-->
                <!--            <input type="email" id="email" name="email" required>-->
                <!--            <button class="btn btn-primary" type="submit">Submit</button>-->
                <!--          </form>-->
                <!--        </div>-->
                <!--      </li>-->
                      
                      <!--<li><a href="{{url('/track/order')}}" class="track-btn">Track Order</a></li>-->
                <!--    </ul>-->
                <!--  </div>-->
                <!--</div>-->
                <!--Track order dropdown-->
            </div>
        </div>
    </section>
</nav>
    <!--main header end-->
    <div id="content">
        @yield('content')
    </div>
    <!-- content end -->
<footer>
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <!-- footer-widget start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="footer-widget">
                            <h3>যোগাযোগ করুন</h3>
                            @foreach($contactinfoes as $key=>$value)
                              <ul class="footer-contact">
                                    <li>
                                        <i class="fa fa-map-marker"></i>
                                         <p>{{$value->address}}</p>
                                    </li>
                                    
                                    <li>
                                         <i class="fa fa-envelope"></i>
                                         <a href="mailto:{{$value->email}}">{{$value->email}}</a>
                                    </li>
                                    <li>
                                         <i class="fa fa-phone"></i>
                                         <a href="tel:{{$value->phone}}">{{$value->phone}}</a>
                                    </li>
                                </ul>
                                @endforeach
                        </div>
                    </div>
                    <!-- footer-widget start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="footer-widget">
                            <h3>তথ্য</h3>
                            <ul class="footer-contact">
                                @foreach($footermenuleft as $value)
                                <li><a href="{{url('more-info/'.$value->slug)}}">{{$value->pagename}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- footer-widget start -->
                    <div class="col-lg-3 col-md-3  col-sm-6 col-12">
                        <div class="footer-widget">
                            <h3>অধিক তথ্য
</h3>
                            <ul class="footer-contact">
                                @foreach($footermenuright as $value)
                                <li><a href="{{url('more-info/'.$value->slug)}}">{{$value->pagename}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- footer-widget start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <div class="footer-widget">
                            <div class="widget">
                                <h3>আমাদের সাথে যোগাযোগ করুন</h3>
                                <p>যা আমরা গ্রহণ করি</p>
                                <div class="payment-accept">
                                    <img src="{{asset('public/frontEnd')}}/images/payment.webp" alt="">
                                </div>
                                <div class="social">
                                    @foreach($socialicons as $value)
                                    <a href="{{$value->link}}" target="_blank" class="facebook"><i class="{{$value->icon}}"></i></a>
                                   @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- footer-widget end -->
                </div>
            </div>
        </div>
    </footer>
    <!--footer end-->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p style="color:#fff">
                            কপিরাইট ©  @php  echo date('Y') @endphp Great Deal. সমস্ত অধিকার সংরক্ষিত. নির্মাণে <a href="https://quicktechit-ltd.com/" target="_blank">Quicktech IT</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<section class="ordernow-form">
   <div class="modal fade" id="orderNow" tabindex="-1" role="dialog" aria-labelledby="orderNowModalLabel" aria-hidden="true" style="top:35px !important;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderNowModalLabel">অর্ডার করুন </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('customer/order-save')}}" method="POST">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"> নাম<span>*</span></label>
            <input type="text" placeholder="আপনার সম্পূর্ণ নাম লিখুন" class="form-control" value="{{old('fullName')}}" name="fullName" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">মোবাইল নম্বর <span>*</span></label>
            <input type="number" placeholder="আপনার মোবাইল নাম্বার লিখুন " class="form-control" name="phoneNumber" value="{{old('phoneNumber')}}" required minlength="11" maxlength="11">
          </div>
          <!--<div class="form-group">-->
          <!--  <label for="emailAddress" class="col-form-label">ইমেইল ঠিকানা <span>*</span></label>-->
          <!--  <input type="text" placeholder="আপনার ইমেইল  লিখুন" class="form-control" name="emailAddress" value="{{old('emailAddress')}}" required>-->
          <!--</div>-->
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">ঠিকানা <span>*</span> </label>
            <input type="text" placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" class="form-control" name="address" value="{{old('address')}}" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">নির্বাচন করুন <span>*</span></label>
            <select type="text"  class="form-control" name="area" value="{{old('area')}}" required>
                <option value=""selected disabled>নির্বাচন করুন  </option>
                @foreach($deliveries as $delivery)
                    <option value="60">{{ $delivery->area }} ({{ $delivery->shipping_charge }} টাকা)</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">অর্ডার করুন </button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>    
</section>
 <div class="scrolltop" style="display: block;">
    <div class="scroll icon"><i class="fa fa-angle-up"></i></div>
</div>
<!-- main add to cart ajax end -->
<script src="{{asset('public/frontEnd/')}}/js/bootstrap.min.js"></script>
<!--bootstrap js-->
<script src="{{asset('public/frontEnd/')}}/js/owl.carousel.min.js"></script>
<!--owl carousel js-->
<script src="{{asset('public/frontEnd/')}}/js/swiper.min.js"></script>
<!--swiper js-->
<script src="{{asset('public/frontEnd/')}}/js/jquery.sticky.js"></script>
<!-- sticky js -->
<script src="{{asset('public/frontEnd/')}}/js/jquery.nice-select.js"></script>
<!-- nice-select js -->
<script src="{{asset('public/frontEnd/')}}/js/jquery.scrollUp.js"></script>
<!--scrollUp js-->
<script src="{{asset('public/frontEnd/')}}/js/mobile-menu.js"></script>
<!--mobile menu js-->
<script src="{{asset('public/frontEnd/')}}/js/zoomsl.min.js"></script>
<!--jqzoom.js js-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
<script type="text/javascript">
    	$("img").lazyload({
    	    effect : "fadeIn"
    	});
    </script>
    <script>
    $(document).ready(function () {
        $(".block__pic").imagezoomsl({
            zoomrange: [3, 3]
        });
    });
</script>
<script>
    $(document).ready(function() {
      $('.sort-form select').niceSelect();
    });
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/velocity/0.2.1/jquery.velocity.min.js'></script>
<script src="{{asset('public/frontEnd/')}}/js/mtree.js"></script>
    <!--scrollUp js-->
<script src="{{asset('public/backEnd')}}/js/toastr.min.js"></script>
<!-- toastr js -->
{!! Toastr::message() !!}
<!--parallax js-->
<script src="{{asset('public/frontEnd/')}}/js/script.js"></script>

<script>
      $('#area').on('change',function(){
        var id = $(this).val();
        if(id){
            $.ajax({
               cache: 'false',
               type:"GET",
               url:"{{url('shipping-charge')}}/"+id,
               dataType: "json",
                success: function(shippingfee){
                return shippingContent();
                }
            });
        }
       });
       
       function shippingContent(){
         $.ajax({
           type:"GET",
           cache: 'false',
           url:"{{url('/shipping/content')}}",
           dataType: "html",
           success: function(shippingfee){
             $('.shippingContent').html(shippingfee);
           }
            });
        };
        
  </script>


<script type="text/javascript">
    $("#hidemenu" ).hide();
    $('#hovercategory').click(function() {
      $('#hidemenu').slideToggle('slow', function() {
      });
    });
</script>
<script>
     $(document).ready(function(){
        var quantitiy=0;
        $('#quantity-right').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        // If is not undefined
            $('#quantity').val(quantity + 1);
            // Increment
        });
        $('#quantity-left').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined
            // Increment
            if(quantity>1){
            $('#quantity').val(quantity - 1);
            }
        });

    });
</script>
<script type="text/javascript">
    $(".search_data").on('keyup', function(){
       var keyword = $(this).val();
       $.ajax({
        type: "GET",
        url: "{{url('/')}}/search_data/" +keyword,
        data: { keyword: keyword },
        success: function (data) {
          console.log(data);
          $("#live_data_show").html('');
          $("#live_data_show").html(data);
        }
       });
    });
</script>
<script type="text/javascript">
    $(".mycatclose").on('click', function(){
      $('.navigation').removeClass('open');
    });
</script>
<script type="text/javascript">
    $(".mycatopen").on('click', function(){
      $('.navigation').addClass('open');
    });
</script>
<script>
   $(".MenuOpen").on('click', function(){
      $('.hc-offcanvas-nav').addClass('nav-open').css('visibility','visible');
    });
  
</script>
<script>
   $(".subcatsort").change(function(e){
    var sort = $(this).val();
      $.ajax({
           cache: false, 
           type:"GET",
           url:"",
           dataType: "html",
           data : "sort="+sort,
         success: function(products){
             console.log(products);
            $('.updateDiv').html(products);
        }
      });
});
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script type="text/javascript">
        $('#proSubcategory').on('change',function(){
        var ajaxId = $(this).val();  
        if(ajaxId){
            $.ajax({
               type:"GET",
               url:"{{url('ajax-product-childsubcategory')}}?category_id="+ajaxId,
               success:function(res){               
                if(res){
                    $("#proChildcategory").empty();
                     $("#proChildcategory").append('<option value="0">===select childcategory===</option>');
                    $.each(res,function(key,value){
                        $("#proChildcategory").append('<option value="'+key+'">'+value+'</option>');
                    });
               
                }else{
                   $("#proChildcategory").empty();
                }
               }
            });
        }else{
            $("#proChildcategory").empty();
        }
            
       });
    </script>
     <script>
        var galleryThumbs = new Swiper('.gallery-thumbs', {
          spaceBetween: 10,
          slidesPerView: 5,
          freeMode: true,
          watchSlidesVisibility: true,
          watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.gallery-top', {
          spaceBetween: 10,
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          thumbs: {
            swiper: galleryThumbs
          }
        });
      </script>
        <script type="text/javascript">
            $("#bzoom").zoom({
                zoom_area_width: 3000,
                autoplay_interval :3000,
                small_thumbs : 0,
                autoplay : false
            });
        </script>
        <!-- main add to cart ajax end -->

      <script>
          
            function myFunction() {
              document.getElementById("myDropdown").classList.toggle("show");
            }

            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
              if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                  var openDropdown = dropdowns[i];
                  if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                  }
                }
              }
            } 
      </script>
     <script type="text/javascript">
        $('#district').on('change',function(){
        var ajaxId = $(this).val();  
        if(ajaxId){
            $.ajax({
               type:"GET",
               url:"{{url('ajax-district')}}?district_id="+ajaxId,
               success:function(res){               
                if(res){
                    $("#area").empty();
                     $("#area").append('<option value="0">Select...</option>');
                    $.each(res,function(key,value){
                        $("#area").append('<option value="'+key+'" class="area">'+value+'</option>');
                    });
               
                }else{
                   $("#area").empty();
                }
               }
            });
        }else{
            $("#area").empty();
        }
            
       });
    </script> 
        <script>
            $('.mpcatshow').on("click", function(){  
                 jQuery('.mpcatcontent').toggle('show');
            });
        </script>
        <script>
            $(document).ready(function(){
                // Add minus icon for collapse element which is open by default
                $(".collapse.show").each(function(){
                	$(this).prev(".card-header").find(".fa").addClass("fa-caret-down").removeClass("fa-caret-up");
                });
                
                // Toggle plus minus icon on show hide of collapse element
                $(".collapse").on('show.bs.collapse', function(){
                	$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
                }).on('hide.bs.collapse', function(){
                	$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
                });
            });
        </script>

<!--End of Tawk.to Script-->
    <script type="text/javascript">
    $(document).ready(function(){

    // ============checkout ajax==============
    $('.addcartbutton').on('click',function(){
        var id = $(this).data('id');
        var qty = 1;
        if(id){
            $.ajax({
               cache: 'false',
               type:"GET",
               url:"{{url('add-to-cart')}}/"+id+'/'+qty,
               dataType: "json",
            success: function(cartinfo){
                return cartContent()+mobileContent();
                }
            });
        }
       });
    // get type
      // cart qty increment to cart start
    $(".incrementqty").click(function(e){
        var id = $(this).val();
        // alert(id);
        if(id){
              $.ajax({
               cache: false,
               type:"GET",
               url:"{{url('increment-cart')}}/"+id,
               dataType: "json",
            success: function(cartinfo){
                return cartContent()+mobileContent();
            }
          });
        }
   });
    // cart qty increment to cart end

    // cart qty increment to cart start
    $(".decrementqty").click(function(e){
        var id = $(this).val();
        // alert(id);
        // alert(newQuantity);
        if(id){
              $.ajax({
               cache: false, 
               type:"GET",
               url:"{{url('decrement-cart')}}/"+id,
               dataType: "json",
            success: function(cartinfo){
                return cartContent()+mobileContent();
            }
          });
        }
   });
    // cart qty increment to cart end
    $('.remove').click(function(){
        var id = $(this).data("id");
        // alert(id);
        if(id){
            $.ajax({
               cache: 'false',
               type:"GET",
               url:"{{url('delete-cart')}}/"+id,
               dataType: "json",
            success: function(cartinfo){
                return cartContent()+mobileContent();
                }
            });
        }
       
       });
         function cartContent(){
           $.ajax({
             type:"GET",
             cache: 'false',
             url:"{{url('/cart/content')}}",
             dataType: "html",
             success: function(cartinfo){
                toastr.success('Thanks', 'Product add to cart');
               $('.cartTable').html(cartinfo);
             }
              });
          };
          function mobileContent(){
           $.ajax({
             cache: 'false',
             type:"GET",
             url:"{{url('/cart/mobile-content')}}",
             dataType: "html",
             success: function(cartinfo){
               $('.mobileTable').html(cartinfo);
             }
              });
          };
          $('.wishcartbutton').click(function(){
        var id = $(this).data('id');
        if(id){
            $.ajax({
               cache: 'false',
               type:"GET",
               url:"{{url('add-to-wishlist')}}/"+id,
               dataType: "json",
                success: function(wishlistinfo){
                return wishContent();
                }
            });
        }
       
       });
     function wishContent(){
     $.ajax({
       type:"GET",
       url:"{{url('wishlist/content')}}",
       dataType: "html",
       success: function(wishlistinfo){
         toastr.success('Product add in wishlist', '');
         $('.wishTable').html(wishlistinfo);
       }
        });
    }
    // get type
    $('.comparecartbutton').click(function(){
        var id = $(this).data('id');
        if(id){
            $.ajax({
               cache: 'false',
               type:"GET",
               url:"{{url('add-to-compare')}}/"+id,
               dataType: "json",
            success: function(compareinfo){
                return compareContent();
                }
            });
        }
       
       });
     function compareContent(){
     $.ajax({
       type:"GET",
       url:"{{url('compare/content')}}",
       dataType: "html",
       success: function(compareinfo){
         toastr.success('Product add in compare', '');
         $('.compareTable').html(compareinfo);
       }
        });
    }
    // get type
  });
</script>
<script>
        $('.mpcatshow').on("click", function(){  
             jQuery('.mpcatcontent').toggle('show');
        });
        </script>
        <script>
            $(document).ready(function(){
                // Add minus icon for collapse element which is open by default
                $(".collapse.show").each(function(){
                	$(this).prev(".card-header").find(".fa").addClass("fa-caret-down").removeClass("fa-caret-up");
                });
                
                // Toggle plus minus icon on show hide of collapse element
                $(".collapse").on('show.bs.collapse', function(){
                	$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
                }).on('hide.bs.collapse', function(){
                	$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
                });
            });
        </script>
       <!--Start of Tawk.to Script-->
       <script>
   $(".MenuOpen").on('click', function(){
      $('.hc-offcanvas-nav').addClass('nav-open').css('visibility','visible');
    });
  
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5edb90ac2b31b3f0"></script>


<script>
$(window).scroll(function() {
    if ($(this).scrollTop() > 50 ) {
        $('.scrolltop:hidden').stop(true, true).fadeIn();
    } else {
        $('.scrolltop').stop(true, true).fadeOut();
    }
});
$(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".gotop").offset().top},"1000");return false})})
</script>

</body>

</html>
