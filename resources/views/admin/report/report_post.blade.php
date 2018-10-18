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
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Report Post List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($posts)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_10">Post By</th>
                                <th class="width_25">Post By Name</th>
                                <th class="width_15">Post Time</th>
                                <th class="width_12">Status</th>
                                <th class="width_12">Like Count</th>
                                <th class="width_12">Dislike Count</th>
                                <th class="width_12">Spam Count</th>
                                <th class="width_10">Action</th>
                            </tr>
                            </thead>
                            <tbody id="ListContainerSection">
                            @if(count($posts)>0)
                                @foreach($posts as $post)
                                    @php
                                        $like = \App\Post_likes::where(['post_id' => $post->id])->count();
                                        $dislike = \App\Post_unlikes::where(['post_id' => $post->id])->count();
                                        $spam = \App\Post_spam::where(['post_id' => $post->id])->count();
                                        $user = \App\UserModel::find($post->posted_by);
                                    @endphp
                                    <tr id="row_{{$post->id}}">
                                        <td class="tab-grid width_10 col1" data-line="Advertise Title">
                                            <div class="post_imgblock_admin"><img style="height: 100%"
                                                        src="{{url('').'/'.$user->profile_pic}}"/></div>
                                        </td>
                                        {{--<td class="tab-grid width_25 col1 display_none" data-line="Advertise Image">--}}

                                            {{--@if(isset($cat_img->image_url))--}}
                                                {{--<img id="admin_adverlist_img"--}}
                                                     {{--src="{{url('').'/'.$cat_img->image_url}}"/>--}}
                                            {{--@else--}}
                                                {{--<img id="admin_adverlist_img" src="{{url('images/Adver_mainimg1.jpg')}}"/>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        {{--<td class="tab-grid width_12 display_none" data-line="Contact No."--}}
                                            {{--id="admin_adverlist_contact">--}}
                                            {{--{{isset($post->user->contact)?$post->user->contact:'-'}}--}}
                                        {{--</td>--}}
                                        <td class="tab-grid width_12 col1" data-line="Advertise Title"
                                            id="admin_adverlist_title">
                                            {{$user->timeline->name}}
                                        </td>
                                        {{--<td class="tab-grid width_12 col2"--}}
                                            {{--data-line="Type"--}}
                                            {{--id="admin_adverlist_category">{{isset($post->ad_cat->category)? $post->ad_cat->category:'-'}}</td>--}}
                                        {{--<td class="tab-grid width_14 col1" data-line="Advertise By"--}}
                                            {{--id="admin_adverlist_by">--}}
                                            {{--{{isset($post->user->timeline->name)?$post->user->timeline->name:'-'}}--}}
                                        {{--</td>--}}
                                        {{--<td class="tab-grid width_14 col3" data-line="City"--}}
                                            {{--id="admin_adverlist_city">{{$post->city}}</td>--}}
                                        <td class="tab-grid width_15 col5"
                                            data-line="Date"
                                            id="admin_adverlist_date">{{ date_format(date_create($post->created_at), "d-M-Y h:i A")}}</td>

                                        <td class="tab-grid width_12 col6 text_center" data-line="Status"
                                            id="admin_adverlist_status">

                                            @if($post->active==1)
                                                <div class="status excepted">{{"Live"}}</div>
                                            {{--@else--}}
                                                {{--<div class="status rejected">{{"Removed"}}</div>--}}
                                            @endif
                                        </td>
                                        <td class="tab-grid width_13 col5"
                                            data-line="Date"
                                            id="admin_adverlist_date">{{ $like}}</td>
                                        <td class="tab-grid width_13 col5"
                                            data-line="Date"
                                            id="admin_adverlist_date">{{ $dislike}}</td>
                                        <td class="tab-grid width_13 col5"
                                            data-line="Date"
                                            id="admin_adverlist_date">{{ $spam}}</td>
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
                                                    <li><a onclick="show_report_post('{{$post->id}}');"><i
                                                                    class="mdi mdi-more optiondrop_icon"></i>More</a>
                                                    </li>
                                                    {{--@if($post->active=='1')--}}
                                                        {{--<li>--}}
                                                            {{--<a id="{{$post->id}}"--}}
                                                               {{--onclick="ShowConformationPopupMsg('Are you sure you want to Approve this ad');"--}}
                                                               {{--class="btnApprove">--}}
                                                                {{--<i class="mdi mdi-format-list-checks optiondrop_icon approve_color"></i>Approve</a>--}}
                                                        {{--</li>--}}
                                                        {{--<li>--}}
                                                            {{--<a onclick="GetRowidforrejection({{$post->id}});"--}}
                                                               {{--class="btnReject"--}}
                                                               {{--href="#Modal_Actionreasons" data-toggle="modal">--}}
                                                                {{--<i class="mdi mdi-comment-remove-outline optiondrop_icon reject_color"></i>Reject</a>--}}
                                                        {{--</li>--}}
                                                    {{--@endif--}}
                                                    <li>
                                                        <a id="{{$post->id}}"
                                                           onclick="ShowConformationPopupMsg('Are you sure you want to delete this ad');"
                                                           class="border_none btnDelete"><i
                                                                    class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
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
        function show_report_post(post_id) {
            $('#myModal').modal('show');
            $('#modal_title').html('View Post');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var editurl = '{{ url('view_report_post') }}';
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: {post_id: post_id},//'{"data":"' + id + '"}',
                success: function (data) {
//                    alert(data);
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        }
        $('.btnApprove').click(function () {
            var id = $(this).attr('id');
            $('#ConfirmBtn').html('<a class="popup_submitbtn conformation_bg a-design conformation_btn" href="{{ url('ads') }}/' + id +
                '/approve"> Yes</a>'
            );
        });
    </script>
@stop

