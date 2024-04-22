@extends('frontEnd.layouts.master')
@section('title','Page Info')
@section('content')
    <!--common html-->
 <div class="custom-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul>
                        @include('frontEnd.layouts.includes.sidebar')  
                        <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                        <li><a class="anchor"><i class="fa fa-angle-right"></i></a></li>More Information </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--custom breadcrumb end-->
<!--custom breadcrumb end-->
<section class="productarea about-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="content-page">
                    <div class="single-page">
                    @if($moreinfoes!=NULL)
                        <h5 style="margin-bottom: 20px;">{{$moreinfoes->title}}</h5>
                        {!! $moreinfoes->text !!}
                    </div>
                    @else
                    <p>No Content Here</p>
                    @endif
                </div>
            </div>
            <!--row end-->
        </div>
    </div>
</section>
<!--productarea end-->
@endsection