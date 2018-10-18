@extends('layout.master.admin_master')

@section('title', 'Registration List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Registration List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($regs)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_10">Profile</th>
                                <th class="width_10">Ref.Code</th>
                                <th class="width_15">Name</th>
                                <th class="width_12">Contact</th>
                                <th class="width_18">Email</th>
                                {{--<th class="width_10">Earning</th>--}}
                                {{--<th class="width_10">Profession</th>--}}
                                <th class="width_14">Membership</th>
                                {{--<th class="width_6">Type</th>--}}
                                <th class="width_6">Status</th>
                                <th class="width_6">Registration Date</th>
                                <th class="width_12">Option</th>
                            </tr>
                            </thead>
                            <tbody id="ListContainerSection">
                            @if(count($regs)>0)
                                @foreach($regs as $reg)
                                    <tr>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{--                                            <img src="{{url('').'/'.$reg->profile_pic}}" alt="profile">--}}
                                            <div class="post_imgblock_admin"><img
                                                        src="{{url('').'/'.$reg->profile_pic}}"/></div>
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$reg->rc}}
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$reg->timeline->name}}
                                        </td>

                                        <td class="tab-grid width_20 col3" data-line="City">{{$reg->contact}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City">{{$reg->email}}</td>

                                        {{--<td class="tab-grid width_20 col3" data-line="City">{{$reg->profession}}</td>--}}
                                        <td class="tab-grid width_20 col3" data-line="City">
                                            <?php $child = \Illuminate\Support\Facades\DB::select("SELECT parent_id FROM relations WHERE child_id = $reg->id and parent_id != '0'") ?>
                                            {{isset($child[0]->parent_id)? 'Child('.$child[0]->parent_id.')':'Parent'}}
                                            {{--                                            @if(isset($child) == '') {{'child('$child[0]')'}} @else {{'Parent'}} @endif--}}
                                        </td>
                                        <td class="tab-grid width_10 col2"
                                            data-line="Type">
                                            @if($reg->active == '1')
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">InActive</span>
                                            @endif
                                        <td class="tab-grid width_10 col2"
                                            data-line="Type">{{ date_format(date_create($reg->created_time), "d-M-Y h:i A")}}</td>
                                        <td class="tab-grid width_10 col7" data-line="Action">
                                            <div class="btn-group position_absolute">
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Options
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true"><span class="caret"></span><span
                                                            class="sr-only">Toggle Dropdown</span></button>
                                                <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                    @if($reg->member_type =='free')
                                                        <li>
                                                            <a id="{{$reg->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to make this user paid');"
                                                               class="btnPaid">
                                                                <i class="mdi mdi-format-list-checks optiondrop_icon approve_color"></i>Mark
                                                                as paid</a></li>
                                                        {{--@else--}}
                                                        {{--<li>--}}
                                                        {{--<a id="{{$reg->id}}" onclick="ShowConformationPopupMsg('Are you sure you want to make this user free...once you make this user free he/she will not have any parent');"--}}
                                                        {{--class="btnUnpaid" href="#Modal_Actionreasons"--}}
                                                        {{--data-toggle="modal"> <i class="mdi mdi-comment-remove-outline optiondrop_icon reject_color"></i>Mark as free</a>--}}
                                                        {{--</li>--}}
                                                    @endif
                                                    @if($reg->active == '1')
                                                        <li>
                                                            <a id="{{$reg->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to inactivate this user');"
                                                               class="border_none btnInactive"><i
                                                                        class="mdi mdi-delete optiondrop_icon delete_color"></i>Inactive</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a id="{{$reg->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to activate this user');"
                                                               class="border_none btnActive"><i
                                                                        class="mdi mdi-check optiondrop_icon delete_color"></i>Activate</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a id="{{$reg->id}}" onclick="get_more(this)"
                                                           class="border_none btnView"><i
                                                                    class="mdi mdi-eye optiondrop_icon"></i>View
                                                            More</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9">
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

        $('.btnPaid').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/markaspaid/" + id;
            $('#ConfirmBtn').attr("href", append_url);
        });

        $('.btnUnpaid').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/markasunpaid/" + id;
            $('#ConfirmBtn').attr("href", append_url);
        });

        $('.btnInactive').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/markasinactive/" + id;
            $('#ConfirmBtn').attr("href", append_url);
        });
        $('.btnActive').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/markasactive/" + id;
            $('#ConfirmBtn').attr("href", append_url);
        });

        function get_more(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('View Details');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');

            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/view_user/" + id;
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