@extends('frontEnd.layouts.master')
@section('title','Order Invoice')
@section('content')
 <style>
      @media print
        {
        html,body{ visibility: hidden;  margin: 0 !important;padding: 0 !important; vertical-align: middle;}
        #printDivone * { visibility: visible; }
         #printDivone { position: absolute; top: -120px !important; left: 80px !important;right:0 !important; !important; width:950px !important;margin: 0 auto !important;padding: 0 !important;vertical-align: middle !important;}
        img{-webkit-print-color-adjust: exact !important;}
        footer,
        #non-printable {
            display: none !important;}
        #tawkchat-status-text-container {
        	display: none !important;}
        	@page {
              size: A4; /* DIN A4 standard, Europe */
              margin:0;
            }
            .invoice-box,.customer-profile {
                margin:0 auto !important;
                vertical-align: middle !important;
                padding: 0 !important;
                
            }
            .invoice-box table{
                margin-bottom: 20px !important;
            }
            .invoice-address{
                position :relative !important;
                height : 250px;
            }
            img{
                width: 240px !important;
            }
        }
        
        
    .invoice-box {
        max-width: 950px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        position: relative;
        overflow: hidden;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    .table td, .table th {
        padding: 8px 10px;
    }
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    .paidbar {
        display: inline-block;
        position: absolute;
        right: -53px;
        top: 39px;
        background: #08c437;
        transform: rotate(49deg);
        width: 220px;
        text-align: center;
        color: #fff;
        padding: 7px;
    }
    .paidbar h4 {
        margin: 0;
    }
    </style>
<!--common html-->
<section class="customer-profile ">
    <div class="container-fluid">
        <div class="row">
            <div class="paddleft-120 col-lg-12 col-md-12 col-sm-4">
                <div class="customer-profile">
                        <!-- col end -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="cprofile-details">
                                <p class="account-title"><a href="{{url('customer/order')}}">Order</a> <i class="fa fa-long-arrow-right"></i> Customer Order Invoice</p>
                                <form action="{{url('customer/order/cancel/request')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hidden_id" value="{{$orderInfo->orderIdPrimary}}">
                                    <button type="submit" class="btn btn-danger" title="cancel order" onclick="return confirm('Are you sure cancel order?')"> Cancel Order</button>
                                  </form>
                                  
                                <div style="text-align: center;">
                                    <input type="button" onclick="printInvoice1();" value="Print" style="color: #fff;border: 0;padding: 6px 12px;background: green;border-radius: 5px;
                  margin-left: 10px;margin-bottom: 15px;cursor: pointer;" class="no-print">
                                </div>
                                <p style="margin-bottom:10px;text-align:center;">আপনি যদি পিডিএফ আকারে ইনভয়েসটি ডাউনলোড করতে চান তাহলে প্রিন্ট এ  ক্লিক করে  Save As PDF এ সেভ করুন </p>
                                <div class="invoice-box" id="printDivone">
                                    <table class="invoice-box-logo">
                                        <tr>
                                            <td class="title">
                                                @foreach($mainlogo as $logo)
                                                <img src="{{asset($logo->image)}}" style="width:240px;display:block !important; print-color-adjust: exact !important;">
                                                @endforeach
                                                <div style="margin-left: 12px;"><?php echo DNS2D::getBarcodeHTML(url('/').'/order/track/'.$orderInfo->trackingId, 'QRCODE',2,2); ?></div>
                                            </td>
                                            
                                            <td style="width:250px;padding-top:90px" class="invoice-address">
                                               <h4>Great Deal</h4>
                                                @foreach($contactinfoes as $key=>$value)
                                                <p>{{$value->address}}</p>
                                                <p>{{$value->email}}</p>
                                                <p>{{$value->phone}}</p>
                                                @endforeach
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <table style="margin-top:30px;">
                                        <tr >
                                             <td style="background: #eee;padding: 6px 15px;">
                                                 <h4><strong>Invoice #{{$orderInfo->orderIdPrimary + 6000}}</strong></h4>
                                                 <p>Track Id : {{$orderInfo->trackingId}}</p>
                                                 <p>Order Date : {{date('M d, Y', strtotime($shippingInfo->created_at))}}</p>

                                             </td>
                                             <td></td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td style="padding:30px 0">
                                                <strong>Invoice To :</strong><br>
                                                @if($shippingInfo !=NULL) {{$shippingInfo->name}} <br>
                                                {{$shippingInfo->address}}<br>
                                                Mobile : {{$shippingInfo->phone}}<br>
                                                @endif
                                            </td>
                                            
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered" style="border: 2px solid #ddd !important">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <td style="background: #eee !important;">Description</td>
                                                <td style="background: #eee !important;"> Price</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0;
                                            @endphp
                                         @foreach($orderDetails as $key=>$value)
                                            <tr style="border: 2px solid #ddd !important">
                                                <td style="border: 2px solid #ddd !important">{{$value->productName}} <div class="smallnote">
                                                     <p>@if(!$value->productSize=='') size: {{$value->productSize}} @endif
                                                     @if(!$value->productColor=='') Color: {{$value->productColor}} @endif</p>
                                                </div>
                                                </td style="border: 2px solid #ddd !important">
                                                <td>{{$value->productPrice}} x {{$value->productQuantity}} = BDT {{$value->productPrice*$value->productQuantity}} /-</td>
                                            </tr>
                                            @php
                                                $subtotal += $value->productPrice*$value->productQuantity;
                                            @endphp
                                            @endforeach
                                            <tr style="border: 2px solid #ddd !important">
                                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important"><strong>Sub Total</strong></td>
                                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important"><strong>BDT {{$subtotal}} /-</strong></td>
                                            </tr>
                                            <tr style="border: 2px solid #ddd !important">
                                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important"><strong>Shipping Fee</strong></td>
                                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important"><strong>BDT {{$shippingInfo->shippingfee}} /-</strong></td>
                                            </tr>
                                            <tr style="border: 2px solid #ddd !important">
                                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important"><strong>Discount</strong></td>
                                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important"><strong>BDT {{$orderInfo->discount}} /-</strong></td>
                                            </tr>
                                            <tr style="border: 2px solid #ddd !important">
                                                <td style="text-align:right;background:#eee !important;border: 2px solid #ddd !important"><strong>Total</strong></td>
                                                <td style="text-align:center;background:#eee !important;border: 2px solid #ddd !important"><strong>BDT {{$orderInfo->orderTotal}} /-</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                             </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  function printInvoice1()
 {
     printDivone = "#printDivone"; // id of the div you want to print
     $("*").addClass("no-print");
     $(printDivone+" *").removeClass("no-print");
     $(printDivone).removeClass("no-print");
     parent =  $(printDivone).parent();
     while($(parent).length)
     {
         $(parent).removeClass("no-print");
         parent =  $(parent).parent();
     }
     window.print();

 }
</script>
@endsection
