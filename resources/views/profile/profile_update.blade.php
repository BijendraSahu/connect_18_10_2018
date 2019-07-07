<!DOCTYPE html>
<?php
//echo $_SESSION['user_timeline'];
$MERCHANT_KEY = "mqqqWtY9";
$SALT = "x2fGRxrwL7";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";        // For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if (!empty($_POST)) {
    //print_r($_POST);
    foreach ($_POST as $key => $value) {
        $posted[$key] = $value;

    }
}

$formError = 0;

if (empty($posted['txnid'])) {
    // Generate random transaction id
    $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
    $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {

    if (
        empty($posted['key'])
        || empty($posted['txnid'])
        || empty($posted['amount'])
        || empty($posted['firstname'])
        || empty($posted['email'])
        || empty($posted['phone'])
        || empty($posted['productinfo'])
        || empty($posted['surl'])
        || empty($posted['furl'])
        || empty($posted['service_provider'])
    ) {
        $formError = 1;
    } else {

        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;

        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    }
} elseif (!empty($posted['hash'])) {
    $hash = $posted['hash'];
    $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="images/png" href="{{ asset('images/fav.png') }}"/>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Animation.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Datepicker.js') }}"></script>
    <script src="{{ asset('js/login_validation.js') }}"></script>
    <script src="{{ asset('js/Global.js') }}"></script>
    <link href="{{url('css/cropper.min.css')}}" type="text/css" rel="stylesheet"/>
    <style type="text/css">
        .page {
            max-width: 768px;
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .box {
            width: 100%;
            margin: 5px 5px 10px 5px;
        }

        .box-2 {
            padding: 0.5em;
            width: calc(100% / 2 - 0em);
        }

        .options label,
        .options input {
            width: 4em;
            padding: 0.5em 1em;
        }

        .note_forcrop {
            width: 100%;
            margin: 10px 0px;
            color: #666666;
            font-size: 12px;
        }

        .hide {
            display: none;
        }

        img {
            max-width: 100%;
        }

        .center_btnmargin {
            margin: 0px 10px;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        .basic_icon_margin {
            margin-right: 5px;
        }

    </style>
    <script type="text/javascript" src="{{url('js/cropper.min.js')}}"></script>
    <script src="{{url('js/login_validation.js') }}"></script>

    <script type="text/javascript">
        function setprofile() {
            var image = $('#image_frout').attr('src');
            $.ajax({
                url: "image-crop",
                type: "POST",
                data: {"image": image},
                success: function (data) {
                    ShowSuccessPopupMsg('Your profile has been uploaded...');
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            });
        }

        function CheckFileValidation(dis) {
            var sizefile = Number(dis.files[0].size);
            if (sizefile > 1048576 * 2) {
                var finalfilesize = parseFloat(dis.files[0].size / 1048576).toFixed(2);
                ShowErrorPopupMsg('Your file size ' + finalfilesize + ' MB. File size should not exceed 2 MB');
                $(dis).val("");
                return false;
            }
            var validfile = ["png", "jpg", "jpeg"];
            var source = $(dis).val();
            var current_filename = $(dis).val().replace(/\\/g, '/').replace(/.*\//, '');
            var ext = source.substring(source.lastIndexOf(".") + 1, source.length).toLowerCase();
            for (var i = 0; i < validfile.length; i++) {
                if (validfile[i] == ext) {
                    break;
                }
            }
            if (i >= validfile.length) {
                ShowErrorPopupMsg('Only following file extention is allowed, png, jpg, jpeg ');
                $(dis).val("");
                return false;
            }
            else {
                var input = dis;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        // $(changepicid).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    $('#file_text_crop').val(current_filename);
                    return true;
                }
            }
        }

        $(document).ready(function () {
            var result = $('.result'),
                img_result = $('.img-result'),
                img_w = $('.img-w'),
                img_h = $('.img-h'),
                options = $('.options'),
                save = $('.save'),
                cropped = $('.cropped'),
                dwn = $('.download'),
                upload = $('#file-input'),
                cropper = '';
            var roundedCanvas;

            $('#file-input').change(function (e) {
                if (CheckFileValidation(this)) {
                    if (e.target.files.length) {
                        // start file reader
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            if (e.target.result) {
                                // create new image
                                var img = document.createElement('img');
                                img.id = 'image';
                                img.src = e.target.result;
                                // clean result before
                                //result.innerHTML = '';
                                result.children().remove();
                                // append new image
                                result.append(img);
                                // show save btn and options
                                // save.removeClass('hide');
                                options.removeClass('hide');
                                // init cropper
                                cropper = new Cropper(img);
                                // cropbtn setting enabled
                                $('#cropbtn_setting').find('.btn').removeAttr("disabled");
                                $('#btncrop_download').hide();
                                $('#btncrop_download').attr("disabled", "true");
                                $('#save_toserver').attr("disabled", "true");
                                save.removeAttr("disabled");

                                $('#btn_RotateLeft').click(function () {
                                    cropper.rotate(90);
                                });
                                $('#btn_RotateRight').click(function () {
                                    cropper.rotate(-90);
                                });
                                $('#btn_RotateReset').click(function () {
                                    cropper.reset();
                                });
                                $('#btn_Compresed').click(function () {
                                    debugger;
                                    /*     cropper.(UMD, compressed);*/
                                });
                            }
                        };
                        reader.readAsDataURL(e.target.files[0]);
                    }
                }
            });
            $('#save').click(function (e) {
                //e.preventDefault();
                // get result to data uri
                var imgSrc = cropper.getCroppedCanvas({
                    width: img_w.value // input value
                }).toDataURL();
                // remove hide class of img
                cropped.removeClass('hide');
                img_result.removeClass('hide');
                // show image cropped
                cropped.attr('src', imgSrc);
                dwn.removeClass('hide');
                //dwn.download = 'imagename.png';
                dwn.attr('href', imgSrc);
                // download button enabled
                $('#btncrop_download').show();
                $('#btncrop_download').removeAttr("disabled");
                $('#save_toserver').removeAttr("disabled");
            });
        });
    </script>

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"/>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
    <script>
        var hash = '<?php if (!empty($hash)) {
            echo $hash;
            $_SESSION['pstd_hsh'] = $hash;
        }; ?>';

        function submitPayuForm() {
            if (hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            // payuForm.action= 'https://test.payu.in/_payment';
            payuForm.action = 'https://secure.payu.in/_payment';
            payuForm.submit();
        }
    </script>
</head>
<body class="bg_profile_color" onload="submitPayuForm()">
<div class="container">

    <div class="content_block form-group">
        <div class="com-block block_header">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="h2_header">Profile Details</h2>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="com-block content-body">
            <div class="row">
                {{--                <form action="{{url('profile/'.str_slug($timeline->fname." ".$timeline->lname).'/'.$user->id)}}">--}}
                {!! Form::open(['url' => 'profileupdate', 'class' => '', 'id'=>'frmupdate', 'method'=>'post', 'files'=>true]) !!}
                <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="profile_block text-center">
                        <div class="profile-picture">
                            <img src="{{url('').'/'.$user->profile_pic}}" id="_UserProfile" alt="UserProfile">
                        </div>
                        <div class="btn btn-info btn-sm profile-upload" data-toggle="modal"
                             data-target="#modal_crop">
                            <span class="mdi mdi-account-edit mdi-24px"></span>
                            {{--<input type="file" name="profile_pic" id="avatar_id" class="profile-upload-pic"--}}
                            {{--onchange="ChangeSetImage(this, _UserProfile);">--}}
                        </div>
                        {{--<div class="btn btn-default btn-sm profile-upload">--}}
                            {{--<span class="mdi mdi-close mdi-24px"></span>--}}
                        {{--</div>--}}
                        <p style="display: none;">
                            <small class="text-muted">Accepted formats are .jpg, .gif &amp; .png. Size &lt; 1MB.
                                Best
                                fit 198 X 120
                            </small>
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                    <div class="profile_block">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                        <input name="fname" placeholder="First Name" class="form-control required fname"
                                               value="{{$timeline->fname}}" type="text"/>
                                        <input name="timeline_id" placeholder="First Name"
                                               class="form-control timeline_id"
                                               value="{{$timeline->id}}" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                        <input name="lname" placeholder="Last Name" class="form-control required lname"
                                               value="{{$timeline->lname}}" type="text"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-calendar-check mdi-16px"></i></span>
                                        <input name="dob" placeholder="Date of Birth"
                                               value="{{date_format(date_create($user->birthday), "d-M-Y")}}"
                                               class="form-control required vRequiredText dob" id="date_of_birth"
                                               type="text"/>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-addon"><i class="mdi mdi-clipboard-account mdi-16px"></i></span>--}}
                            {{--<input name="password" placeholder="Age" class="form-control"  type="text" />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-format-list-bulleted mdi-16px"></i></span>
                                        <select name="country" id="" class="form-control country requiredDD" disabled>
                                            <option value="99">India</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                        <input onkeypress="return false" tabindex="-1" onkeydown="return false"
                                               name="lname" placeholder="Last Name"
                                               class="form-control not_allowed" readonly="readonly"
                                               value="{{$user->email}}" type="text"/>
                                        <input name="user_id" placeholder="user_id" class="form-control user_id"
                                               value="{{$user->id}}" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-addon"><i class="mdi mdi-clipboard-account mdi-16px"></i></span>--}}
                            {{--<input name="password" placeholder="Age" class="form-control"  type="text" />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-phone mdi-16px"></i></span>
                                        <input onkeypress="return false" onkeydown="return false" name="phone"
                                               placeholder="Phone No" readonly="readonly"
                                               class="form-control not_allowed" tabindex="-1"
                                               value="{{$user->contact}}" type="text"/>
                                        {{--                                        <label>{{$user->contact}}</label>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i
                                            class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                <input name="city" placeholder="City" value="{{$user->city}}" class="form-control city"
                                       type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-account-settings mdi-16px"></i></span>
                                <select class="form-control selectpicker requiredDD" id="profession">
                                    <option value="0" selected>Profession</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Entrepreneur">Entrepreneur</option>
                                    <option value="Other">Other</option>
                                </select>
                                {{--                                {!! Form::select('country', $country, $user->country_id,['class' => 'form-control country requiredDD']) !!}--}}
                            </div>
                        </div>
                        <div class="form-group glo_otherbox" id="other_block">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="mdi mdi-account-settings mdi-16px"></i></span>
                                <input name="other" placeholder="Other" id="otherpro" class="form-control otherpro"
                                       type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i
                                            class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                <input name="address" placeholder="Address" class="form-control" type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="btn_block">
                        <button class="glo_button mdi" onclick="submitForm()" id="profile_submit"></button>
                    </div>
                </div>
                {{--</form>--}}
                {!! Form::close() !!}
                <p id="err"></p>
            </div>
        </div>
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
<div id="modal_crop" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crop and Download your image</h4>
            </div>
            <div class="modal-body">
                <main class="page">
                    <div class="box">
                        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="file-input"/>
                </span>
            </span>
                            <input type="text" id="file_text_crop" class="form-control" readonly=""/>
                        </div>
                        <p class="note_forcrop">
                            You can easily rotate, move and crop the image. double click are used to change the
                            event like move to 360 degree. ( image and crop frame )
                        </p>
                    </div>
                    <div class="box-2">
                        <div class="result">
                            <img class="cropped" id="image_frout" src="{{url('images/NoPreview_CropImg.png')}}" alt="">
                        </div>
                    </div>
                    <div class="box-2 img-result hide">
                        <img class="cropped" id="image_frout" src="" alt="">
                    </div>
                    <div class="box" id="cropbtn_setting">
                        <!--<div class="options hide">
                            <label> Width</label>
                            <input type="text" class="img-w" value="300" min="100" max="1200"/>
                        </div>-->
                        <button class="btn btn-info btn-sm" disabled="disabled" id="btn_RotateLeft">
                            <i class="mdi mdi-format-rotate-90 basic_icon_margin"></i>Rotate Left
                        </button>
                        <button class="btn btn-warning btn-sm center_btnmargin" disabled="disabled"
                                id="btn_RotateRight">
                            <i class="mdi mdi-rotate-right basic_icon_margin"></i>Rotate Right
                        </button>
                        <button class="btn btn-danger btn-sm" disabled="disabled" id="btn_RotateReset">
                            <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Reset
                        </button>
                        <!-- <button class="btn btn-success" id="btn_getRounded">
                             <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Rounded</button>-->
                    </div>
                </main>
            </div>
            <div class="modal-footer">
                <a href="" target="_blank" class="btn btn-default download" disabled="disabled"
                   id="btncrop_download" download="imagename.png" style="display: none;">
                    <i class="mdi mdi-folder-download basic_icon_margin"></i>Download</a>
                <button class="btn btn-primary save" id="save" disabled="disabled"><i
                            class="mdi mdi-crop basic_icon_margin"></i>Cropped
                </button>
                <button class="btn btn-success upload-result" disabled="disabled" id="save_toserver"
                        onclick="setprofile();"><i class="mdi mdi-account-check basic_icon_margin"></i>Set
                    Profile
                </button>
            </div>
        </div>

    </div>
</div>
<!-- Modal Payment & Free User-->
<div id="myModal_PaymentUser" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog Payment_lb">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();">×</button>-->
                <h4 class="modal-title">Choose your plan</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <div class="col-sm-6">
                        <div class="payment_option_holder">
                            <div class="pay_head">Free</div>
                            <div class="pay_innerblk">
                                <div class="pay_money"><i class="mdi mdi-currency-inr"></i>0</div>
                                <ul class="payment_ul">
                                    <li><i class="mdi mdi-check"></i>Free Excess to Social Networking space.</li>
                                    <li><i class="mdi mdi-check"></i> Chatting, Video Calling, Data Calling & Video Conferencing</li>
                                    <li><i class="mdi mdi-check"></i> Can Upload 5 products on Buy & Sell each day
                                    </li>
                                    <li><i class="mdi mdi-check"></i> E-Shopping
                                    </li>
                                    <li><i class="mdi mdi-check"></i> Cool Profile Graphics & Themes
                                    </li>
                                    {{--<li><i class="mdi mdi-check"></i> Feature 6</li>--}}
                                </ul>
                            </div>
                            <div class="pay_btnbox">
                                {{--                                <a href="{{url('dashboard/'. str_slug($timeline->fname . " " . $timeline->lname))}}">--}}
                                <a href="{{url('dashboard')}}">
                                    <button class="btn btn-warning" value="Continue">Continue <i
                                                class="mdi mdi-arrow-right"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="payment_option_holder">
                            <div class="pay_head">Membership</div>
                            <div class="pay_innerblk">
                                <div class="pay_money"><i class="mdi mdi-currency-inr"></i>1</div>
                                <ul class="payment_ul">
                                    <li><i class="mdi mdi-check"></i> Panic Button : SOS Emergency Alert to all Emergency contact</li>
                                    <li><i class="mdi mdi-check"></i> Can Upload 20 products on Buy & Sell each day.
                                    </li>
                                    <li><i class="mdi mdi-check"></i>Can upload 10 products for commercial sellers on E-Commerce.
                                    </li>
                                    <li><i class="mdi mdi-check"></i> Access to MLN money earning platform with Unique Referral Code.
                                    </li>
                                    <li><i class="mdi mdi-check"></i> Product Advertisement.
                                    </li> <li><i class="mdi mdi-check"></i> Connecting One Team Assistance.
                                    </li>
                                    {{--<li><i class="mdi mdi-check"></i> Feature 6</li>--}}
                                </ul>
                            </div>
                            <div class="pay_btnbox">
                                <button class="btn btn-warning" data-target="#Modal_payoptionlist" data-toggle="modal">
                                    Pay Now <i class="mdi mdi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal_TermsAccepted" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog Payment_lb">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="GloCloseModel();">x</button>
                <h4 class="modal-title">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <div class="terms_modelblock">
                    <p>1. Membership to be given to the authenticated person who is having Mo No., Bank Account. Valid
                        E-Mail Id. And PAN / Adhar card.</p>
                    <p>2. As a Member, Person have the role and responsibility to maintain the decorum of the
                        membership, and should not violate any rules and regulation, and Privacy of the company.
                    </p>
                    <p>3. If any member found guilty of violation of policy ,their membership will be terminated without
                        notice.</p>
                    <p>4. Member will get reward point after completing online surveys/advertisement promo scheme
                        decided as per policy of connecting one which keep changes from time to time with notification
                        to member.</p>
                    <p>5. Member can upload there paid advertisement at our platform and get benefited of 50% of the
                        advertisement directly after settlement of bills.</p>
                    <p>6. Member can redeem their credit points/ Money at any moment of time( Min amount – Rs. 10/-)</p>
                    <p>7. At the time of redemption 10% of the total income will be deducted as service charges.</p>
                    <p>8. Membership fee is non refundable.</p>
                    <p>9. Max Capping of level is Level-250,</p>
                    <p>10. By visiting this Portal, you agree that the laws of the Republic of India (state of Madhya
                        Pradesh, City Jabalpur) without regard to its conflict of laws principles, govern this Privacy
                        Policy and any dispute arising in respect hereof shall be subject to and governed by the dispute
                        resolution process set out in the Terms and Conditions. You and Connecting-One.com agree to
                        submit to the personal and exclusive jurisdiction of the court located within Jabalpur, Madhya
                        Pradesh.</p>
                    <p>11. You are not allowed to share your account with any other individual.</p>
                    <p>12. Payment/Redemption settlement will be carried out in 7 working dates. </p>
                    <p>13. Your membership will terminate immediately in the unfortunate event of your death. Service
                        accounts are not transferable upon death or otherwise by operation of law.</p>
                    <div class="terms_imgbox">
                        <img src="{{url('images/level.png')}}"/>
                    </div>
                    <div class="terms_checkbox">
                        <div class="checkbox glo_checkbox_mainbox" style="text-align: left;">
                            <label>
                                <input class="glo_checkbox" id="accepted_check" type="checkbox"
                                       onchange="AcceptTerms(this);"/>
                                <span class="cr"><i class="cr-icon mdi mdi-check"></i></span>
                                <span class="checkbox_txt"> Accepts Terms & Conditions</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            {{-- <button type="button" class="btn btn-primary" id="terms_btn" data-dismiss="modal" disabled="disabled">Accepted</button>--}}
            <!-- ################PayuformBlock###################33 -->
                {{--<form action="{{url('make-payment/1')}}" method="post" name="payuForm" id="payu_form_btnblock">--}}
                <form action="{{url('Atompay/sample.php')}}" target="_blank" method="post" name="payuForm"
                      id="payu_form_btnblock">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="key" value="mqqqWtY9"/>
                    <input type="hidden" name="rfrl_box" id="rfrl_box" value="0"/>
                    <?php $getRc = \App\relation::where(['child_id' => $_SESSION['user_master']['id']])->first(); ?>
                    <input type="hidden" name="rfrl_ptymbox" id="rfrl_ptymbox"
                           value="{{isset($getRc->parent_id)?$getRc->parent_id:'0'}}"/>
                    <input type="hidden" name="hash" value="<?php if (!empty($hash)) {
                        echo $hash;
                    }; ?>"/>
                    <input type="hidden" name="txnid" value="<?php if (!empty($txnid)) {
                        echo $txnid;
                    }; ?>"/>
                    <table>

                        <tr>
                            <td><input type="hidden" name="amount" value="1.000"/></td>
                            <td>
                                <input type="hidden" name="firstname"
                                       value="<?php echo $_SESSION['user_timeline']['name'];?>">

                            </td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="email" id="email"
                                       value="<?php echo $_SESSION['user_master']['email'];?>"/></td>
                            <td><input type="hidden" name="phone"
                                       value="<?php echo $_SESSION['user_master']['contact'];?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="hidden" name="productinfo" value="Registration fees"/></td>
                        </tr>
                        <tr>

                            <td colspan="3"><input type="hidden" name="surl" value="{{url('success')}}"/></td>
                        </tr>
                        <tr>

                            <td colspan="3"><input type="hidden" name="furl" value="{{url('profiles')}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa"/></td>
                        </tr>

                    </table>

                    <!-- ###################################33 -->
                    {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                    <button type="submit" class="btn btn-primary btn_terms" id="terms_btn"
                            disabled="disabled">Accepted
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                        Close
                    </button>
                </form>
                <!-- ################PaytmFormBlock###################33 -->
                {{--<form action="{{url('make-payment/1')}}" method="post" name="payuForm" id="paytm_form_btnblock"--}}
                {{--style="display: none;">   --}}
                <?php $paytm = \App\PaytmLink::find(1); ?>
                <form action="{{$paytm->link}}" target="_blank" method="get" name="payuForm" id="paytm_form_btnblock"
                      style="display: none;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="key" value="mqqqWtY9"/>
                    <input type="hidden" name="hash" value="<?php if (!empty($hash)) {
                        echo $hash;
                    }; ?>"/>
                    <input type="hidden" name="txnid" value="<?php if (!empty($txnid)) {
                        echo $txnid;
                    }; ?>"/>
                    <table>

                        <tr>
                            <td><input type="hidden" name="amount" value="1.00"/></td>
                            <td>
                                <input type="hidden" name="firstname"
                                       value="<?php echo $_SESSION['user_timeline']['name'];?>">

                            </td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="email" id="email"
                                       value="<?php echo $_SESSION['user_master']['email'];?>"/></td>
                            <td><input type="hidden" name="phone"
                                       value="<?php echo $_SESSION['user_master']['contact'];?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="hidden" name="productinfo" value="Registration fees"/></td>
                        </tr>
                        <tr>

                            <td colspan="3"><input type="hidden" name="surl" value="{{url('success')}}"/></td>
                        </tr>
                        <tr>

                            <td colspan="3"><input type="hidden" name="furl" value="{{url('profiles')}}"/></td>
                        </tr>

                        <tr>
                            <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa"/></td>
                        </tr>

                    </table>

                    <!-- ###################################33 -->
                    {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                    <button type="submit" class="btn btn-primary btn_terms" onclick="Payment_clickbtn();"
                            disabled="disabled">Accepted
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                        Close
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade-scale" id="Modal_payoptionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog likelist_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Choose Payment Options</h4>
            </div>
            <div class="modal-body bg_profile_color">
                <div class="option_container">
                    <div class="col-xs-6">
                        <div class="payment_optionbox" onclick="Selected_option(this);">
                            <img src="{{url('images/atom_logo.png')}}" alt="payu_logo"/>
                            <input type="hidden" value="payumoney" class="selected_option_name"/>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="payment_optionbox" onclick="Selected_option(this);">
                            <img src="{{url('images/paytm_logo.png')}}" alt="paytm_logo"/>
                            <input type="hidden" value="paytm" class="selected_option_name"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" disabled="disabled" id="btn_payoption"
                        data-dismiss="modal" onclick="Submit_PayOption();" data-toggle="modal"
                        data-target="#myModal_TermsAccepted">Submit
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function submitForm() {
        /* $("#profile_submit").addClass("onclic", 250, validate);
         $('#main_pageloader').show();
         validate();*/
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var rc = $('.rcode').val();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email_id').val();
        var contact = $('.contact').val();
        var dob = $('.dob').val();
        var password = $('.password1').val();
        var country = $('.country').val();
        var city = $('.city').val();
        var timeline_id = $('.timeline_id').val();
        var user_id = $('.user_id').val();
        var profession = $('#profession').val();
        var otherpro = $('.otherpro').val();
//        var gender = $('.gender').val();
        var formData = '_token=' + $('.token').val();
        if (fname.trim() == '') {
//            alert('Please enter your fname.');
//            $('#inputMessage').focus();
            return false;
        } else if (lname.trim() == '') {
//            alert('Please enter your last name.');
//            $('#inputMessage').focus();
            return false;
        } else if (dob.trim() == '') {
//            alert('Please enter your dob.');
//            $('#inputMessage').focus();
            return false;
        } else if (country.trim() == '') {
//            alert('Please enter your country.');
//            $('#inputMessage').focus();
            return false;
        } else if (city.trim() == '') {
//            alert('Please enter your city.');
//            $('#inputMessage').focus();
            return false;
        }
        else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('profileupdate') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "fname":"' + fname + '", "lname":"' + lname + '", "dob":"' + dob + '", "country":"' + country + '", "city":"' + city + '", "timeline_id":"' + timeline_id + '", "user_id":"' + user_id + '", "profession":"' + profession + '", "otherpro":"' + otherpro + '"}',
                success: function (data) {
                    //console.log(data);
//                    $('#err').html(data);
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    /* function validate() {
     setTimeout(function () {
     $("#profile_submit").removeClass("onclic");
     $("#profile_submit").addClass("mdi-check", 450, callback);
     $('#main_pageloader').hide();
     $('#myModal_PaymentUser').show();
     }, 2250);
     }

     function callback() {
     setTimeout(function () {
     $("#profile_submit").removeClass("mdi-check");
     }, 1250);
     }*/
    $(document).ready(function () {
        /*date Picker*/
        $('#date_of_birth').datepicker({
            format: 'dd-M-yyyy', autoclose: true,
            endDate: '-18y'
        }).on('changeDate', function (event) {
            if ($('#date_of_birth').val() != "") {
                $("#date_of_birth").removeClass('vErrorRed');
            }
        });
        /* Button Click*/
        $(function () {
//            $("#profile_submit").click(function () {
//                $("#profile_submit").addClass("onclic", 250, validate);
//                $('#main_pageloader').show();
//                validate();
//            });


        });
        $("#profession").change(function () {
            var curr_val = this.value;
            var firstDropVal = $('#profession').val();
            if (curr_val != 'Other') {
                $('#other_block').slideUp();
            } else {
                $('#other_block').slideDown();
            }
        });
    });
</script>
</body>
</html>