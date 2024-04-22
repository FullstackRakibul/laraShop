<a href="{{url('/show-cart')}}">
               <img src="{{asset('public/frontEnd')}}/images/cart.png" alt=""> 
                <span>{{Cart::instance('shopping')->content()->count()}}</span></a>