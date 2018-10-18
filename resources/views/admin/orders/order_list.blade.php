@extends('layout.master.admin_master')

@section('title', 'Orders List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Orders List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($orders)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_10">Order No</th>
                                <th class="width_10">Order Date</th>
                                <th class="width_15">User Name</th>
                                <th class="width_10">Status</th>
                                <th class="width_10">Option</th>
                            </tr>
                            </thead>
                            <tbody id="ListContainerSection">
                            @if(count($orders)>0)
                                @foreach($orders as $order)
                                    @php $user = \App\UserModel::find($order->user_id); @endphp
                                    <tr>
                                        <td>{{$order->order_no}}</td>
                                        <td>{{ date_format(date_create($order->order_date), "d-M-Y h:i A")}}</td>
                                        <td>{{$user->timeline->name}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>
                                            <form action="{{url('order_update').'/'.$order->id}}" method="post">
                                                <div class="form-group">
                                                    <label class="form-label">{{$order->status}}</label>
                                                    <div class="input-with-icon  right">
                                                        <i class=""></i>
                                                        <select id="source" class="form-control" name="status"
                                                                style="width:100%">
                                                            <optgroup label="Status">
                                                                <option {{$order->status == 'Ordered' ? 'selected':''}}  value="Ordered">
                                                                    Ordered
                                                                </option>
                                                                <option {{$order->status == 'Packed' ? 'selected':''}}  value="Packed">
                                                                    Packed
                                                                </option>
                                                                <option {{$order->status == 'Shipped' ? 'selected':''}} value="Shipped">
                                                                    Shipped
                                                                </option>
                                                                <option {{$order->status == 'Delivered' ? 'selected':''}} value="Delivered">
                                                                    Delivered
                                                                </option>

                                                            </optgroup>
                                                        </select>
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <button type="submit" class="btn btn-sm btn-primary btn-cons"><i
                                                                    class="icon-ok"></i> Update
                                                        </button>
                                                        <button onclick="view_orders(this);" id="{{$order->id}}"
                                                                type="button" class="btn btn-sm btn-success  btn-cons">
                                                            <i
                                                                    class="icon-ok"></i> View Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
                                        <span class="list_no_record">< No Record Available ></span>
                                    </td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.btnApprove').click(function () {
            var id = $(this).attr('id');
            $('#ConfirmBtn').html('<a class="popup_submitbtn conformation_bg a-design conformation_btn" href="{{ url('ads') }}/' + id +
                '/approve"> Yes</a>'
            );
        });

        function view_orders(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('View Orders');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/view_orders/" + id;
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }

    </script>
@stop