@extends('backEnd.layouts.master')
@section('title', 'Order Manage')
@section('main_content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order information</h3>
                        <div class="short_button">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="dashboard-filter">
                            <form class="form-row" id="action-form" method="GET">
                                @csrf
                                <div class="col-sm-2">
                                    <div class="from-group">
                                        <label>Action</label>
                                        <select name="action" class="form-control">
                                            <option value="" selected>Select An Action</option>
                                            <option value="courier">Send to courie</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="from-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($ordertypes as $orderstatus)
                                                <option value="{{ $orderstatus->id }}"
                                                    {{ $status == $orderstatus->id ? 'selected' : '' }}
                                                    class="form-control">{{ $orderstatus->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Select Filter</label>
                                    <select class="form-control" name="filter">
                                        <option value="1" {{ $filter == 1 ? 'selected' : '' }}>All</option>
                                        <option value="2" {{ $filter == 2 ? 'selected' : '' }}>Today</option>
                                        <option value="3" {{ $filter == 3 ? 'selected' : '' }}>Yesterday</option>
                                        <option value="4" {{ $filter == 4 ? 'selected' : '' }}>Current Month</option>
                                        <option value="5" {{ $filter == 5 ? 'selected' : '' }}>Last Month</option>
                                        <option value="6" {{ $filter == 6 ? 'selected' : '' }}>Current Year</option>
                                        <option value="7" {{ $filter == 7 ? 'selected' : '' }}>Last Year</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>Start (optional)</label>
                                    <input class="form-control mydate" name="start" type="date"
                                        value="{{ old('mydate') }}">
                                </div>
                                <div class="col-sm-2">
                                    <label>End (optional)</label>
                                    <input class="form-control mydate"name="end" type="date"
                                        value="{{ old('end') }}">
                                </div>
                                <div class="col-sm-2">
                                    <label></label>
                                    <input class="btn btn-success" value="Apply" type="submit">
                                </div>
                            </form>
                        </div>
                        @php
                            $total = 0;
                        @endphp
                        <table id="example" class="table  table-responsive-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="parent-check" id="all-select">
                                    </th>
                                    <th>Sl</th>
                                    <th>Track Id</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Total Price</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Order Time</th>
                                    <!--<th>Cancel Request</th>-->
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($show_data as $key => $value)
                                    <?php
                                        $orderDetails = App\Orderdetails::where('orderId', $value->orderIdPrimary)
                                            ->latest()
                                            ->get();
                                        $shipping    = App\Shipping::where('shippingPrimariId',$value->shippingId)->first();

                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" value="{{ $value->orderIdPrimary }}" name="bulk[]" class="child-check">
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->trackingId }}</td>
                                        <td>{{ $value->fullName }}</td>
                                        <td>{{ $value->phoneNumber }}</td>
                                        <td>BTD {{ $value->orderTotal }}</td>
                                        <td>
                                            @foreach ($orderDetails as $details)
                                                {{ $details->productName }} ,
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($orderDetails as $details)
                                                <img src="{{ asset($details->productImage) }}" alt=""
                                                    style="width:100px;">
                                            @endforeach
                                        </td>

                                        <td>
                                            <p><strong>Date: </strong> {{ date('F d, Y', strtotime($value->updated_at)) }}
                                            </p>
                                            <p><strong>Time: </strong> {{ date('h:i:s a', strtotime($value->updated_at)) }}
                                            </p>
                                        </td>
                                        <!--<td>{{ $value->cancelRequest == 1 ? 'Yes' : 'No' }}</td>-->
                                        <td>
                                            @foreach ($ordertypes as $orderstatus)
                                                @if ($orderstatus->id == $value->orderStatus)
                                                    {{ $orderstatus->name }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <ul class="action_buttons dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-toggle="dropdown">Action
                                                    <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="edit_icon" href="{{ url('editor/order/details/' . $value->shippingId . '/' . $value->customerId . '/' . $value->orderIdPrimary) }}">
                                                        <i class="fa fa-eye"></i> Details View </a>
                                                    </li>
                                                    <li>
                                                        <a class="edit_icon set-courier" href="#" data-courier="{{ $shipping->courier }}" data-courier-info="{{ json_encode(unserialize($shipping->courier_info)) }}" data-shipping="{{ $value->shippingId }}" data-order="{{ $value->orderIdPrimary }}"  data-toggle="modal" data-target="#courierModal">
                                                        <i class="fa fa-truck"></i> Set Courier</a>
                                                    </li>
                                                    @foreach ($ordertypes as $orderstatus)
                                                        <li>
                                                            <a href="{{ url('editor/order/status/' . $value->orderIdPrimary . '/' . $orderstatus->id) }}"
                                                                class="rbox-{{ $orderstatus->id }}">
                                                                @if ($orderstatus->id == $value->orderStatus)
                                                                    <i class="fa fa-check"></i>
                                                                @endif {{ $orderstatus->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    <li>
                                                        <button class="btn btn-sm btn-info" data-toggle="modal"
                                                            data-target="#exampleModal_{{ $value->orderIdPrimary }}">History</button>
                                                    </li>
                                                </ul>
                                            </ul>
                                            </ul>
                                        </td>
                                        @php
                                            $total += $value->orderTotal;
                                        @endphp
                                    </tr>
                                    <?php
                                    $histories = App\OrderStatusHistory::where('order_id', $value->orderIdPrimary)
                                        ->latest()
                                        ->get();
                                    ?>
                                    <!--Modal-->
                                    <div class="modal fade" id="exampleModal_{{ $value->orderIdPrimary }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Order Status Change
                                                        History</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach ($histories as $history)
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <p class="card-text">Status:
                                                                        {{ $history->statustype->name }}</p>
                                                                    <p class="card-text">Changed By:
                                                                        {{ $history->updatedBy->name }}</p>
                                                                    <p class="card-text">Changed At:
                                                                        {{ $history->updated_at->format('F j, Y h:i A') }}
                                                                    </p>
                                                                    <!-- Add more card details as needed -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>{{ $total }} BDT</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    

    <!--Courier Modal-->
    <div class="modal fade" id="courierModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form  method="POST" id="edit-form">
                        @csrf
                        <input type="hidden" name="order_id" value="">

                        <div class="row d-flex">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="courierName">Courier Name</label>
                                    <select class="form-control" id="courierName" name="couriername" required>
                                        <option value="">Select A Courier</option>
                                        <option value="pathao">Pathao</option>
                                        <option value="e-courier">eCourier</option>
                                        <option value="redex">redex</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cityName">City Name</label>
                                    <select class="form-control" id="cityName" name="cityname" required>
                                        <option value="">Select A City</option>
                                        <!-- Add options here for cities from the database -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="zoneName">Zone Name</label>
                                    <select class="form-control" id="zoneName" name="zonename" required>
                                        <option value="">Select A Zone</option>
                                        <!-- Add options here for zones from the database -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="areaName">Area Name</label>
                                    <select class="form-control" id="areaName" name="areaname">
                                        <option value="">Select An Area</option>
                                        <!-- Add options here for zones from the database -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="storeName">Select Store</label>
                                    <select class="form-control" id="storeName" name="storename" required>
                                        <option value="">Select A Store</option>
                                        <!-- Add options here for zones from the database -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="storeName">Item Weight</label>
                                    <select class="form-control" name="itemweight" required >
                                        <option value="0.5">0 - 0.5</option>
                                        <option value="1">0.5 - 1</option>
                                        <option value="2">1 - 2</option>
                                        <option value="3">2 - 3</option>
                                        <option value="4">3 - 4</option>
                                        <option value="5">4 - 5</option>
                                        <option value="6">5 - 6</option>
                                        <option value="7">6 - 7</option>
                                        <option value="8">7 - 8</option>
                                        <option value="9">8 - 9</option>
                                        <option value="10">9 - 10</option>
                                        <option value="11">10 - 11</option>
                                        <option value="12">11 - 12</option>
                                        <option value="13">12 - 13</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="deliveryType">Delivery Type</label>
                                    <select name="deliverytype" id="deliveryType" class="form-control" required>
                                        <option value="">Select Delivery Type</option>
                                        <option value="48">Normal Delivery</option>
                                        <option value="12">On Demand Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 " id="item-type">
                                <div class="form-group">
                                    <label for="itemtype">Select Item type</label>
                                    <div class="types">
                                        <label style="cursor:pointer;font-size:12px;font-weight:normal;"  for="document">
                                            <input  style="position: inherit;" id="document" type="radio" name="itemtype" value="1" required> Docuemnt
                                        </label>
                                        <br>
                                        <label style="cursor:pointer;font-size:12px;font-weight:normal;" for="parcel">
                                            <input style="position: inherit;" id="parcel" type="radio" name="itemtype" value="2" required> Parcel
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="storeName">Special instruction for rider</label>
                                    <textarea class="form-control" name="specialnote" id="" placeholder="Please handle carefully"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-3 form-group d-flex ">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </div>
                        </div>
                          {{-- hidden --}}
                        <input type="hidden" id="courier_name" name="courier_readable_info[Courier_Name]">
                        <input type="hidden" id="courier_city" name="courier_readable_info[Customer_City]">
                        <input type="hidden" id="courier_zone" name="courier_readable_info[Customer_Zone]">
                        <input type="hidden" id="courier_area" name="courier_readable_info[Customer_Area]">
                        <input type="hidden" id="courier_store" name="courier_readable_info[Store_Name]">
                        <input type="hidden" id="courier_delivery_type" name="courier_readable_info[Delivery_Type]">
                        <input type="hidden" id="courier_item_type" name="courier_readable_info[Product_Type]">
                    </form>
                    <div class="set-data" style="display: none">
                        <h3>Courier info already set <button type="button" class="btn btn-sm btn-primary edit-btn">Edit Info</button></h3>
                        <div class="data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        $( function() {
            // get pathao cities
            $('#courierName').on('change', async function() {

                $('#item-type').addClass('d-none');
                $('#courier_name').val($(this).val());
                switch ($(this).val()) {
                    case 'pathao':
                        $('#item-type').removeClass('d-none');

                        const res = await pathaoAPI("{{ route('editor.pathao-cities') }}");

                        if (res.code == 200) {
                            const { data } = res.data;

                            const options = data.map(function(city) {
                                return `<option value="${city.city_id}">${ city.city_name }</option>`;
                            }).join('');

                            $('#cityName').html(`
                                <option value="">Select A City</option>
                                ${options}
                            `);
                        }
                
                        break;
                }

                //get pathao stores
                const res = await pathaoAPI('{{ route("editor.pathao-stores") }}');

                if (res.code == 200) {
                    const { data } = res.data;

                    const options = data.map(function(store) {
                        return `<option value="${store.store_id}">${ store.store_name }</option>`;
                    }).join('');

                    $('#storeName').html(`
                        <option value="">Select A Store</option>
                        ${options}
                    `);
                }
                
            });

            // get pathao zone
            $('#cityName').on('change', async function() {

                $('#courier_city').val(
                    $(this).find('option:selected').text()
                );

                const res = await pathaoAPI('{{ route('editor.pathao-zone') }}', {
                    'city_id': $(this).val()
                });

                if (res.code == 200) {
                    const { data } = res.data;
                    const options = data.map(function(zone) {
                        return `<option value="${zone.zone_id}">${ zone.zone_name }</option>`;
                    }).join('');

                    $('#zoneName').html(`
                        <option value="">Select A Zone</option>
                        ${options}
                    `);
                }

            })

            // get pathao zone
            $('#zoneName').on('change', async function() {

                $('#courier_zone').val(
                    $(this).find('option:selected').text()
                );

                const res = await pathaoAPI('{{ route('editor.pathao-area') }}', {
                    'zone_id': $(this).val()
                });

                if (res.code == 200) {
                    const { data } = res.data;
                    const options = data.map(function(zone) {
                        return `<option value="${zone.area_id}" >${ zone.area_name }</option>`;
                    }).join('');

                    $('#areaName').html(`
                        <option value="">Select An Area</option>
                        ${options}
                    `);
                }
            });


            $('#areaName').on('change',function(){
                $('#courier_area').val(
                    $(this).find('option:selected').text()
                );
            })

            $('#storeName').on('change',function(){
                $('#courier_store').val(
                    $(this).find('option:selected').text()
                );
            })

            $('#deliveryType').on('change',function(){
                $('#courier_delivery_type').val(
                    $(this).find('option:selected').text()
                );
            })

            $('input[name="itemtype"]').on('change',function(){
               $('#courier_item_type').val(
                    $(this).parent().text()
                );
            })
        });

        //bulk select
        (function bulkSelect() {
            const parentCheck = document.querySelector('#parent-check');

            const childCheck = document.querySelectorAll('.child-check');

            parentCheck.onchange = (e) => {

                childCheck.forEach(c => {
                    if (parentCheck.checked) {
                        c.checked = true;
                    } else {
                        c.checked = false
                    }
                });

            }

            childCheck.forEach(c => {
                c.addEventListener('click', function() {
                    if (document.querySelectorAll('input[name="bulk"]:checked').length == childCheck
                        .length) {
                        parentCheck.checked = true;
                    } else {
                        parentCheck.checked = false;
                    }
                });
            });


            $('#action-form').on("submit", function(e) {

                const action = $('select[name="action"]');

                if (action.val() == 'courier') {

                    e.preventDefault();

                    const checked = $('input[name="bulk[]"]:checked');

                    if (checked.length == 0) {
                        alert('Please select some items');
                        return;
                    }

                    var button      = $('input[type="submit"]');
                    var text        = button.text();

                    button.val('sending...');
                    button.attr('disabled',true);

                    $.ajax({
                        url      : '{{ route("editor.courier-order") }}',
                        method   : 'POST',
                        data     : $('input[name="bulk[]"]:checked,input[name="_token"]').serialize(),
                        success  : function(data){
                            window.location.href = `${window.location.href}`;
                        },
                        error : function(error){
                            window.location.href = `${window.location.href}`;
                        }
                    })

                }
            });
        
            $('.set-courier').on('click',function(){
                let orderId      = $(this).data('order');
                let shppingId    = $(this).data('shipping');
                let courier      = $(this).data('courier');
                let courierInfo  = $(this).data('courier-info');

                $('input[name="order_id"]').val(orderId);
                $('#edit-form').attr('action','{{ route("editor.courier-update-info",['']) }}/'+shppingId);

                if ( courierInfo && courier !== "" ) {
                    let readable = courierInfo.readable;
                    readable['Product_Weight'] = courierInfo.weight;
                    readable['Special_Instruction_For_Rider'] = courierInfo.specialnote;

                    let html = '';

                    for (const key in readable) {
                        if (Object.hasOwnProperty.call(readable, key)) {
                            if ( readable['key'] == "" ) {
                                continue;
                            }
                            html += `<p><strong>${key.replace('_',' ')} : </strong>${readable[key]}</p>`;
                        }
                    }
                    $('#edit-form').hide();
                    $('.set-data .data').html(html);
                    $('.set-data').show(html);
                } else {
                    $('#edit-form').show();
                    $('.set-data .data').html('');
                    $('.set-data').hide(html);
                }
            });

            $('.edit-btn').on('click',function(){
                $('#edit-form').show();
                $('.set-data .data').html('');
                $('.set-data').hide();
            })

        }());

        function pathaoAPI(route, data = {}) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `${route}`,
                    method: 'GET',
                    data: data,
                    success: function(res) {
                        try {
                            res = JSON.parse(res);
                            resolve(res);
                        } catch (error) {}
                    },
                    error: function(error) {
                        try {
                            res = JSON.parse(res);
                            reject(res);
                        } catch (error) {}
                    }
                });
            });
        }
    </script>
@endpush
