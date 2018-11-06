@extends('layout.master.master')

@section('title', 'Profile Update')

@section('head')
    <script src="{{url('js/login_validation.js') }}"></script>
    <style>
        select option:hover {
            background-color: #EFEFEF !important;
        }

        .greenText {
            background-color: green;
        }
    </style>
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

        .content_block {
            margin-top: 0px;
        }

    </style>
    <script type="text/javascript" src="{{url('js/cropper.min.js')}}"></script>
    <script type="text/javascript">
        function setprofile() {
            var image = $('#image_frout').attr('src');
            $.ajax({
                url: "image-crop",
                type: "POST",
                data: {"image": image},
                success: function (data) {
                    swal("Success!", 'Your profile has been uploaded...', "success");
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
                ShowErrorPopupMsg('Only following file extension is allowed, png, jpg, jpeg ');
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
                $('#btncrop_download').removeAttr("disabled");
                $('#save_toserver').removeAttr("disabled");
            });
        });

    </script>
@stop
@section('content')
    <section class="notofication_containner">
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
                        {!! Form::open(['url' => 'myprofile', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
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
                                @if($user->profile_pic != 'images/Male_default.png')
                                    <div class="btn btn-default btn-sm profile-upload">
                                        <span class="mdi mdi-close mdi-24px" onclick="removeProfile()"></span>
                                    </div>
                                @endif
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
                                                {{--<input name="fname" placeholder="First Name" class="form-control fname"--}}
                                                {{--value="{{$timeline->fname}}" type="text"/>--}}
                                                {!! Form::text('fname', $timeline->fname, ['class' => 'form-control textWithSpace txt required','placeholder'=>'First Name']) !!}
                                                <input name="timeline_id" maxlength="25" placeholder="First Name"
                                                       class="form-control timeline_id" onpaste="return false;"
                                                       value="{{$timeline->id}}" type="hidden"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                                <input name="lname" placeholder="Last Name" maxlength="25"
                                                       class="form-control txt textWithSpace required lname"
                                                       onpaste="return false;"
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
                                                <input name="dob" placeholder="Date of Birth" maxlength="25"
                                                       onkeypress="return false;"
                                                       value="{{date_format(date_create($user->birthday), "d-M-Y")}}"
                                                       class="form-control textWithSpace required vRequiredText dtp dob"
                                                       id="date_of_birth"
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
                                                <select name="country" id="" class="form-control country requiredDD"
                                                        disabled>
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
                                                       name="email" placeholder="Email" maxlength="50"
                                                       readonly="readonly"
                                                       class="form-control not_allowed"
                                                       value="{{$user->email}}" type="text"/>
                                                <input name="user_id" placeholder="user_id" id="user_master_id"
                                                       class="form-control user_id"
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
                                                <input onkeypress="return false" onkeydown="return false" name="contact"
                                                       placeholder="Contact" readonly="readonly"
                                                       class="form-control not_allowed" tabindex="-1"
                                                       value="{{$user->contact}}" type="text"/>
                                                {{--                                        <label>{{$user->contact}}</label>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="radio">
                                            <input id="radio-1" value="male" class="gender" name="gender_radio"
                                                   type="radio" {{$user->gender == 'male'?'checked':''}} >
                                            <label for="radio-1" class="radio-label">Male</label>
                                        </div>

                                        <div class="radio">
                                            <input id="radio-2" value="female" class="gender" name="gender_radio"
                                                   type="radio" {{$user->gender == 'female'?'checked':''}}>
                                            <label for="radio-2" class="radio-label">Female</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                <span class="input-group-addon"><i
                                            class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                                <input name="city" onpaste="return false;" placeholder="City"
                                                       value="{{$user->city}}"
                                                       class="form-control txt textWithSpace required city"
                                                       type="text"/>

                                            </div>


                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-account-settings mdi-16px"></i></span>
                                        {{--<select class="form-control requiredDD selectpicker" name="profession" id="profession">--}}
                                        {{--<option class="greenText" value="">Profession</option>--}}
                                        {{--<option value="Doctor">Doctor</option>--}}
                                        {{--<option value="Engineer">Engineer</option>--}}
                                        {{--<option value="Enterprener">Enterprener</option>--}}
                                        {{--<option value="Other">Other</option>--}}
                                        {{--</select>--}}
                                        {!! Form::select('profession', array('0' => 'Select Profession', 'Doctor' => 'Doctor', 'Engineer' => 'Engineer', 'Entrepreneur' => 'Entrepreneur', 'Other' => 'Other'), $user->profession,['class' => 'form-control requiredDD', 'id'=>'profession']) !!}
                                    </div>
                                </div>

                                <div class="form-group glo_otherbox" id="other_block">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-account-settings mdi-16px"></i></span>
                                        <input name="profession_other" maxlength="40"
                                               placeholder="Please enter other profession" id="other_pro"
                                               class="form-control txt textWithSpace"
                                               type="text"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                        <input name="address" placeholder="Address" value="{{$user->address}}"
                                               class="form-control txt" type="text"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <div class="btn_block">
                                <button class="glo_button mdi" id="profile_submit" type="submit"></button>
                                {{--                            {!! Form::submit('Submit', ['class' => 'glo_button mdi']) !!}--}}
                            </div>
                        </div>
                        {{--</form>--}}
                        {!! Form::close() !!}
                        <p id="err"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="myModal_TermsAccepted" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false"></div>
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
                                <img class="cropped" id="image_frout" src="{{url('images/NoPreview_CropImg.png')}}"
                                     alt="">
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
                       id="btncrop_download" download="imagename.png">
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
    <script type="text/javascript">
        function removeProfile() {
            var user_id = $('#user_master_id').val();
            swal({
                title: "Confirmation",
                text: "Are you sure you want to remove profile pic?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((okk) => {
                if (okk) {
                    $.ajax({
                        type: "get",
                        contentType: "application/json; charset=utf-8",
                        url: "{{ url('removeProfile') }}",
                        data: {user_id: user_id},
                        success: function (data) {
//                            alert(jQuery.parseJSON(data).response);
                            swal("Success!", jQuery.parseJSON(data).response, "success");
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function (xhr, status, error) {
                            alert(error);
                            swal("Server Issue", "Something went wrong", "info");

                        }
                    });
                }

            });
        }
        $(document).ready(function () {
            $('#date_of_birth').datepicker({
                format: 'dd-M-yyyy', autoclose: true,
                endDate: '-18y'
            }).on('changeDate', function (event) {
                if ($('#date_of_birth').val() != "") {
                    $("#date_of_birth").removeClass('vErrorRed');
                }
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


        $(".txt").on({
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
    @if(session()->has('message'))
        <script type="text/javascript">
            setTimeout(function () {
                swal("Success!", "{{ session()->get('message') }}", "success");
            }, 500);
        </script>
    @endif

@stop