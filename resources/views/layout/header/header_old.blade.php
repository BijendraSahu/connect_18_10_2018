<header class="top_manubar" id="master_header_block">
    <a class="com_logo" href="{{url('dashboard')}}">
        <img src="{{url('images/logo-black.png')}}" alt="logo" class="logo_company"/>
    </a>
    <form method="GET" action="{{url('friend')}}">
        <div class="search_box">
            <input type="text" class="header_search " id="user_id" placeholder="Search your friends..."/>
            <input type="hidden" name="search" id="search_user_id">
            <i class="search_icon mdi mdi-magnify"></i>
        </div>
    </form>
    <div class="option-container">
        <div class="user-info glo_menuclick">
            <img src="{{url('').'/'.$user->profile_pic}}"/><span>{{$timeline->fname}}</span>
            <span class="caret"></span>
            <div class="menu_basic_popup menu_popup_setting effect scale0">
                <div class="menu_popup_containner padding0">
                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('dashboard')}}" class="menu_setting_row">
                            <i class="mdi mdi-home"></i>
                            Home
                        </a>
                    </div>
                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('my-profile'.'/'.$timeline->id.'/edit')}}" class="menu_setting_row">
                            <i class="mdi mdi-account-edit"></i>
                            Edit Profile
                        </a>
                    </div>
                    {{--<div class="menu_popup_settingrow effect">--}}
                    {{--<a href="#" class="menu_setting_row" onclick="Model_NewAdd();" data-toggle="modal"--}}
                    {{--data-target="#Modal_NewAdd">--}}
                    {{--<i class="mdi mdi-plus-box"></i>--}}
                    {{--Our Add--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    <div class="menu_popup_settingrow effect">
                        <a href="javascript:void(0);" class="menu_setting_row add-ouradd" id="add-Newouradd">
                            <i class="mdi mdi-plus-box"></i>
                            Our Add
                        </a>
                    </div>
                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('redeem-history')}}" class="menu_setting_row">
                            <i class="mdi mdi-currency-inr"></i>
                            Redeem History
                        </a>
                    </div>
                    {{--<div class="menu_popup_settingrow effect">--}}
                    {{--<a href="#" class="menu_setting_row">--}}
                    {{--<i class="mdi mdi-account-settings-variant"></i>--}}
                    {{--Setting--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    <div class="menu_popup_settingrow effect" onclick="update_password();" data-toggle="modal"
                         data-target="#myModal_UpdatePassword">
                        <a href="#" class="menu_setting_row">
                            <i class="mdi mdi-lock-open-outline"></i>
                            Change Password
                        </a>
                    </div>
                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('logout')}}" class="menu_setting_row">
                            <i class="mdi mdi-logout"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php $notification = \App\Notification::where(['is_active' => 1])->first();?>
        <div class="menu_basic_block glo_menuclick">
            <span class="mdi mdi-earth"></span>
            <div class="total_count">1</div>
            <div class="menu_basic_popup effect scale0 notification_popbox">
                <div class="menu_popup_head">Notification</div>
                <div class="menu_popup_containner">
                    <div class="menu_popup_row">
                        <div class="menu_popup_imgbox"><img
                                    src="{{$notification != null ? url('').'/'.$notification->admin->profile_pic: url('images/Male_default.png')}}"
                                    class="profile_img"></div>
                        <div class="menu_popup_text">
                            <p class="popup_text">{{$notification != null ?$notification->notification : "-"}}</p>
                            <div class="popup_iconwithtime"><i
                                        class="mdi mdi-calendar-clock"></i> {{date_format(date_create(\Carbon\Carbon::now()), "d-M-Y")}}
                            </div>
                        </div>
                    </div>
                    {{--<div class="menu_popup_row">--}}
                    {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
                    {{--class="profile_img"></div>--}}
                    {{--<div class="menu_popup_text">--}}
                    {{--<p class="popup_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
                    {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim--}}
                    {{--veniam,</p>--}}
                    {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
                {{--<div class="menu_popup_showall">--}}
                {{--<a href="#"> See All </a>--}}
                {{--</div>--}}
            </div>
        </div>
        <div id="request_list" class="menu_basic_block glo_menuclick">
        {{--<span class="mdi mdi-account-multiple-plus"></span>--}}
        {{--<div class="total_count">1</div>--}}
        {{--<div class="menu_basic_popup effect scale0 fr_request_popbox">--}}
        {{--<div class="menu_popup_head">Friend Requests</div>--}}
        {{--<div id="request_list" class="menu_popup_containner style-scroll">--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_request">--}}
        {{--<p class="popup_text_name">Pinku Kesharwani</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_button">--}}
        {{--<button class="btn btn-primary popup_btnrequest" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Confirm">--}}
        {{--<i class="mdi mdi-check"></i></button>--}}
        {{--<button class="btn btn-danger popup_btndelete" data-toggle="tooltip" data-placement="top"--}}
        {{--title="Delete">--}}
        {{--<i class="mdi mdi-close"></i></button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_showall">--}}
        {{--<a href="FriendRequestList.php"> See All </a>--}}
        {{--</div>--}}
        {{--</div>--}}
        <!--    <div class="notification effect">
                    <div class="short-list-h">
                        <i class="fa fa-bell"></i>Notifications
                    </div>
                    <div class="short-list-area style-scroll" id="notificationarea"><div class="notification-row"><div class="notification-c1 fa fa-comment"></div><div class="notification-c2"><p><b>6</b> new mail(s) received.</p><div class="notification-dt"><a href="frmInbox.aspx">Go To Inbox</a></div></div></div></div>
                    <div class="show-all-row">
                        <a href="AllNotification.aspx">See All Notifications</a>
                    </div>
                </div>-->
        </div>


        {{--<div class="menu_basic_block glo_menuclick">--}}
        {{--<span class="mdi mdi-email"></span>--}}
        {{--<div class="total_count" id="spanShortList">2</div>--}}
        {{--<div class="menu_basic_popup effect scale0 massage_popbox">--}}
        {{--<div class="menu_popup_head">Messages</div>--}}
        {{--<div class="menu_popup_containner style-scroll">--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
        {{--class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
        {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim--}}
        {{--veniam,--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_showall">--}}
        {{--<a href="#"> See All </a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}


    </div>
    <div class="right_option_menu" style="display: none">
        <div class="massage_box"><i class="header_icon mdi mdi-email"></i></div>
        <div class="friend_req"><i class="header_icon mdi account-multiple-plus"></i></div>
        <div class="home_notification"><i class="header_icon mdi mdi-earth"></i></div>
        <div class="profile_box">
            <div class="profile_pic">
                <img src="{{url('images/Male_default.png')}}" class="profile_img"/>
            </div>
            <div class="profile_arrow"><i class="mdi mdi-menu-down"></i></div>
        </div>
    </div>
</header>
<div id="myModal_UpdatePassword" data-toggle="modal" data-easein="bounceIn" class="connect_LBbox modal fade in"
     role="dialog"
     aria-hidden="false">
    <div class="modal-dialog forgotpass_lb">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="GloCloseModel();">×</button>
                <h4 class="modal-title">UPDATE PASSWORD ?</h4>
            </div>
            <div class="modal-body">
                <div class="basic_lb_row">
                    <input type="text" class="form-control forgot_txt" placeholder="Old Password"
                           id="txtChange_previousPsd" autocomplete="off" data-validate="TT_btnChangepass">
                    <div class="forgot_icon"><i class="mdi mdi-lock mdi-16px"></i></div>
                    {{--<input type="hidden" value="{{$user->password}}" id="cpswd">--}}
                </div>
                <div class="basic_lb_row">
                    <input type="text" class="form-control forgot_txt" placeholder="New Password" id="txtchange_newPsd"
                           autocomplete="off" name="newpassword" data-validate="TT_btnChangepass">
                    <div class="forgot_icon"><i class=" mdi mdi-lock-open-outline mdi-16px"></i></div>
                </div>
                <div class="basic_lb_row">
                    <input type="text" class="form-control forgot_txt" placeholder="Re-type Password"
                           id="txtchange_retypePsd" name="confirmpassword" autocomplete="off"
                           data-validate="TT_btnChangepass">
                    <div class="forgot_icon"><i class=" mdi mdi-lock-open-outline mdi-16px"></i></div>
                </div>
                <p class="statusMsg"></p>
            </div>
            <div class="modal-footer text-center">
                <button type="button" onclick="submitChange();" class="btn btn-primary" id="TT_btnChangepass">Update
                </button>
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
                <button type="button" class="close" data-dismiss="modal" onclick="GloCloseModel();">&times;</button>
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
                        <input type="text" name="other" class="form-control required" placeholder="Enter Category"
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
                            <input type="file" accept=".png,.jpg, .jpeg, .gif" class="file_upload" name="ad_img" id="advertise_Image"
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
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">Close
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{{--/*************Pinku 13_03***************/--}}
<div class="modal popup_bgcolor" id="conformation_popup">
    <div class="popup_box">
        <div class="alert_popup conformation_bg">
            <div class="popup_verified"><i class="mdi mdi-close"></i></div>
            <h4 class="popup_mainhead">Confirmation Massage!</h4>
            <p class="popup-text dynamic_popuptxt">Do you really want to delete this record.t</p>
        </div>
        <div class="popup_submit">
            <a class="popup_submitbtn conformation_bg conformation_btn" type="submit" id="ConfirmBtn"
               onclick="HidePopoupMsg();">Yes
            </a>
            <a class="popup_submitbtn conformation_nobtn" type="submit" onclick="HidePopoupMsg();">No</a>
        </div>
    </div>
</div>
<div id="Modal_AccountDetails" class="modal fade" data-easein="bounceIn" role="dialog">
    <div class="modal-dialog survey_model">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="GloCloseModel();">&times;</button>
                <h4 class="modal-title">Account Details</h4>
            </div>
            <div class="modal-body ">
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Previous Account :</div>
                    </div>
                    <div class="col-sm-9">
                        <div class="account_exist" onclick="ShowPrevAccDetails(this);">Allbd1245021259
                            <input type="hidden" class="hidden_acc_name" value="Sachin Mahra"/>
                            <input type="hidden" class="hidden_acc_no" value="Allbd1245021259"/>
                            <input type="hidden" class="hidden_acc_bank" value="Allahabad Bank"/>
                            <input type="hidden" class="hidden_acc_ifs" value="All52154123"/>
                            <input type="hidden" class="hidden_acc_amount" value="100.00"/>
                        </div>
                        <div class="account_exist Account_selected" onclick="ShowPrevAccDetails(this);">PNB120152012
                            <input type="hidden" class="hidden_acc_name" value="Pinku Kesharwani"/>
                            <input type="hidden" class="hidden_acc_no" value="PNB120152012"/>
                            <input type="hidden" class="hidden_acc_bank" value="Punjab National Bank"/>
                            <input type="hidden" class="hidden_acc_ifs" value="PNB52154123"/>
                            <input type="hidden" class="hidden_acc_amount" value="50.00"/>
                        </div>
                        <div class="account_new" onclick="HidePrevAccDetails();"><i class="mdi mdi-plus"></i>New Account
                        </div>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Account Holder :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_name" type="text" class="form-control"
                               placeholder="Enter Account Holder Name" data-validate="Btn_AccountDetails"
                               maxlength="250" autocomplete="off">
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Account Number :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_no" type="text" class="form-control" placeholder="Enter Account No."
                               data-validate="Btn_AccountDetails" maxlength="50" autocomplete="off">
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeDesc">Bank :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_bank" type="text" class="form-control" placeholder="Enter Bank Name"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off"/>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">IFSC Code :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_ifs" type="text" class="form-control" placeholder="Enter Bank IFSC Code"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off"/>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Amount :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_amt" type="text" class="form-control" placeholder="Enter Amount"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off"/>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Aadhar/PAN :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_amt" type="text" class="form-control" placeholder="Enter Aadhar/PAN"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off"/>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Future Used :</div>
                    </div>
                    <div class="col-sm-9">
                        <div class="checkbox glo_checkbox_mainbox " style="text-align: left;">
                            <div class="overlay_checkbox display_none"></div>
                            <label>
                                <input class="glo_checkbox" type="checkbox" id="Checkboxfuturesave">
                                <span class="cr"><i class="cr-icon mdi mdi-check"></i></span>
                                <span class="checkbox_txt"> Account Details Save For Future Used</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="Btn_AccountDetails">Submit
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">Close
                </button>
            </div>
        </div>

    </div>
</div>
{{---------------Update by pinku 03_04_18--}}
<div class="animate_announcement" id="announcement">
    <div class="Announce_txt" id="annouce_txt">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
    </div>
    <div class="close_announce mdi mdi-cross" onclick="HideAnnouncement();">x</div>
</div>
<!-----------Like List Popup ------>
<div class="modal fade-scale" id="Modal_ViewLikeList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog likelist_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Like List</h4>
            </div>
            <div class="modal-body" id="mdlbody">
                {{--<div class="news_containner like_containner style-scroll">--}}
                {{--<div class="col-xs-6 person_block">--}}
                {{--<div class="image_with_name">--}}
                {{--<div class="post_imgblock like_imgbox">--}}
                {{--<img src="images/Frount_userpic1.jpeg">--}}
                {{--</div>--}}
                {{--<div class="posted_name like_name">Pinku kesharwani</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-6 person_block">--}}
                {{--<div class="image_with_name">--}}
                {{--<div class="post_imgblock like_imgbox">--}}
                {{--<img src="images/Frount_userpic2.jpeg">--}}
                {{--</div>--}}
                {{--<div class="posted_name like_name">Bijendra Sahu</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-6 person_block">--}}
                {{--<div class="image_with_name">--}}
                {{--<div class="post_imgblock like_imgbox">--}}
                {{--<img src="images/Frount_userpic4.jpeg">--}}
                {{--</div>--}}
                {{--<div class="posted_name like_name">Amit Sharma</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-xs-6 person_block">--}}
                {{--<div class="image_with_name">--}}
                {{--<div class="post_imgblock like_imgbox">--}}
                {{--<img src="images/Male_default.png">--}}
                {{--</div>--}}
                {{--<div class="posted_name like_name">Ashish Pawar</div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{--/*************Pinku 13_03***************/--}}
<script type="text/javascript">
        <?php $userlist = \Illuminate\Support\Facades\DB::select("SELECT u.id as id, (SELECT name from timelines t WHERE u.timeline_id = t.id) as name, u.profile_pic as icon FROM users u"); ?>

    var options = {
            data: [@foreach($userlist as $item)
            {
                id: "{{$item->id}}", name: "{{$item->name}}", icon: "{{url('').'/'.$item->icon}}"
            },
                @endforeach
            ],
            getValue: 'name',
            template: {
                type: "iconLeft",
                fields: {
                    iconSrc: "icon"
                }
            }
        };

    $("#user_id").easyAutocomplete(options);


    $(document).ready(function () {

    });
    function requestlist() {
        var formData = '_token=' + $('.token').val();
        var search_user_id = $('.search-user').val();
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('requestlist') }}",
//                data: '{"data":"' + endid + '"}',
            data: '{"formData":"' + formData + '", "search_user_id":"' + search_user_id + '"}',
            success: function (data) {
//                    console.log(data);
                $("#request_list").html(data);

//                        console.log(data);
//                    ShowSuccessPopupMsg("Request has been cancelled");
            },
            error: function (xhr, status, error) {
//                    alert('xhr.responseText');
//                    $('#errorall').html(xhr.responseText);
            }
        });
    }

    requestlist();
    setInterval(requestlist, 9000);

    {{--$(document).on('focus', '.auto-text', function () {--}}
    {{--$(this).autocomplete({--}}
    {{--source: '{{url('getfriend')}}/1',--}}
    {{--minLength: 1,--}}
    {{--autoFocus: true,--}}
    {{--select: function (e, ui) {--}}
    {{--//                console.log(ui);--}}
    {{--id_arr = $(this).attr('id');--}}
    {{--id = id_arr.split("_");--}}
    {{--//                $('#itemId_' + id[1]).val(ui.item.id);--}}
    {{--$('#user_id').val(ui.item.uname);--}}
    {{--$('#search_user_id').val(ui.item.uid);--}}
    {{--}--}}
    {{--});--}}
    {{--});--}}
    function submitChange() {
//        var cpassword = $('#cpswd').val();
        var oldpassword = $('#txtChange_previousPsd').val();
        var newpassword = $('#txtchange_newPsd').val();
        var confirmpassword = $('#txtchange_retypePsd').val();
        var formData = '_token=' + $('.token').val();
        if (newpassword.trim() == '') {
//            alert('Please enter your rc.');

//            $('.rcode').focus();
            return false;
        } else if (confirmpassword.trim() == '') {
            return false;
        } else if (confirmpassword.trim() != newpassword.trim()) {
            alert('Password Mismatch');
            return false;
        } else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('change_password') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "newpassword":"' + newpassword + '", "confirmpassword":"' + confirmpassword + '", "oldpassword":"' + oldpassword + '"}',
                success: function (data) {
                    if (data == 'ok') {
//                        console.log(data);
                        $('#txtChange_previousPsd').val('');
                        $('#txtchange_newPsd').val('');
                        $('#txtchange_retypePsd').val('');
                        ShowSuccessPopupMsg('Password changed successfully');
                        $('#myModal_UpdatePassword').modal('toggle');

//                        $('.statusMsg').html('<span style="color:green;">Password changed successfully</p>');
                    } else if (data == 'Incorrect') {
                        $('#txtChange_previousPsd').val('');
                        ShowErrorPopupMsg('Incorrect current password');
//                        $('.statusMsg').html('<span style="color:red;">Incorrect current password</span>');
                    }
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    $("#add-Newouradd").click(function () {
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
    });
</script>

