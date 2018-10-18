@extends('layout.master.admin_master')

@section('title', 'Notification List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Notification List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords">
                            {{--<a href="#" class="btn btn-primary create-add">Create Ad</a>--}}
                            <span class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($Notifications)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_25">Notification</th>
                                <th class="width_25">Image</th>
                                <th class="width_25">Status</th>
                                <th class="width_10">Action</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($Notifications)>0)
                                @foreach($Notifications as $noti)
                                    <tr>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$noti->notification == null ? "-" : $noti->notification}}
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            @if(isset($noti->image))<img src="{{url('').'/'.$noti->image}}" width="300px"
                                                                         alt="">@endif
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$noti->is_active == null ? 'Inactivated' : 'activated'}}
                                        </td>
                                        <td id="{{$noti->id}}" class="tab-grid width_10 col7" data-line="Action">
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
                                                    {{--<li><a data-toggle="modal"--}}
                                                    {{--data-target="#Modal_ViewDetails_LatestNews"><i--}}
                                                    {{--class="mdi mdi-more optiondrop_icon"></i>More</a>--}}
                                                    {{--</li>--}}
                                                    <li><a id="{{$noti->id}}" class="edit-ads"><i
                                                                    class="mdi mdi-account-edit optiondrop_icon"></i>Edit</a>
                                                    </li>
                                                    {{--<li>--}}
                                                    {{--<a id="{{$noti->id}}" title="Approved"--}}
                                                    {{--onclick="ShowConformationPopupMsg('Are you sure you want to Approve this ad');"--}}
                                                    {{--class="border_none btnApprove"><i--}}
                                                    {{--class="mdi mdi-more optiondrop_icon"></i>Approve Now</a>--}}
                                                    {{--</li>--}}
                                                    <li>
                                                        @if($noti->is_active==1)
                                                            <a id="{{$noti->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to Inactive this Notification');"
                                                               class="border_none btnDelete"><i
                                                                        class="mdi mdi-delete optiondrop_icon delete_color"></i>Inactivate</a>
                                                        @else
                                                            <a id="{{$noti->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to Active this Notification');"
                                                               class="border_none btnactive"><i
                                                                        class="mdi mdi-check optiondrop_icon delete_color"></i>Activate</a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">
                                        <span class="list_no_record">< No Record Available ></span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <!-- <div class="grid_pagination">
                             <div class="drop_downpagination">
                                 <select class="form-control" data-live-search="true">
                                     <option data-tokens="10">10</option>
                                     <option data-tokens="25">25</option>
                                     <option data-tokens="50">50</option>
                                     <option data-tokens="50">100</option>
                                     <option data-tokens="50">All</option>
                                 </select>
                             </div>
                             <div class="pagination_box">
                                 <ul class="pagination pagination_ul">
                                     <li class="page-item">
                                         <a href="#" class="page-link" aria-label="Previous">
                                             <span aria-hidden="true">«</span>
                                         </a>
                                     </li>
                                     <li class="page-item"><a href="#" class="page-link">1</a></li>
                                     <li class="page-item"><a href="#" class="page-link">2</a></li>
                                     <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                     <li class="page-item"><a href="#" class="page-link">4</a></li>
                                     <li class="page-item"><a href="#" class="page-link">5</a></li>
                                     <li class="page-item">
                                         <a href="#" class="page-link" aria-label="Next">
                                             <span aria-hidden="true">»</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".create-add").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Add New Notification');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('notificn/create') }}",
                success: function (data) {
                    $('.modal-body').html(data);
//            $('#modelBtn').visible(disabled);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });

        });

        $(".edit-ads").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Notification');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');

            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/notificn/" + id + "/edit";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/notification/" + id + "/delete";
            $('#ConfirmBtn').attr("href", append_url);
        });

        $('.btnactive').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/notification/" + id + "/active";
            $('#ConfirmBtn').attr("href", append_url);
        });
    </script>
@stop