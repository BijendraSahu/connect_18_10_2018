@extends('layout.master.master')

@section('title', 'My Advertisement')

@section('head')
    <section class="container-fluid overall_containner notofication_containner">
        <div class="row">
            <div class="col-md-2">
                <div class="profile_basic_menu_block">
                    <div class="profile_img_block">
                        <img src="{{url('').'/'.$user->profile_pic}}"/>
                    </div>
                    <div class="profile_name">{{$timeline->name}}</div>
                    {{--<div class="profile_follow"><i class="profile_icons mdi mdi-chemical-weapon"></i>100 Friends</div>--}}

                    <ul class="profile_ul">
                        <li><a href="{{url('my-earning')}}"><i class="profile_icons mdi mdi-currency-inr"></i>My Earning</a>
                        </li>
                        <li><a href="{{url('my-profile')}}"><i class="profile_icons mdi mdi-account-edit"></i>My Profile</a>
                        </li>
                        <li data-toggle="modal" data-target="#Mymodal_AddNewMamber">
                            <a><i class="profile_icons mdi mdi-account-multiple-plus"></i>Add Members</a></li>
                        <li><a href="{{url('myads')}}"><i class="profile_icons mdi mdi-chemical-weapon"></i>My Advertise</a>
                        </li>
                        <li><a href="{{url('my-network')}}"><i class="profile_icons mdi mdi-sitemap"></i>My Network</a>
                        </li>
                        <li><a href="{{url('member')}}"><i class="profile_icons mdi mdi-account-multiple"></i>All
                                Members</a></li>
                        <li style="border-bottom: none;">
                            <a href="{{url('buy')}}"><i class="profile_icons mdi mdi-cart-outline"></i>Buy & Sell</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-10">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-xs-12 head_caption">Our Advertise List
                            {{--  <a href="javascript:void(0);" onclick="create_add()" class="btn btn-warning btn-sm add-ouradd" id="add-Newouradd"><i class="mdi basic_icon_margin mdi-plus"></i>Create</a>--}}
                            <div class="grid_header_btnbox">
                            <div class="btn-group" onclick="create_add()" id="add-Newouradd">
                                <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create
                                </button>
                                <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="mdi mdi-plus"></span></button>
                            </div>
                            <div class="btn-group gridbtn-group pull-right" id="TotalRecords">
                                <span class="grid-counter-text">Counter</span><span class="btn btn-counter btn-sm">{{count($ads)}}</span>

                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_25">Advertise Title</th>
                                <th class="width_15">Type</th>
                                <th class="width_20">City</th>
                                <th class="width_16">Date</th>
                                <th class="width_12">Status</th>
                                <th class="width_12">Action</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($ads) > 0)
                                @foreach($ads as $ad)
                                    <tr id="row_{{$ad->id}}">
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title"
                                            id="admin_adverlist_title">
                                            <?php $cat_img = \App\AdsImages::where(['ad_id' => $ad->id])->first(); ?>
                                            @if(isset($cat_img->image_url))
                                                <img class="always_display_none" id="admin_adverlist_img"
                                                     src="{{url('').'/'.$cat_img->image_url}}"/>
                                            @else
                                                <img class="always_display_none" id="admin_adverlist_img"
                                                     src="{{url('images/Adver_mainimg1.jpg')}}"/>
                                            @endif
                                      <div class="always_display_none" id="admin_adverlist_contact">{{$ad->user->contact}}</div>
                                            {{$ad->ad_title}}
                                        </td>
                                        <td class="tab-grid width_15 col2"
                                            data-line="Type"
                                            id="admin_adverlist_category">{{isset($ad->ad_category_id)?$ad->ad_cat->category:'-'}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City"
                                            id="admin_adverlist_city">{{$ad->city}}</td>
                                        <td class="tab-grid width_16 col5"
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
                                        <td class="tab-grid width_12 col7 btn_td" data-line="Action">
                                            <div class="btn-group grid_btn_box">
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
                                                           onclick="ShowAdvertiseDetails_user(row_{{$ad->id}});"
                                                           data-target="#Modal_ViewDetails_advertiselist"><i
                                                                    class="mdi mdi-more optiondrop_icon"></i>More</a>
                                                    </li>
                                                    <li>
                                                        <a id="{{$ad->id}}"
                                                           onclick="ShowConformationPopupMsg('Are You Sure To delete this record.');"
                                                           class="border_none btnDelete"><i
                                                                    class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a>
                                                    </li>
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
        <div id="Modal_NewAdd" class="modal fade" data-easein="bounceIn" role="dialog">
            {!! Form::open(['url' => 'buys', 'class' => 'form-horizontal', 'id'=>'user_master', 'files'=>true]) !!}
            <div class="modal-dialog survey_model">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                onclick="GloCloseModel();">&times;</button>
                        <h4 class="modal-title">Add New Advertisement</h4>
                    </div>
                    <div class="modal-body" id="Add_newAdvertise">
                        <div class="basic_lb_row">
                            <div class="col-sm-3">
                                <div class="Lb-title-txt" id="_TypeName">Advertise Title :</div>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control required" placeholder="Enter title"
                                       data-validate="Btn_advertise"
                                       maxlength="250" autocomplete="off">
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-3">
                                <div class="Lb-title-txt" id="_TypeName">Advertise Type :</div>
                            </div>
                            <div class="col-sm-9">
                                <?php  $cats = \App\AdCategory::GetCategoryDropdown(); ?>
                                {!! Form::select('ddcategory', $cats, null,['class' => 'form-control requiredDD']) !!}
                            </div>
                        </div>
                        <div class="basic_lb_row other_hide" id="adver_otherbox">
                            <div class="col-sm-3">
                                <div class="Lb-title-txt" id="_TypeName">Other Category :</div>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="other" class="form-control" placeholder="Enter Category"
                                       data-validate="Btn_advertise"
                                       maxlength="250" autocomplete="off">
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-3">
                                <div class="Lb-title-txt" id="_TypeDesc">Advertise Details :</div>
                            </div>
                            <div class="col-sm-9">
                         <textarea cols="1" rows="4" name="add_details" class="form-control txt_resize required"
                                   placeholder="Enter Details"
                                   data-validate="Btn_advertise" maxlength="500"></textarea>
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-3">
                                <div class="Lb-title-txt" id="_TypeName">City :</div>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="city" class="form-control required" placeholder="Enter City"
                                       data-validate="Btn_advertise"
                                       maxlength="250" autocomplete="off">
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-3">
                                <div class="Lb-title-txt">Upload Image :</div>
                            </div>
                            <div class="col-sm-9">
                                <div class="com-block file_upload_box">
                                    <input type="file" name="ad_img" accept=".png,.jpg, .jpeg, .gif" class="file_upload"
                                           id="advertise_Image"
                                           onchange="ShowAdverImage(this, adver_uploadimg, advertise_close);"/>
                                    <div class="view-uploaded-file">
                                        <img src="{{url('images/NoPreview_Img.png')}}" id="adver_uploadimg">
                                        <div class="upload_imgclose mdi mdi-close" id="advertise_close"
                                             onclick="RemoveAdvertise(this, adver_uploadimg, advertise_Image)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{--<button type="submit" class="btn btn-primary" data-dismiss="modal">Submit</button>--}}
                        {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                            Close
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>

    {{--@if(session()->has('message'))--}}
        {{--<script type="text/javascript">--}}
            {{--setTimeout(function () {--}}
                {{--ShowSuccessPopupMsg('{{ session()->get('message') }}');--}}
            {{--}, 500);--}}
        {{--</script>--}}
    {{--@endif--}}
    <script type="text/javascript">
        $('.btnDelete').click(function () {
                    {{--$('#ConfirmBtn').html('<a class="popup_submitbtn conformation_bg conformation_btn" href="{{ url('myads') }}/' + id +--}}
                    {{--'/delete"> Yes</a>'--}}
                    {{--);--}}
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/myads/" + id + "/delete";
            $('#ConfirmBtn').attr("href", append_url);
        });


        function GridHeaderCheck(dis) {
            $('input[type="checkbox"]').prop("checked", $(dis).prop("checked"));
        }
        function ChildGridEvent() {
            $("#CheckboxgridHead").prop("checked", false);
        }
        function MoneyTransfer() {

            if (Number($('input[name="checkboxChild"]:checked').length) == 0) {
                ShowErrorPopupMsg("Please select record first")
                return false;
            }
            var CheckIds = [];
            $('input[name="checkboxChild"]:checked').each(function () {
                CheckIds.push($(this).val());
            });
            $("#Modal_AccountDetails").modal('show');
        }
        //        $(document).ready(function () {
        //            $(function () {
        //                $('[data-toggle="tooltip"]').tooltip()
        //            });
        //        });

        function ShowAdvertiseDetails_user(dis) {
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

        function create_add() {
            globalloadershow();
            $('#Modal_NewAdd').modal('show');
            //$('.modal-title').html('Add New Advertisement');
            //$('#Add_newAdvertise').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--contentType: "application/json; charset=utf-8",--}}
                {{--url: "{{ url('buys/create') }}",--}}
                {{--success: function (data) {--}}
                    {{--$('#Add_newAdvertise').html(data);--}}
    {{--//            $('#modelBtn').visible(disabled);--}}
                {{--},--}}
                {{--error: function (xhr, status, error) {--}}
                    {{--$('#Add_newAdvertise').html(xhr.responseText);--}}
                    {{--//$('.modal-body').html("Technical Error Occured!");--}}
                {{--}--}}
            {{--});--}}
            globalloaderhide();
        }
    </script>
@stop