
 @php
    $cartInfos = Cart::instance('shopping')->content();
 @endphp  
      <div class="container">
         <div class="row">
             <div class="col-2">
                 <div class="mobile-chat">
                     <a href=""><img src="{{asset('public/frontEnd/images/chat.png')}}"></a>
                 </div>
             </div>
             <div class="col-8">
                 <div class="mobile-shopping">
                     @if($cartInfos)
                     <a href="{{url('/checkout')}}">Place Order</a>
                     @else
                     <a href="{{url('/')}}">Start Shopping</a>
                     @endif
                 </div>
             </div>
             <div class="col-2">
                 <div class="mobile-chat">
                     <a class="anchor mycatopen"><span>{{$cartInfos->count()}}</span> <img src="{{asset('public/frontEnd/images//mobile-shopping-cart.png')}}"></a>
                 </div>
             </div>
         </div>
     </div>
<script src="{{asset('public/frontEnd/')}}/js/jquery-3.3.1.min.js"></script>
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