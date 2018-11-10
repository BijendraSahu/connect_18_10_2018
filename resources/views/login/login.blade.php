<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Registration Form</title>
    <!--Favicon-->
    <link rel="shortcut icon" type="images/png" href="{{ asset('images/fav.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Datepicker.js') }}"></script>
    <script src="{{ asset('js/Global.js') }}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    <!--Google Font-->
    {{--<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"/>--}}
    {{---------------Notification---------------}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('css/lobibox.min.css')}}">
    <script src="{{url('js/notifications.min.js')}}"></script>
    <script src="{{url('js/notification-custom-script.js')}}"></script>
    {{---------------Notification---------------}}
    <style type="text/css">
        .errorClass {
            border: 1px solid red !important;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
</head>
<body class="reg_body">

<div class="overlay_bg">
    <div class="container mob_pad0">

        <div class="col-sm-12 col-md-5" style="z-index: 10">
            <p id="err"></p>
            <div class="left_maintxt">
                <img src="{{ asset('images/logo.png') }}" alt="logo"/>
                <h1 class="text-white">ONE CAN CHANGE YOUR LIFE !!!</h1>
                <p class="subheading_para">{{--Connecting-One.com is a unique Earning &amp; advertising platform that brings
                    together the socially conscious members &amp; Advertisers. Members are paid for adding new members
                    by chain based earning &amp; are paid each time they check the advertiser's promotion and
                    advertisers are able to send their message to the masses at a very low cost!--}}</p>
                <div class="other_tabs">
                    <ul class="links_ul">
                        <li><a target="_blank" href="{{url('aboutus')}}">About</a></li>
                        <li><a target="_blank" href="{{url('privacy')}}">Privacy</a></li>
                        <li><a target="_blank" href="{{url('faq')}}">Faq</a></li>
                        <li><a target="_blank" href="{{url('terms')}}">Terms & Condition</a></li>
                        <li><a href="https://goo.gl/tCA2o8" target="_blank"><i class="mdi mdi-google-play"></i> Get it
                                on the Play Store</a></li>
                        <li><a href="{{'contact'}}" target="_blank"> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-7 form_maincontainner">
            <div class="Regis_Login_Form">
                <div class="form_container">
                    <div class="list-position">
                        <ul class="nav login_nav_tabs">
                            <li class="" id="regis_nav_tabs"><a href="#register" data-toggle="tab"
                                                                aria-expanded="false">Register</a></li>
                            <li class="login-btn active" id="login_nav_tabs"><a href="#login" data-toggle="tab"
                                                                                aria-expanded="true">Login</a></li>
                        </ul>
                        <!--Tabs End-->
                    </div>
                    {{--                                        {!! Form::open(['url' => 'login', 'class' => 'form-horizontal', 'id'=>'frmLogin']) !!}--}}
                    <form action="{{url('login')}}" method="post" enctype="multipart/form-data"
                          class="form-horizontal" id="frmLogin">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="basic_outerblk login_block">
                            <div class="col-sm-12">
                                <div class="login_maintxt text-center">Login to your account</div>
                            </div>
                            {{--<div class="row_block">--}}
                            {{--<div class="col-sm-6">--}}
                            {{--<a class="btn btn-block btn-social btn-facebook">--}}
                            {{--<i class="mdi mdi-facebook"></i> Sign in with Facebook--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-6">--}}
                            {{--<a class="btn btn-block btn-social btn-google-plus">--}}
                            {{--<i class="mdi mdi-google-plus"></i> Sign in with Google--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                        <input name="email_id" placeholder="Email Id*" tabindex="1"
                                               autofocus="autofocus" value="{{old('email_id')}}"
                                               class="form-control required email" type="text"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                        <input name="password" placeholder="Password*" tabindex="2" maxlength="25"
                                               class="form-control required" minlength="4"
                                               type="password" id="login_pass_show"/>
                                        <div class="view_password"
                                             onclick="ShowPassword('password_icon','login_pass_show');">
                                            <i class="mdi mdi-eye" id="password_icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="checkbox glo_checkbox_mainbox">--}}
                            {{--<label>--}}
                            {{--<input class="glo_checkbox" ty
                            pe="checkbox" id="CheckboxRemember">--}}
                            {{--<span class="cr"><i class="cr-icon mdi mdi-check"></i></span>--}}
                            {{--<span class="checkbox_txt"> Remember Password ?</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="forgot_link" tabindex="3" data-toggle="modal"
                                         data-target="#re_verify_otp_email">
                                        Verify Account <a href="#" data-toggle="tooltip" data-placement="bottom"
                                                          title="Enter otp to verify account">?</a>
                                    </div>
                                    <div class="forgot_link pull-right" tabindex="4" data-toggle="modal"
                                         data-target="#myModal_ForgotPassword">
                                        Forgot
                                        Password <a href="#" data-toggle="tooltip" data-placement="bottom"
                                                    title="Password will be send to your mobile">?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="btn_block" style="margin-top: 20px;">
                                    <button class="glo_button login_btn" tabindex="5" type="submit"
                                            id="Login_submit"></button>
                                    {{--                                    {!! Form::submit('Submit', ['class' => 'glo_button login_btn']) !!}--}}

                                </div>
                            </div>
                        </div>
                        {{--                        {!! Form::close() !!}--}}
                    </form>
                    @php
                        $states = DB::select("select * from cities where City IS NULL order by State ASC");

                    @endphp
                    {!! Form::open(['url' => 'register', 'id'=>'frmReg']) !!}
                    {{--                    <form id="frmReg" action="{{url('register')}}">--}}
                    <div class="regis_block main_scale0">
                        <div class="col-sm-12">
                            <div class="login_maintxt">Register Now !!!</div>
                            <div class="login_subtxt">Be cool and join today. Meet millions & Earn tommorrow.</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <p id="rcerr"></p>
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-account-switch mdi-16px"></i></span>
                                    <input placeholder="Referral Code" maxlength="10" id="rcode" name="rc"
                                           class="form-control vAlphabetAndNumberOnly rcode"
                                           type="text"/>
                                    {{--                                    {!! Form::text('rc', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Referal code']) !!}--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                    <input name="first_name" autocomplete="off" onpaste="return false;"
                                           placeholder="First Name*"
                                           maxlength="50"
                                           class="form-control textWithSpace fname required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                    <input name="Last_name" autocomplete="off" onpaste="return false;"
                                           placeholder="Last Name*"
                                           maxlength="50"
                                           class="form-control textWithSpace lname required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                    <input name="email_id" placeholder="Email Id*"
                                           autocomplete="off" onpaste="return false;"
                                           class="form-control email_id email required"
                                           maxlength="50" id="email_id"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-phone-log mdi-16px"></i></span>
                                    <input name="Mo_number" id="contact_no" autocomplete="off" maxlength="10"
                                           minlength="10" placeholder="Contact No*"
                                           class="form-control numberOnly contact required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-calendar-check mdi-16px"></i></span>
                                    <input name="Date_of_birth" onpaste="return false;" autocomplete="off"
                                           onkeypress="return false"
                                           placeholder="Date of Birth*"
                                           class="form-control dtp date required vRequiredText"
                                           id="date_of_birth required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                    <input type="password" name="password" autocomplete="off" maxlength="25"
                                           minlength="4" placeholder="Password*" onpaste="return false;"
                                           id="show_password"
                                           class="form-control password required"/>
                                    <div class="view_password" onclick="ShowPassword('password_icon','show_password');">
                                        <i class="mdi mdi-eye" id="password_icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                    <input type="password" name="confirm_show_password" autocomplete="off"
                                           maxlength="25" minlength="4" placeholder="Confirm Password*"
                                           onpaste="return false;"
                                           id="confirm_show_password"
                                           class="form-control password required"/>
                                    <div class="view_password"
                                         onclick="ShowPassword('password_icon','confirm_show_password');">
                                        <i class="mdi mdi-eye" id="password_icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-format-list-bulleted mdi-16px"></i></span>
                                    {{--                                    {!! Form::select('states', $states, null,['class' => 'form-control country requiredDD']) !!}--}}
                                    <select name="state" onchange="getCity(this);" id=""
                                            class="form-control country requiredDD">
                                        <option value="0">Select State</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->State}}">{{$state->State}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                    <select id="city_by_state" class="form-control">
                                        <option value="0" selected>Select City</option>
                                    </select>
                                    {{--<input name="city" placeholder="City*" onpaste="return false;" autocomplete="off"--}}
                                    {{--class="form-control city textWithSpace required" maxlength="30"--}}
                                    {{--type="text"/>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="radio">
                                <input id="radio-1" value="male" class="gender" name="gender_radio" type="radio"
                                       checked>
                                <label for="radio-1" class="radio-label">Male</label>
                            </div>

                            <div class="radio">
                                <input id="radio-2" value="female" class="gender" name="gender_radio" type="radio">
                                <label for="radio-2" class="radio-label">Female</label>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <!--  <span class="input-group-addon"><i class="mdi mdi-calendar-check"></i></span>
                                      <input name="city" placeholder="City" class="form-control" type="text" />-->
                                    <!-- <input type="radio" id="featured-1" name="featured" class="glo_radio" checked>
                                     <label for="featured-1">Mail</label>
                                     <input type="radio" id="featured-2" name="featured" class="glo_radio">
                                     <label for="featured-2">Femail</label>-->

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox login_accept">
                                <label>
                                    <input class="glo_checkbox" id="accepted_check" type="checkbox"
                                           onchange="AcceptTerms_Frount(this);">
                                    <span class="cr"><i class="cr-icon mdi mdi-check"></i></span>
                                    <span class="checkbox_txt"> Accepts Terms &amp; Conditions</span>
                                </label>
                                <a class="badge" target="_blank" href="{{url('terms')}}">?
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="btn_block disable_check disable_submit_btn">
                                <button class="glo_button mdi" onclick="submitForm()"
                                        id="Registration_submit"></button>
                            </div>
                        </div>
                    </div>
                    {{--</form>--}}
                    {!! Form::close() !!}
                </div>
                <!--  <button class="forgot_password" data-toggle="modal" data-target="#myModal_ForgotPassword" value="forgot"></button>
                  <button class="otp_form" data-toggle="modal" data-target="#myModal_varify_otp_email" value="Oto Click"></button>
             -->
            </div>
        </div>
    </div>
</div>


<div id="particles-js" class="canvas_block"></div>
</body>
<script src="{{ asset('js/Social_Connectivity.js') }}"></script>
<!-- Modal Forgot Password-->
<div id="myModal_ForgotPassword" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog forgotpass_lb">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();">×</button>
                <h4 class="modal-title">FORGOT PASSWORD ?</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <input type="text" class="form-control numberOnly contact forgot_txt"
                           placeholder="Please give us your register contact no"
                           id="fcontact_no" autocomplete="off" onkeyup="getcount(this);"
                           data-validate="TT_btnforgotpass">
                    <p id="fcontact"></p>
                    <div class="glo_validateemail">
                        Enter valid contact no
                    </div>
                    <!-- <div class="validatelightboxfinal">
                         * Required
                     </div>-->
                    <div class="forgot_icon mdi mdi-email-open-outline"></div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary" onclick="forgotpasswordsend();" disabled="disabled"
                        id="TT_btnforgotpass">Send
                </button>
            </div>
        </div>

    </div>
</div>
<div id="myModal_varify_otp_email" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog forgotpass_lb">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();"></button>
                <h4 class="modal-title">OTP VERIFICATION</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <input type="text" class="form-control forgot_txt" placeholder="Please enter otp" id="txtotp1"
                           autocomplete="off" data-validate="TT_btnforgotpass">
                    <div class="forgot_icon mdi mdi-account-check"></div>
                </div>
                <!--  <div class="logindiv" style="border: none">
                      <input type="text" class="form-control forgot_txt" placeholder="Please enter email id"  id="txtvarify_email" autocomplete="off" data-validate="TT_btnforgotpass">
                      <div class="forgot_icon mdi mdi-email-open-outline"></div>
                  </div>-->
                <p class="statusMsg"></p>
            </div>
            <div class="modal-footer text-center">
                <a href="#">
                    <button type="button" class="btn btn-primary" onclick="submitotpForm()" id="varify_otp_email">
                        Validate OTP
                    </button>
                </a>
                <button type="button" class="btn btn-default" onclick="resendotp();" id="resend_otp">Resend OTP</button>
            </div>
        </div>

    </div>
</div>


<div id="re_verify_otp_email" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog forgotpass_lb">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();">×</button>
                <h4 class="modal-title">OTP VERIFICATION</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <input type="text" class="form-control forgot_txt" placeholder="Please enter otp" id="txtotp2"
                           autocomplete="off" data-validate="TT_btnforgotpass">
                    <div class="forgot_icon mdi mdi-account-check"></div>
                </div>
                <!--  <div class="logindiv" style="border: none">
                      <input type="text" class="form-control forgot_txt" placeholder="Please enter email id"  id="txtvarify_email" autocomplete="off" data-validate="TT_btnforgotpass">
                      <div class="forgot_icon mdi mdi-email-open-outline"></div>
                  </div>-->
                <p class="statusMsg"></p>
            </div>
            <div class="modal-footer text-center">
                <a href="#">
                    <button type="button" class="btn btn-primary" onclick="submitotpForm()" id="varify_otp_email">
                        Validate OTP
                    </button>
                </a>

            </div>
        </div>

    </div>
</div>
<div class="Globalloading" id="main_pageloader">
    <div class="Globalloading-center">
        <div class="Glo-center-absolute">
            <div class="object loadblk_one">
            </div>
            <div class="object loadblk_two">
            </div>
            <div class="object loadblk_three">
            </div>
            <div class="object loadblk_four">
            </div>
        </div>
    </div>
</div>
<div class="page_load_box" id="onpage_loader">
    <div class="onpage_loader">
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
    </div>
</div>
<div class="modal popup_bgcolor" id="sucess_popup">
    <div class="popup_box">
        <div class="alert_popup success_bg">
            <div class="popup_verified"><i class="mdi mdi-check"></i></div>
            <h4 class="popup_mainhead">Thank You!</h4>
            <p class="popup-text dynamic_popuptxt">You have successfully Submit</p>
        </div>
        <div class="popup_submit">
            <button class="popup_submitbtn success_bg sucess_btn" type="submit" onclick="HidePopoupMsg();">Ok
            </button>
        </div>
    </div>
</div>
<div class="modal popup_bgcolor" id="error_popup">
    <div class="popup_box">
        <div class="alert_popup error_bg">
            <div class="popup_verified"><i class="mdi mdi-close"></i></div>
            <h4 class="popup_mainhead">Error Massage!</h4>
            <p class="popup-text dynamic_popuptxt">You have entered wrong text</p>
        </div>
        <div class="popup_submit">
            <button class="popup_submitbtn error_bg error_btn" type="submit" onclick="HidePopoupMsg();">ok</button>
        </div>
    </div>
</div>
<script src="{{ url('/js/bootstrap-datepicker.js') }}"></script>
@if(session()->has('message'))
    <script type="text/javascript">
        if ('{{session()->get('message')}}' == 'Verification code has send to your registered mobile number...') {
            $('#myModal_varify_otp_email').modal('show');
        }
        setTimeout(function () {
            success_noti("{{ session()->get('message') }}");
        }, 500);
    </script>
@endif
@if($errors->any())
    <script>
        setTimeout(function () {
            warning_noti("{{$errors->first()}}");
        }, 500);
    </script>
@endif

<script type="text/javascript">

    function getcount(dis) {
        var txtotp = $(dis).val();
        if (txtotp.length == 10) {
            $('#TT_btnforgotpass').removeAttr("disabled", "disabled");
        } else {
            $('#TT_btnforgotpass').attr("disabled", "disabled");
        }
    }

    function checkrefcode() {
        var x = document.getElementById("fname");
        x.value = x.value.toUpperCase();
    }

    function closeForgotLbox() {
        $('#txtFemailid').val('');
        $("#txtFemailid").css("border", "solid 1px #ccc");
    }

    function submitotpForm() {
        var txtotp = $('#txtotp1').val().trim() != '' ? $('#txtotp1').val() : $('#txtotp2').val();
        var formData = '_token=' + $('.token').val();
//        alert(gender);
        if (txtotp.trim() == '') {
            alert('Please enter otp');
            $('#txtotp').focus();
            return false;
        } else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('verify_otp') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "txtotp":"' + txtotp + '"}',
                success: function (data) {
                    if (data == 'ok') {
                        $('#txtotp').val('');
                        $('.statusMsg').html('<span style="color:green;">You have verified successfully...you will be redirected in 2 seconds</p>');
                        setTimeout(function () {
                            window.location.href = "{{url('profiles')}}";
                            {{--                                window.location.href = "{{url('coming_soon')}}"--}}
                        }, 2000);
                    } else if (data == 'Incorrect') {
                        $('#txtotp').val('');
                        $('.statusMsg').html('<span style="color:red;">Incorrect otp...Please enter correct otp</span>');
                    }
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    function submitForm() {
        // HideOnpageLoopader1();
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var rc = $('.rcode').val();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email_id').val();
        var contact = $('.contact').val();
        var dob = $('.dtp').val();
        var password = $('.password').val();
        var country = $('.country').val();
        var city = $('.city').val();
        var gender = $('input[name=gender_radio]:checked').val();
        var formData = '_token=' + $('.token').val();
        $('#frmReg .required').each(function () {
            if ($(this).val().length == 0) {
                $(this).addClass('errorClass');
//                swal("Oops....", "You must have enter required fields", "info");
                warning_noti("You must have enter required fields");
                return false;
            }
            else {
                $(this).removeClass('errorClass');
            }
        });

        // $("input#email_id").verimail({
        //     messageElement: "p#status-message"
        // });
        // if ($("#email_id").verimail) {
        //     alert('Please enter valid email');
        // } else{

        if (fname == '') {
            return false;
        } else if ($('.password').val().length < 4) {
//            swal("Oops...!", "Password must have atleast 4 digits", "info");
            warning_noti("Password must have atleast 4 digits");
            return false;
        } else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('postreg') }}",
                //                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "rc":"' + rc + '", "fname":"' + fname + '", "lname":"' + lname + '", "email":"' + email + '", "contact":"' + contact + '", "dob":"' + dob + '", "password":"' + password + '", "country":"' + country + '", "city":"' + city + '", "gender":"' + gender + '"}',
                success: function (data) {
                    if (data == 'Email already') {
                        $('#myModal_varify_otp_email').hide();
                        $('#myModal_varify_otp_email').modal('hide');
                        HideOnpageLoopader1();
//                        swal("Oops...!", "Email already exist please use different email", "info");
                        warning_noti("Email already exist please use different email");
                    } else if (data == 'Contact already') {
                        $('#myModal_varify_otp_email').hide();
                        $('#myModal_varify_otp_email').modal('hide');
                        HideOnpageLoopader1();
//                        swal("Oops...!", "Contact already exist please use different contact no", "info");
                        warning_noti("Contact already exist please use different contact no");
                    }

                    // $('#err').html(data);
                },
                error: function (xhr, status, error) {
                    //                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    function resendotp() {
        var contact = $('.contact').val();
        var formData = '_token=' + $('.token').val();
        if (contact.trim() == '') {
            return false;
        }
        else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('resendotp') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "contact":"' + contact + '"}',
                success: function (data) {
                    if (data == 'ok') {
                        $('.statusMsg').html('<span style="color:green;">otp has been sent successfully</span>');
                    } else if (data == 'already') {
                        $('#statusMsg').html('<span style="color:red;">Error in otp sending</span>');
                    }
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    function forgotpasswordsend() {
        var contact = $('#fcontact_no').val();
        var formData = '_token=' + $('.token').val();
        if (contact.trim() == '') {
            alert('Please enter contact');
            return false;
        }
        else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('forgot_password') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "contact":"' + contact + '"}',
                success: function (data) {
                    if (data == 'ok') {
                        $('#fcontact').html('<span style="color:green;">Password has been sent successfully</span>');
                    } else if (data == 'Incorrect') {
                        $('#fcontact').html('<span style="color:red;">Please enter valid mobile no</span>');
                    }
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    /********Check Refferal Code Invalid***********/

    /********Contact Invalid***********/
    $('#fcontact_no').focusout(function () {
        checkcontact(this);
    });

    /********Contact Invalid***********/

    function checkcontact(dis) {
        var txt_val = $(dis).val();
        var formData = '_token=' + $('.token').val();
        if (txt_val.length > 10) {
            $('#fcontact').html('');
            $('#TT_btnforgotpass').attr("disabled", "disabled");
        }
        if (txt_val.trim() == '') {
            $('#fcontact').html('');
            $("#TT_btnforgotpass").removeAttr("disabled");
        } else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('checkno') }}",
                //                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "contact":"' + txt_val + '"}',
                success: function (data) {
                    if (data == 'already') {
                        $('#fcontact').html('');
                        $("#TT_btnforgotpass").removeAttr("disabled");
                    } else if (data == 'ok') {
                        $('#fcontact').html('<span style="color:red;">Contact you entered is does not exist in connecting-one</span>');
                        $('#TT_btnforgotpass').attr("disabled", "disabled");
                    }
                },
                error: function (xhr, status, error) {
                    //                    alert('xhr.responseText');
                    $('#rcerr').html(xhr.responseText);
                }
            });
        }

    }

    $(document).ready(function () {
        $('#frmReg').attr('autocomplete', 'off');
        $('[data-toggle="tooltip"]').tooltip();
        $('#rcode').tooltip({
            'trigger': 'focus',
            'title': 'Use Your Friend Referral Code or Promo Code You Received on Successful Completion of the Survey'
        });
        $('#rcode').focusout(function () {
            var txt_val = $(this).val();
            var formData = '_token=' + $('.token').val();
            if (txt_val.trim() == '') {
                $('#rcerr').html('');
//                $("#Registration_submit").removeAttr("disabled");
            } else {
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('checkrc') }}",
//                data: '{"data":"' + endid + '"}',
                    data: '{"formData":"' + formData + '", "rc":"' + txt_val + '"}',
                    success: function (data) {
                        if (data == 'ok') {
//                            $('#rcerr').html('<span style="color:green;">Password changed successfully</p>');
                            $('#rcerr').html('<span style="color:red;">You have entered invalid Referral code</span>');
                            $('#Registration_submit').attr("disabled", "disabled");
                        } else if (data == 'already') {
                            $('#rcerr').html('');
                            $("#Registration_submit").removeAttr("disabled");
                        }
                    },
                    error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                        $('#rcerr').html(xhr.responseText);
                    }
                });
            }
        });
        /********Check Refferal Code Invalid***********/


        /********Email Invalid***********/
        $('.email_id').focusout(function () {
            var txt_val = $(this).val();
            // validateDomain(txt_val);
            var formData = '_token=' + $('.token').val();
            if (txt_val.trim() == '') {
                $('#rcerr').html('');
                $(".glo_button").removeAttr("disabled");
            } else {
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('checkemail') }}",
//                data: '{"data":"' + endid + '"}',
                    data: '{"formData":"' + formData + '", "email":"' + txt_val.toLowerCase().trim() + '"}',
                    success: function (data) {
                        if (data == 'already') {
//                            $('#rcerr').html('<span style="color:green;">Password changed successfully</p>');
                            $('#rcerr').html('<span style="color:red;">Email already exist...</span>');
                            $('#Registration_submit').attr("disabled", "disabled");
                        } else if (data == 'ok') {
                            $('#rcerr').html('');
                            $("#Registration_submit").removeAttr("disabled");
                        }
                    },
                    error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                        $('#rcerr').html(xhr.responseText);
                    }
                });
            }

        });

        $('#contact_no').focusout(function () {
            var txt_val = $(this).val();
            var formData = '_token=' + $('.token').val();
            if (txt_val.trim() == '') {
                $('#rcerr').html('');
                $(".glo_button").removeAttr("disabled");
            } else {
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('checkcontact') }}",
                    data: '{"formData":"' + formData + '", "contact":"' + txt_val + '"}',
                    success: function (data) {
                        if (data == 'already') {
                            $('#rcerr').html('<span style="color:red;">Contact no already exist...</span>');
                            $('#Registration_submit').attr("disabled", "disabled");
                        } else if (data == 'ok') {
                            $('#rcerr').html('');
                            $("#Registration_submit").removeAttr("disabled");
                        }
                    },
                    error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                        $('#rcerr').html(xhr.responseText);
                    }
                });
            }

        });
        /********Email Invalid***********/


        // /*date Picker*/
        // $('#date_of_birth').datepicker({
        //     format: 'dd-M-yyyy', autoclose: true,
        //     endDate:'-18y',
        // }).on('changeDate', function (event) {
        //     if ($('#date_of_birth').val() != "") {
        //         $("#date_of_birth").removeClass('vErrorRed');
        //     }
        // });

        /*Navigation Page Block*/
        $('#regis_nav_tabs').click(function () {
            $('.login_block').addClass('main_scale0');
            $('.regis_block').removeClass('main_scale0');
        });
        $('#login_nav_tabs').click(function () {
            $('.login_block').removeClass('main_scale0');
            $('.regis_block').addClass('main_scale0');
        });

        $('.dtp').datepicker({
            format: "dd-MM-yyyy",
            maxViewMode: 2,
            endDate: '-18y',
            daysOfWeekHighlighted: "0",
            autoclose: true,
        });
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 3000);
    });
    $(window).on('load', function () {
//        $('#Modal_Survey').modal('show');
        HideOnpageLoopader1();
    });

    function HideOnpageLoopader1() {
        $('#onpage_loader').hide();
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
<script type="text/javascript">
    function getCity(dis) {
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('getStateCity') }}",
            data: {state: $(dis).val()},
            success: function (data) {
                $('#city_by_state').html(data);
            },
            error: function (xhr, status, error) {
                $('#city_by_state').html(xhr.responseText);
            }
        });
    }

    $('#confirm_show_password').focusout(function () {
        var password = $('#show_password').val();
        var c_password = $(this).val();
        if (password != c_password) {
            $(this).val('');
            error_noti("Password and confirm password mismatch");
        }
    });
    {{--$('#email_id').focusout(function () {--}}
    {{--var domains = ["gmail.com", "hotmail.com", "msn.com", "yahoo.com", "yahoo.in", "yahoo.com", "aol.com", "hotmail.co.uk", "yahoo.co.in", "live.com", "rediffmail.com", "outlook.com", "hotmail.it", "googlemail.com", "mail.com"]; //update ur domains here--}}
    {{--var idx1 = this.value.indexOf("@");--}}
    {{--if (idx1 > -1) {--}}
    {{--var splitStr = this.value.split("@");--}}
    {{--var sub = splitStr[1].split(".");--}}
    {{--if ($.inArray(splitStr[1], domains) == -1) {--}}
    {{--warning_noti("Email must have correct domain name Eg: @gmail.com");--}}
    {{--swal("Oops....", "Email must have correct domain name Eg: @gmail.com", "info");--}}
    {{--this.value = "";--}}
    {{--}--}}
    {{--}--}}
    {{--});--}}
</script>
<script src="{{ asset('js/login_validation.js') }}"></script>
</html>