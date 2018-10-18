@extends('layout.master.admin_master')

@section('title', 'Ads List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Our Advertise List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($ads)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_25">Advertise Title</th>
                                <th class="width_12">Type</th>
                                <th class="width_14">Add By</th>
                                <th class="width_14">City</th>
                                <th class="width_13">Date</th>
                                <th class="width_12">Status</th>
                                <th class="width_10">Action</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($ads)>0)
                                @foreach($ads as $ad)
                                    <tr id="row_{{$ad->id}}">
                                        <td class="tab-grid width_25 col1 display_none" data-line="Advertise Image">
                                            <?php $cat_img = \App\AdsImages::where(['ad_id' => $ad->id])->first(); ?>
                                            @if(isset($cat_img->image_url))
                                                <img id="admin_adverlist_img"
                                                     src="{{url('').'/'.$cat_img->image_url}}"/>
                                            @else
                                                <img id="admin_adverlist_img"
                                                     src="{{url('images/Adver_mainimg1.jpg')}}"/>
                                            @endif
                                        </td>
                                        <td class="tab-grid width_12 display_none" data-line="Contact No."
                                            id="admin_adverlist_contact">
                                            {{isset($ad->user->contact)?$ad->user->contact:'-'}}
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title"
                                            id="admin_adverlist_title">
                                            {{$ad->ad_title}}
                                        </td>
                                        <td class="tab-grid width_12 col2"
                                            data-line="Type"
                                            id="admin_adverlist_category">{{isset($ad->ad_cat->category)? $ad->ad_cat->category:'-'}}</td>
                                        <td class="tab-grid width_14 col1" data-line="Advertise By"
                                            id="admin_adverlist_by">
                                            {{isset($ad->user->timeline->name)?$ad->user->timeline->name:'-'}}
                                        </td>
                                        <td class="tab-grid width_14 col3" data-line="City"
                                            id="admin_adverlist_city">{{$ad->city}}</td>
                                        <td class="tab-grid width_13 col5"
                                            data-line="Date"
                                            id="admin_adverlist_date">{{ date_format(date_create($ad->created_time), "d-M-Y h:i A")}}</td>
                                        <td class="tab-grid width_12 col6 text_center" data-line="Status"
                                            id="admin_adverlist_status">

                                            @if($ad->status=='Approved')
                                                <div class="status excepted">{{$ad->status}}</div>
                                            @elseif($ad->status=='Pending')
                                                <div class="status pending">{{$ad->status}}</div>
                                            @else
                                                <div class="status rejected">{{$ad->status}}</div>
                                            @endif
                                        </td>
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
                                                    <li><a data-toggle="modal"
                                                           onclick="ShowAdvertiseDetails_admin(row_{{$ad->id}});"
                                                           data-target="#Modal_ViewDetails_advertiselist"><i
                                                                    class="mdi mdi-more optiondrop_icon"></i>More</a>
                                                    </li>
                                                    @if($ad->status=='Pending')
                                                        <li>
                                                            <a id="{{$ad->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to Approve this ad');"
                                                               class="btnApprove">
                                                                <i class="mdi mdi-format-list-checks optiondrop_icon approve_color"></i>Approve</a>
                                                        </li>
                                                        <li>
                                                            <a onclick="GetRowidforrejection({{$ad->id}});"
                                                               class="btnReject"
                                                               href="#Modal_Actionreasons" data-toggle="modal">
                                                                <i class="mdi mdi-comment-remove-outline optiondrop_icon reject_color"></i>Reject</a>
                                                        </li>
                                                    @endif
                                                    {{--<li>--}}
                                                    {{--<a id="{{$ad->id}}"--}}
                                                    {{--onclick="ShowConformationPopupMsg('Are you sure you want to delete this ad');"--}}
                                                    {{--class="border_none btnDelete"><i--}}
                                                    {{--class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a>--}}
                                                    {{--</li>--}}
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
    <div class="modal fade-scale" id="Modal_Actionreasons1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog reason_model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reason For Rejection</h4>
                </div>

                {!! Form::open(['url' => 'adreject', 'class' => '', 'id'=>'rejfrm']) !!}
                <div class="modal-body">
                    <input type="hidden" id="adreject" name="addid"/>
                    <textarea cols="1" rows="4" name="reject_reason" id="master_reasontxt"
                              class="form-control txt_resize"
                              placeholder="Enter Reason" data-validate="btn_lbreason" maxlength="700"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_lbreason" onclick="ReasonAdvertise();">
                        Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <script>
        $('.btnApprove').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/ads/" + id + "/approve";
            $('#ConfirmBtn').attr("href", append_url);
        });
        function GetRowidforrejection(row_id) {
            $('#adreject').val(row_id);
        }
        {{--$('.btnReject').click(function () {--}}
            {{--var id = $(this).attr('id');--}}
            {{--var append_url = '{{ url('/') }}' + "/ads/" + id + "/approve";--}}
            {{--$('#ConfirmBtn').attr("href", append_url);--}}
        {{--});--}}

        $(".btnReject").click(function () {
            $('#Modal_Actionreasons1').modal('show');
//            $('.modal-title').html('Confirm Rejection');
                    {{--$('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');--}}
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/adreject/" + id + "/reason";
//            $.ajax({
//                type: "GET",
//                contentType: "application/json; charset=utf-8",
//                url: editurl,
//                data: '{"data":"' + id + '"}',
//                success: function (data) {
////                    $('.modal-body').html(data);
//                },
//                error: function (xhr, status, error) {
//                    $('.modal-body').html(xhr.responseText);
//                    //$('.modal-body').html("Technical Error Occured!");
//                }
//            });
        });
        function ShowAdvertiseDetails_admin(dis) {
            $('#adver_title').text($(dis).find('#admin_adverlist_title').text());
            $('#adver_type').text($(dis).find('#admin_adverlist_category').text());
            $('#adver_by').text($(dis).find('#admin_adverlist_by').text());
            $('#adver_city').text($(dis).find('#admin_adverlist_city').text());
            $('#adver_date').text($(dis).find('#admin_adverlist_date').text());
            $('#adver_status').text($(dis).find('#admin_adverlist_status').text());
            $('#adver_contact').text($(dis).find('#admin_adverlist_contact').text());
            $('#adver_image').attr('src', $(dis).find('#admin_adverlist_img').attr('src'));
            //globalloaderhide();
        }
        function Requiredtxt(me) {
            var text = $.trim($(me).val());
            if (text == '') {
                $(me).addClass("errorClass");
                return false;
            } else {
                $(me).removeClass("errorClass");
                return true;
            }
        }
        $(function () {
            $('form#rejfrm').submit(function () {
                /* var c = confirm("Are you sure to continue?");
                 return c;*/
                var reason_data = $('#master_reasontxt').val();
                var result = true;
                if (!Boolean(Requiredtxt("#master_reasontxt"))) {
                    result = false;
                }
                if (!result) {
                    return false;
                }
            });
        });

    </script>

@stop