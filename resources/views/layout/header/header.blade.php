<header class="top_manubar" id="master_header_block">
    <a class="com_logo" href="{{url('dashboard')}}">
        <img src="{{url('images/logo-black.png')}}" alt="logo" class="logo_company"/>
        {{--        <img src="{{url('images/logo_small.png')}}" alt="logo" class="logo_company_small"/>--}}
    </a>
    {{--    <form method="GET" action="{{url('friend')}}">--}}
    <div class="search_box">
        <input type="text" class="header_search" id="user_id" autocomplete="off" placeholder="Search your friends..."
               onkeyup="HeaderSearchFilter(this);"/>
        <input type="hidden" name="search" id="search_user_id">
        <i class="search_icon mdi mdi-magnify"></i>
        <div class="search_filter_box scale0">
            <div class="no_record_found hidden" id="no_record">
                < No Friend Found >
            </div>
            <ul class="filter_search_ul style-scroll" id="filter_friend_ul">

            </ul>
        </div>
    </div>
    {{--</form>--}}
    <div class="option-container">
        <div class="user-info glo_menuclick">
            <input type="hidden" value="{{$user->id}}" id="session_user">
            <img src="{{url('').'/'.$user->profile_pic}}"/>
            @if($user->member_type=='paid')
                <svg viewBox="0 0 24 24" data-toggle="tooltip"
                     data-placement="bottom" title="Paid User" class="paid_img">
                    <path fill="#ffffff"
                          d="M9.04,21.54C10,21.83 10.97,22 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2A10,10 0 0,0 2,12C2,16.25 4.67,19.9 8.44,21.34C8.35,20.56 8.26,19.27 8.44,18.38L9.59,13.44C9.59,13.44 9.3,12.86 9.3,11.94C9.3,10.56 10.16,9.53 11.14,9.53C12,9.53 12.4,10.16 12.4,10.97C12.4,11.83 11.83,13.06 11.54,14.24C11.37,15.22 12.06,16.08 13.06,16.08C14.84,16.08 16.22,14.18 16.22,11.5C16.22,9.1 14.5,7.46 12.03,7.46C9.21,7.46 7.55,9.56 7.55,11.77C7.55,12.63 7.83,13.5 8.29,14.07C8.38,14.13 8.38,14.21 8.35,14.36L8.06,15.45C8.06,15.62 7.95,15.68 7.78,15.56C6.5,15 5.76,13.18 5.76,11.71C5.76,8.55 8,5.68 12.32,5.68C15.76,5.68 18.44,8.15 18.44,11.43C18.44,14.87 16.31,17.63 13.26,17.63C12.29,17.63 11.34,17.11 11,16.5L10.33,18.87C10.1,19.73 9.47,20.88 9.04,21.57V21.54Z"/>
                </svg>
            @endif
            <span>{{$timeline->fname}}</span>
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
                        <a href="{{url('myprofile')}}" class="menu_setting_row">
                            <i class="mdi mdi-account-edit"></i>
                            Edit Profile
                        </a>
                    </div>

                    <div class="menu_popup_settingrow effect">
                        <a href="{{url('redeem-history')}}" class="menu_setting_row">
                            <i class="mdi mdi-currency-inr"></i>
                            Redeem History
                        </a>
                    </div>
                    <div class="menu_popup_settingrow effect">
                        <a href="#" onclick="privacy_setting();" class="menu_setting_row">
                            <i class="mdi mdi-account-key"></i>
                            Privacy Setting
                        </a>
                    </div>
                    <div class="menu_popup_settingrow effect" onclick="update_password();" data-toggle="modal"
                         data-target="#myModal_UpdatePassword">
                        <a href="#" class="menu_setting_row">
                            <i class="mdi mdi-lock-open-outline"></i>
                            Change Password
                        </a>
                    </div>

                    <div class="menu_popup_settingrow effect" onclick="deactivate_account()">
                        <a href="#" class="menu_setting_row">
                            <i class="mdi mdi-account-off"></i>
                            Deactivate Account
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
        <div id="notificationlist" class="menu_basic_block glo_menuclick">

        </div>
        <div id="request_list" class="menu_basic_block glo_menuclick">

        </div>
        <a href="{{url('dashboard')}}" id="home_menu" class="menu_basic_block">
            <span class="mdi mdi-home"></span>
        </a>
        {{--<div id="messagelist" class="menu_basic_block glo_menuclick">--}}

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
                    <input type="password" class="form-control forgot_txt" placeholder="Old Password"
                           id="txtChange_previousPsd" minlength="4" maxlength="25" autocomplete="off"
                           data-validate="TT_btnChangepass">
                    <div class="forgot_icon"><i class="mdi mdi-lock mdi-16px"></i></div>
                    {{--<input type="hidden" value="{{$user->password}}" id="cpswd">--}}
                </div>
                <div class="basic_lb_row">
                    <input type="password" class="form-control forgot_txt" placeholder="New Password"
                           id="txtchange_newPsd"
                           autocomplete="off" minlength="4" maxlength="25" name="newpassword"
                           data-validate="TT_btnChangepass">
                    <div class="forgot_icon"><i class=" mdi mdi-lock-open-outline mdi-16px"></i></div>
                </div>
                <div class="basic_lb_row">
                    <input type="password" class="form-control forgot_txt" placeholder="Re-type Password"
                           id="txtchange_retypePsd" minlength="4" maxlength="25" name="confirmpassword"
                           autocomplete="off"
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

{{--/*************Pinku 13_03***************/--}}
<div class="modal popup_bgcolor" id="conformation_popup">
    <div class="popup_box">
        <div class="alert_popup conformation_bg">
            <div class="popup_verified"><i class="mdi mdi-close"></i></div>
            <h4 class="popup_mainhead">Confirmation Massage!</h4>
            <p class="popup-text dynamic_popuptxt">Do you really want to delete this record</p>
        </div>
        <div class="popup_submit">
            <a class="popup_submitbtn conformation_bg conformation_btn" type="submit" id="ConfirmBtn"
               onclick="HidePopoupMsg();">Yes
            </a>
            <a class="popup_submitbtn conformation_nobtn" id="cancelconfirm" type="submit"
               onclick="HidePopoupMsg();">No</a>
        </div>
    </div>
</div>
<!-- #1 -->
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
                        <span class="acc_qa"></span>
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
                               maxlength="250" autocomplete="off" required>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Account Number :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_no" type="text" class="form-control" placeholder="Enter Account No."
                               data-validate="Btn_AccountDetails" maxlength="50" autocomplete="off" required>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeDesc">Bank :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_bank" type="text" class="form-control" placeholder="Enter Bank Name"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off" required/>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">IFSC Code :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_ifs" type="text" class="form-control" placeholder="Enter Bank IFSC Code"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off" required/>
                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Amount :</div>
                    </div>
                    @php
                        $com = new \App\com();
                    $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $user->id)->get();
                    // Sum up all earnings
                    $total = 0;
                    foreach ($getTotalEarningsByPID as $Ttl) {
                        $total = $total + $Ttl->Com;
                    }
                    @endphp
                    <div class="col-sm-9 max_amt_show">
                        <input id="acc_lbtxt_amt" type="text" class="form-control" placeholder="Enter Amount"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off" required/>
                        <div class="curr_earning">Request Amout less than or equal Rs. <span
                                    id="current_val">{{$total}}</span></div>

                    </div>
                </div>
                <div class="basic_lb_row">
                    <div class="col-sm-3">
                        <div class="Lb-title-txt" id="_TypeName">Aadhar/PAN :</div>
                    </div>
                    <div class="col-sm-9">
                        <input id="acc_lbtxt_adhr" type="text" class="form-control" placeholder="Enter Aadhar/PAN"
                               data-validate="Btn_AccountDetails" maxlength="100" autocomplete="off" required/>
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
                <div class="err_aex"></div>
            </div>
            <div class="modal-footer">
                <!--button type="button" class="btn btn-primary" data-dismiss="modal" id="Btn_AccountDetails"-->
                <button type="button" class="btn btn-primary" id="Btn_AccountDetails">Submit
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">Close
                </button>
            </div>
        </div>

    </div>
</div>

{{---------------Update by Bijendra 03_04_18--}}
@php $nnofication = \App\Notification::find(1); @endphp
<div class="animate_announcement" id="announcement">
    <div class="Announce_image" id="annouce_image">
        <img src="{{url('').'/'.$nnofication->image}}">
    </div>
    <div class="Announce_txt" id="annouce_txt">{{$nnofication->notification}}
    </div>
    <div class="close_announce mdi mdi-cross" onclick="HideAnnouncement();">x</div>
</div>
<!-----------Like List Popup ------>
<div class="modal fade-scale" style="z-index: 1055" id="Modal_ViewLikeList" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog likelist_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Like List</h4>
            </div>
            <div class="modal-body" id="mdlbody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="snackbar">You have one new notification</div>
<audio controls id="alert_tone" class="audio_noti">
    <source src="" type="audio/mpeg">
</audio>
{{--/*************Bijendra 02_10***************/--}}
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
{{--<script src="//js.pusher.com/3.1/pusher.min.js"></script>--}}
<script type="text/javascript">

    function deactivate_account() {
        var user_id = '{{$_SESSION['user_master']->id}}';
        swal({
            title: "Confirmation",
            text: "Are you sure you want to deactivate your account?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((okk) => {
                if (okk) {
                    $.ajax({
                        type: "get",
                        contentType: "application/json; charset=utf-8",
                        url: "{{ url('deactivate_account') }}",
                        data: {user_id: user_id},
                        success: function (data) {
                            if (jQuery.parseJSON(data).response == "Account has been deactivated") {
                                window.location.href = '{{url('/')}}';
                            }
//                            alert(jQuery.parseJSON(data).response);
                            success_noti(jQuery.parseJSON(data).response);
//                            swal("Success!", jQuery.parseJSON(data).response, "success");
//                            setTimeout(function () {
//                            }, 2000);
                        },
                        error: function (xhr, status, error) {
//                            alert(error);
//                            console.log(xhr.responseText);
                            swal("Server Issue", "Something went wrong", "info");

                        }
                    });
                }

            }
        );
    }

    function get_alert_sound() {
        var audio = document.getElementById("alert_tone");
        audio.src = '{{url('alert_tone/success.mp3')}}';
        audio.play();
    }
    function getNotificationMsg() {
        get_alert_sound();
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 5000);
    }
    var pusher = new Pusher('a6ab632500510572d965', {
        encrypted: true
    });

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('status-liked');

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\StatusLiked', function (data) {
        var session_user_id = '{{$user->id}}';
        if (data.username == session_user_id) {
            getNotificationMsg();
            notificationlist();
        }
    });

</script>
<script type="text/javascript">

    function privacy_setting() {
        $('#myModal').modal('show');
        $('#modal_title').html('Privacy Setting');
        $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
        var editurl = '{{ url('/') }}' + "/privacy_setting";
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: editurl,
            success: function (data) {
                $('#modal_body').html(data);
            },
            error: function (xhr, status, error) {
                $('#modal_body').html(xhr.responseText);
                //$('.modal-body').html("Technical Error Occured!");
            }
        });
    }
    /****************************Hide once click in a day*******************************/
    function HideAnnouncement() {
        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('notification_click') }}",
            success: function (data) {
                $('#announcement').removeClass('animate_announcement_show');
            },
            error: function (xhr, status, error) {
                $('#annouce_txt').html(xhr.responseText);
            }
        });
    }
    /****************************Hide once click in a day*******************************/
    var srch_lgt = $('#user_id').val();
    var srch_prev_lgt = srch_lgt;

    function HeaderSearchFilter(dis) {
        var ser_val = $(dis).val().length;
        var text = $(dis).val();
        var session_user = $('#session_user').val();
        if (ser_val > 0) {
            if (text != srch_prev_lgt) {
                srch_prev_lgt = text;
                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('getsfriend') }}",
                    data: {search_name: text},
                    success: function (data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj.length > 0) {
                            var listItems = '';
                            for (var i = 0; i < obj.length; i++) {
                                var url = obj[i].profile_pic;
                                var user_id = obj[i].id;
                                var user_name = obj[i].name;
                                var surl = (session_user != user_id) ? '{{url('friend?search=')}}' + user_id : '{{url('my-profile')}}';
                                listItems += "<li class='header_filter_row'><a href='" + surl + "'><div onclick='gettext(" + user_name + ");' ><img src='{{url('').'/'}}" + url + "' class='head_filter_img'/><div class='name_filter'>" + user_name + "</div></div></a></li>";
                            }
                            $("#filter_friend_ul").html(listItems);
                            $('#no_record').addClass('hidden');
                        } else {
                            $("#filter_friend_ul").html('');
                            $('#no_record').removeClass('hidden');
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#filter_friend_ul').html(xhr.responseText);
                    }
                });
            }
            $(dis).parent().find('.search_filter_box').removeClass('scale0');
        } else {
            $(dis).parent().find('.search_filter_box').addClass('scale0');
        }
    }

    function gettext(dis) {
        $('#user_id').val(dis);
    }

    function requestlist() {
        // var search_user_id = $('.search-user').val();
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('requestlist') }}",
            // data: '{"search_user_id":"' + search_user_id + '"}',
            success: function (data) {
                $("#request_list").html(data);
            },
            error: function (xhr, status, error) {
            }
        });
    }

    function notificationlist() {
        // var search_user_id = $('.search-user').val();
        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('notificationlist') }}",
            // data: '{"search_user_id":"' + search_user_id + '"}',
            success: function (data) {
                $("#notificationlist").html(data);
            },
            error: function (xhr, status, error) {
            }
        });
    }

    function messagelist() {
        // var search_user_id = $('.search-user').val();
        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('messagelist') }}",
            // data: '{"search_user_id":"' + search_user_id + '"}',
            success: function (data) {
                $("#messagelist").html(data);
            },
            error: function (xhr, status, error) {
            }
        });
    }

    $(document).ready(function () {
        loadallRequest();
        notificationlist();
        setInterval(loadallRequest, 15000);
    });
    function loadallRequest() {
        // messagelist();
        requestlist();
    }

    function submitChange() {
//        var cpassword = $('#cpswd').val();
        var oldpassword = $('#txtChange_previousPsd').val();
        var newpassword = $('#txtchange_newPsd').val();
        var confirmpassword = $('#txtchange_retypePsd').val();
        var formData = '_token=' + $('.token').val();
        if (oldpassword.trim() == '') {
            swal("Oops...", "Please enter old password", "info");
            return false;
        } else if (newpassword.trim() == '') {
            swal("Oops...", "Please enter new password", "info");
            return false;
        } else if (confirmpassword.trim() == '') {
            swal("Oops...", "Please enter confirmation password", "info");
            return false;
        } else if (confirmpassword.trim() != newpassword.trim()) {
            swal("Oops...", "Password Mismatch", "info");
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
                        // ShowSuccessPopupMsg('Password changed successfully');
                        swal("Success", "Password changed successfully", "success");
                        $('#myModal_UpdatePassword').modal('toggle');

//                        $('.statusMsg').html('<span style="color:green;">Password changed successfully</p>');
                    } else if (data == 'Incorrect') {
                        $('#txtChange_previousPsd').val('');
                        swal("Oops...", "Incorrect current password", "error");
                        // ShowErrorPopupMsg('Incorrect current password');
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

    $("input").on({
        keypress: function (e) {
            if (this.value.trim().length < 1) {
                if (e.which === 32)
                    return false;
            }
        },
        change: function () {
            this.value = this.value.replace(/\s/g, "");
        }
    });

</script>



