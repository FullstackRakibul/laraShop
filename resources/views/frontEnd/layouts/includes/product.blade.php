@if($products->isEmpty())
	<p>No Product Found</p>
@else
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
                <p class="discount">Save {{$value->proOldprice}}%</p>
                @endif
                
          </div>
           
          </a>
          <div class="hproduct-info">
              
              <p class="hproduct-name">{{str_limit($value->proName,25)}}</p>
              <!-- <p class="hproduct-qty">৳ 60/kg</p> -->
             <ul>
               <li> <p class="hproduct-price">৳{{$value->proNewprice}} <span>@if($value->proOldprice)৳ 
                @php $offertaka= (($value->proOldprice*$value->proNewprice)/100);
                 $oldprice = $offertaka+$value->proNewprice; 
                @endphp 
                
                {{$oldprice}} 
              @endif</span></p></li>
               
             </ul>
          </div>
          <div class="product-actions">
            <div class="wishcompare">
                  <ul>
                    <li>
                      <a class="comparecartbutton anchor custtooltip" data-id="{{$value->id}}">
                        <span class="tooltiptext">Compare</span>
                        <i class="fa fa-exchange"></i></a>
                    </li>
                    <li>
                      <a  class="wishcartbutton anchor custtooltip" data-id="{{$value->id}}">
                        <span class="tooltiptext">Wishlist</span>
                        <i class="fa fa-heart-o"></i>
                      </a>
                    </li>
                    <li>
                      <a href="{{url('product-details/'.$value->id)}}" class="custtooltip">
                        <span class="tooltiptext">Quick View</span>
                        <i class="fa fa-eye"></i>
                      </a>
                    </li>
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

</div>
<!-- row end -->
<div class="row">
  <div class="col-sm-12">
    {{$products->links()}}
  </div>
</div>
@endif