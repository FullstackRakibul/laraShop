<table id="search-data" class="table table-bordered table-striped">

   @foreach($show_datas as $show_data)
   <tr>
     <td class="search-img">
        @foreach($productimage as $proimage)
         @if($show_data->id==$proimage->product_id)
             <a href="{{url('product-details/'.$show_data->id.'/'.$show_data->slug)}}">
              <img src="{{asset($proimage->image)}}" alt="">
            </a>
          @break
          @endif
        @endforeach
     </td>
     <td>
      <a href="{{url('product-details/'.$show_data->id.'/'.$show_data->slug)}}">
        {{$show_data->proName}}
      </a>
    </td>
     <!-- <td>{{ date('F d, Y', strtotime($show_data->created_at)) }}</td> -->
     <td>
        <a href="{{url('product-details/'.$show_data->id.'/'.$show_data->slug)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
     </td>
   </tr>
   @endforeach

  </table>