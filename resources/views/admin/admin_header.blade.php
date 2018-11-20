<nav class="top_navigationbar">
    <a class="logo_block" href="{{url('home')}}">
        <img src="{{url('images/logo.png')}}"/>
    </a>
    <div class="dash_menuicon" onclick="ResponsiveMenuClick();"><i class="mdi mdi-menu"></i>
    </div>
    <div class="option-container">
        <div class="user-info glo_menuclick_admin coloruser">
            <!-- <img src="images/Male_default.png" class="profile_img">--><span>{{isset($user)?$user->name:""}}</span>
            <span class="caret"></span>
            <div class="menu_basic_popup menu_popup_setting effect scale0">
                <div class="menu_popup_containner padding0">
                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('admin-profile')}}" class="menu_setting_row">
                            <i class="mdi mdi-account-edit global_color"></i>
                            Edit Profile
                        </a>
                    </div>
                    {{--<div class="menu_popup_settingrow effect">--}}
                    {{--<a href="#" class="menu_setting_row">--}}
                    {{--<i class="mdi mdi-account-settings-variant global_color"></i>--}}
                    {{--Setting--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    <div class="menu_popup_settingrow effect" data-toggle="modal" onclick="update_passwordAdmin();"
                         data-target="#myModal_UpdatePasswordAdmin">
                        <a href="#" class="menu_setting_row">
                            <i class="mdi mdi-lock-open-outline global_color"></i>
                            Change Password
                        </a>
                    </div>

                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('lgt')}}" class="menu_setting_row">
                            <i class="mdi mdi-logout global_color"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="menu_basic_block glo_menuclick_admin">--}}
        {{--<span class="mdi mdi-earth global_color"></span>--}}
        {{--<div class="total_count">5</div>--}}
        {{--<div class="menu_basic_popup effect scale0 notification_popbox">--}}
        {{--<div class="menu_popup_head">Notification</div>--}}
        {{--<div class="menu_popup_containner">--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_text">--}}
        {{--<p class="popup_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
        {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim--}}
        {{--veniam,</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock global_color"></i>--}}
        {{--28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_text">--}}
        {{--<p class="popup_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
        {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim--}}
        {{--veniam,</p>--}}
        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock global_color"></i>--}}
        {{--28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_showall">--}}
        {{--<a href="#"> See All </a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_basic_block glo_menuclick_admin">--}}
        {{--<span class="mdi mdi-email global_color"></span>--}}
        {{--<div class="total_count" id="spanShortList">2</div>--}}
        {{--<div class="menu_basic_popup effect scale0 massage_popbox">--}}
        {{--<div class="menu_popup_head">Messages</div>--}}
        {{--<div class="menu_popup_containner style-scroll">--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i--}}
        {{--class="mdi mdi-calendar-clock global_color"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i--}}
        {{--class="mdi mdi-calendar-clock global_color"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i--}}
        {{--class="mdi mdi-calendar-clock global_color"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i--}}
        {{--class="mdi mdi-calendar-clock global_color"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i--}}
        {{--class="mdi mdi-calendar-clock global_color"></i> 28-Dec-2017--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="popup_user_massagetxt">--}}
        {{--Lorem ipsum dolor sit amet, consectetur--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="menu_popup_row">--}}
        {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}" class="profile_img"></div>--}}
        {{--<div class="menu_popup_massage">--}}
        {{--<div class="popup_user_namewithdate">--}}
        {{--Pinku Kesharwani--}}
        {{--<div class="popup_iconwithtime_right"><i--}}
        {{--class="mdi mdi-calendar-clock global_color"></i> 28-Dec-2017--}}
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
</nav>
<aside class="dash_sidemenu">
    <div class="dash_emp_details">
        @if(isset($user))
            <img src="{{url('').'/'.$user->profile_pic}}" class="dash_profile_img"/>
        @endif
        <div class="dash_emp_basic">
            <span class="dash_name global_color">{{isset($user)?$user->name:'-'}}</span>
            <span class="dash_designation">{{isset($user)?$user->designation:'-'}}</span>
        </div>
    </div>
    <ul class="list-group dash_menu_ul">
        <li class="right_menu_li">
            <a href="{{url('home')}}">
                <span class="dash_arrow mdi mdi-speedometer global_color"></span>
                Dashboard
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('notificn')}}">
                <span class="dash_arrow mdi mdi-email global_color"></span>
                Notification
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('advertisement')}}">
                <span class="dash_arrow mdi mdi-chemical-weapon global_color"></span>
                Admin Ads
            </a>
        </li>
        <li class="right_menu_li" onclick="MenuClick(this);">
            <a href="javascript:;">
                <span class="dash_arrow mdi mdi-sitemap  global_color"></span>
                Users
                <i class="mdi mdi-chevron-right icon-left-arrow"></i>
            </a>
            <ul class="list-group dash_sub_menu">
                <li>
                    <a href="{{url('regs')}}">
                        All Users
                    </a>
                </li>
                <li>
                    <a href="{{url('freeregs')}}">
                        Free Users
                    </a>
                </li>
                <li>
                    <a href="{{url('paidregs')}}">
                        Paid Users
                    </a>
                </li>

            </ul>
        </li>

        @php
            $ads_request = \App\Ads::where(['status'=>'Pending'])->count();
        @endphp
        <li class="right_menu_li">
            <a href="{{url('ads')}}">
                <span class="dash_arrow mdi mdi-cart-outline global_color"></span>
                Ads Request List <span class="badge">{{$ads_request>0?$ads_request:''}}</span>
            </a>
        </li>

        <li class="right_menu_li">
            <a href="{{url('clsads')}}">
                <span class="dash_arrow mdi mdi-access-point global_color"></span>
                Clicks Ads List
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('redeems')}}">
                <span class="dash_arrow mdi mdi-comment-account-outline global_color"></span>
                Redeem Requests
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('getpaytmlist')}}">
                <span class="dash_arrow mdi mdi-comment-account-outline global_color"></span>
                Paytm Link
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('products')}}">
                <i class="dash_arrow mdi mdi-credit-card-multiple global_color"></i>
                Products
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('orders')}}">
                <span class="dash_arrow mdi mdi-comment-account-outline global_color"></span>
                Orders
            </a>
        </li>

        <li class="right_menu_li">
            <a href="{{url('affiliateslist')}}">
                <span class="dash_arrow mdi mdi-comment-account-outline global_color"></span>
                Affiliates
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('report_post')}}">
                <span class="dash_arrow mdi mdi-comment-account-outline global_color"></span>
                Report Posts
            </a>
        </li>
        <li class="right_menu_li">
            <a href="{{url('survey')}}">
                <span class="dash_arrow mdi mdi-comment-account-outline global_color"></span>
                Survey
            </a>
        </li>

        {{--<li class="right_menu_li" onclick="MenuClick(this);">--}}
        {{--<a href="javascript:;">--}}
        {{--<i class="dash_arrow mdi mdi-sitemap  global_color"></i>--}}
        {{--Admin--}}
        {{--<i class="mdi mdi-chevron-right icon-left-arrow"></i>--}}
        {{--</a>--}}
        {{--<ul class="list-group dash_sub_menu">--}}
        {{--<li>--}}
        {{--<a href="{{url('notification')}}">Notification</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="{{url('regs')}}">Registrations</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="{{url('advertisement')}}">Advertisement List</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="{{url('ads')}}">Redeem Requests</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--<li class="right_menu_li"  onclick="MenuClick(this);">--}}
        {{--<a href="javascript:;">--}}
        {{--<i class="dash_arrow mdi mdi-sitemap  global_color"></i>--}}
        {{--Advertisement--}}
        {{--<i class="mdi mdi-chevron-right icon-left-arrow"></i>--}}
        {{--</a>--}}
        {{--<ul class="list-group dash_sub_menu">--}}

        {{--<li>--}}
        {{--<a href="{{url('ads')}}">Admin Advertisement</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="{{url('ads')}}">Clicks Advertisement</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--<li class="right_menu_li"  onclick="MenuClick(this);">--}}
        {{--<a href="javascript:;" class="waves-effect waves-block">--}}
        {{--<i class="dash_arrow mdi mdi-sitemap  global_color"></i>--}}
        {{--Option menu 3--}}
        {{--<i class="mdi mdi-chevron-right icon-left-arrow"></i>--}}
        {{--</a>--}}
        {{--<ul class="list-group dash_sub_menu">--}}
        {{--<li>--}}
        {{--<a href="ClientList.aspx">Option Manu List 1</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="ClientList.aspx">Option Manu List 2</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--<li class="right_menu_li"  onclick="MenuClick(this);">--}}
        {{--<a href="javascript:;">--}}
        {{--<i class="dash_arrow mdi mdi-sitemap global_color"></i>--}}
        {{--Option menu 4--}}
        {{--<i class="mdi mdi-chevron-right icon-left-arrow"></i>--}}
        {{--</a>--}}
        {{--<ul class="list-group dash_sub_menu">--}}
        {{--<li>--}}
        {{--<a href="ClientList.aspx">Option Manu List 1</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="ClientList.aspx">Option Manu List 2</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</li>--}}
    </ul>
</aside>
<div id="myModal_UpdatePasswordAdmin" data-toggle="modal" data-easein="bounceIn" class="connect_LBbox modal fade"
     role="dialog" aria-hidden="false">
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
                <button type="button" onclick="submitChangeAdmin();" class="btn btn-primary" id="TT_btnChangepass">
                    Update
                </button>
            </div>
        </div>

    </div>
</div>
<script>
    function update_passwordAdmin() {
        $('#myModal_UpdatePasswordAdmin').addClass('in');
        $('#myModal_UpdatePasswordAdmin').show();
        $('body').append(append_this);
        $('body').addClass('modal-open');
    }
    function GloCloseModel() {
        $('#Modal_NewAdd').hide();
        $('#myModal_UpdatePasswordAdmin').hide();
        $('#Modal_NewAdd').removeClass('in');
        $('#myModal_UpdatePasswordAdmin').removeClass('in');
        $('body').removeClass('modal-open');
        var thisbox = $('body').find('.modal-backdrop');
        $(thisbox).remove();
    }
    function submitChangeAdmin() {
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
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('admin_cp') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "newpassword":"' + newpassword + '", "confirmpassword":"' + confirmpassword + '", "oldpassword":"' + oldpassword + '"}',
                success: function (data) {
                    if (data == 'ok') {
                        console.log(data);
                        $('#txtChange_previousPsd').val('');
                        $('#txtchange_newPsd').val('');
                        $('#txtchange_retypePsd').val('');
                        ShowSuccessPopupMsg('Password changed successfully');
                        $('#myModal_UpdatePasswordAdmin').modal('toggle');

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
</script>