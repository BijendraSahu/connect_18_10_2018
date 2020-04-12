{{-------------Created By Bijendra Sahu------------------}}

<?php

//function getBaseUrl()
//{
//    // output: /myproject/index.php
//    $currentPath = $_SERVER['PHP_SELF'];
//
//    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
//    $pathInfo = pathinfo($currentPath);
//
//    // output: localhost
//    $hostName = $_SERVER['HTTP_HOST'];
//
//    // output: http://
//    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https://' ? 'https://' : 'http://';
//
//    // return: http://localhost/myproject/
//    echo $protocol . $hostName . $pathInfo['dirname'] . "/";
//}
if (!isset($_SESSION)) {
    session_start();
}
?>
@if(Session::has('user_master'))
@php
    return redirect('/');
@endphp
@endif
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta charset="utf-8">--}}
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes"/>
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="shortcut icon" type="images/png" href="{{url('images/fav.png')}}"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/searchautocomplete.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/emojionearea.min.css')}}" media="screen"/>
    <link rel="stylesheet" href="{{url('dist/css/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{url('css/materialdesignicons.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/datepicker.css')}}"/>
    <link rel="stylesheet" href="{{url('css/emojione-sprite-64.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/my.css')}}"/>
    <link rel="stylesheet" href="{{url('css/Animation.css')}}"/>
    <link rel="stylesheet" href="{{url('css/media.css')}}"/>
    <script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('js/emojionearea.js')}}"></script>
    <script src="{{url('js/searchautocomplete.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/Datepicker.js')}}"></script>
    <script src="{{url('js/Global.js')}}"></script>
    <script src="{{url('js/PageShare.js')}}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    {{--    <script src="{{url('js/login_validation.js') }}"></script>--}}
    {{--    <link rel="stylesheet" href="{{url('css/select2.min.css')}}">--}}
    {{--<script src="{{url('js/select2.min.js')}}"></script>--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    {{---------------Notification---------------}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('css/lobibox.min.css')}}">
    <script src="{{url('js/notifications.min.js')}}"></script>
    <script src="{{url('js/notification-custom-script.js')}}"></script>
    {{---------------Notification---------------}}
    <script src="{{url('js/TopEarners.js')}}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

    </script>
    <style>
        .ui-front {
            /* left: 892.993px !important; */
            left: 740.993px !important;
            /*margin-left: 270px !important;*/
        }
    </style>
</head>
<body class="body_color">
<div class="page_load_box" id="onpage_loader">
    <div class="onpage_loader">
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
        <div class="onpage_dot"></div>
    </div>
</div>
@include('layout.header.header')
<!-- Page Content -->
@yield('head')
@yield('content')
{{--<div class="loader" id="loader">--}}
{{--<div class="internal_bg">--}}
{{--            <img src="{{url('assets/images/logo_loader.png')}}" class="top_loader" />--}}
{{--<img class="loader_main" src="{{url('images/1L.gif')}}"/>--}}
{{--</div>--}}
{{--</div>--}}
<!-- Page Content -->
<p id="errorall"></p>
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
<div class="overlay_res" onclick="HideTranparent();"></div>
<div class="setting_box" id="setting_box_slide">
    <div class="left_sett_btn" onclick="AnimateSetting(this);">
        <div class="icon_spin animate_iconbox">
            <i class="mdi mdi-settings icon_spin"></i>
        </div>
    </div>
    <div class="settign_containner style-scroll">
        <form enctype="multipart/form-data" id="usertheme">
            <div class="setting_head">Themes
                {{--<button type="submit" class="btn btn-danger setting_save_btn"><i--}}
                {{--class="basic_icons mdi mdi-check"></i>Save--}}
                {{--</button>--}}
                <input type="submit" name="submit" class="btn btn-danger setting_save_btn" id="btnSaveTheme"
                       value="Save"/>
                <p class="btn btn-primary btn_normal" onclick="Defaulte_theme();"><i
                            class="basic_icons mdi mdi-image"></i>Default</p>
            </div>
            <div class="setting_containner_image">
                <div class="theme_box" onclick="ChangeBg(this);">
                    <div class="theme_allbox">
                        <img src="{{url('images/theme_img_up1.png')}}" class="theme_img"/>
                        <div class="internal_text">
                            <div class="selected_img
@if($user->theme_img == "https://www.connecting-one.com/images/theme_img_up1.png") {{'show_applytheme'}} @endif">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="theme_txt">Adminflair</div>
                        </div>
                    </div>
                </div>
                <div class="theme_box" onclick="ChangeBg(this);">
                    <div class="theme_allbox">
                        <img src="{{url('images/theme_img_up2.jpg')}}" class="theme_img"/>
                        <div class="internal_text">
                            <div class="selected_img @if($user->theme_img == "https://www.connecting-one.com/images/theme_img_up2.jpg") {{'show_applytheme'}} @endif">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="theme_txt">Adminflair</div>
                        </div>
                    </div>
                </div>
                <div class="theme_box" onclick="ChangeBg(this);">
                    <div class="theme_allbox">
                        <img src="{{url('images/theme_img_up3.jpg')}}" class="theme_img"/>
                        <div class="internal_text">
                            <div class="selected_img @if($user->theme_img == "https://www.connecting-one.com/images/theme_img_up3.jpg") {{'show_applytheme'}} @endif">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="theme_txt">Adminflair</div>
                        </div>
                    </div>
                </div>
                <div class="theme_box">
                    <div class="com-block file_upload_box_theme">
                        <input type="file" class="file_upload" name="profilebg_Image" id="profilebg_Image"
                               onchange="ChangeFile(this, theme_uploadimg);">
                        <div class="view-uploaded-file" style="display: block;">
                            {{--@if(isset($user->theme_img))  --}}{{--if not null condition--}}
                            {{--<img src="{{url('').'/'.$user->theme_img}}" id="theme_uploadimg" class="theme_img"/>--}}
                            {{--@else--}}
                            {{--<img src="{{url('images/NoPreview_Img.png')}}" id="theme_uploadimg"--}}
                            {{--class="theme_img"/>--}}
                            {{--@endif--}}

                            <img src="{{isset($user->theme_img) ? $user->theme_img : url('images/NoPreview_Img.png')}}"
                                 id="theme_uploadimg" class="theme_img"/>


                            <div class="upload_imgclose mdi mdi-close" id="themebyuser_close"
                                 onclick="RemoveTheameByUser(this)"></div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="user_header" name="user_header"
                       value="{{isset($user->header_colour) ? $user->header_colour : '#000000'}}">
                <input type="hidden" id="theme_img" name="theme_img"
                       value="{{isset($user->theme_img) ? $user->theme_img : ''}}">

            </div>
        </form>
        <div class="setting_head color_head">Header Colors</div>
        <div class="setting_containner_color">
            <div class="color_box clr_0" onclick="HeaderColorChange('#000000', this);">
                @if($user->header_colour == '#000000') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_1" onclick="HeaderColorChange('#0d4d71', this);">
                @if($user->header_colour == '#0d4d71') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_2" onclick="HeaderColorChange('#b38f0a', this);">
                @if($user->header_colour == '#b38f0a') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_3" onclick="HeaderColorChange('#12a500', this);">
                @if($user->header_colour == '#12a500') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_4" onclick="HeaderColorChange('#d21111', this);">
                @if($user->header_colour == '#d21111') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_5" onclick="HeaderColorChange('#4c4302', this);">
                @if($user->header_colour == '#4c4302') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_6" onclick="HeaderColorChange('#b9b3b3', this);">
                @if($user->header_colour == '#b9b3b3') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_7" onclick="HeaderColorChange('#ff458a', this);">
                @if($user->header_colour == '#ff458a') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_8" onclick="HeaderColorChange('#7ed3e6', this);">
                @if($user->header_colour == '#7ed3e6') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_9" onclick="HeaderColorChange('#27204c', this);">
                @if($user->header_colour == '#27204c') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_10" onclick="HeaderColorChange('#8e0076', this);">
                @if($user->header_colour == '#8e0076') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_11" onclick="HeaderColorChange('#7101ab', this);">
                @if($user->header_colour == '#7101ab') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_12" onclick="HeaderColorChange('#ffffff', this);">
                @if($user->header_colour == '#ffffff') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_13" onclick="HeaderColorChange('#e1e1e1', this);">
                @if($user->header_colour == '#e1e1e1') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_14" onclick="HeaderColorChange('#16ffff', this);">
                @if($user->header_colour == '#16ffff') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_15" onclick="HeaderColorChange('#bcb9bb', this);">
                @if($user->header_colour == '#bcb9bb') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_16" onclick="HeaderColorChange('#10a9a9', this);">
                @if($user->header_colour == '#10a9a9') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_17" onclick="HeaderColorChange('#561c1c', this);">
                @if($user->header_colour == '#561c1c') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_18" onclick="HeaderColorChange('#383640', this);">
                @if($user->header_colour == '#383640') <i class="mdi mdi-check"></i>@endif
            </div>
            <div class="color_box clr_19" onclick="HeaderColorChange('#ff5a5a', this);">
                @if($user->header_colour == '#ff5a5a') <i class="mdi mdi-check"></i>@endif
            </div>

        </div>
    </div>
</div>
<div id="Modal_TheamSetting" class="modal fade" data-easein="bounceIn" role="dialog">
    <div class="modal-dialog survey_model">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 class="modal-title">Theme Setting</h4>
            </div>
            <div class="modal-body">
                <div class="servey_caption">
                    <div class="servey_txtleft">Please Like Atleast
                        <span class="counter_remain">4</span>
                    </div>
                    <div class="servey_txtright">Remaining Like <span class="counter_remain"
                                                                      id="servey_remain_cut">4</span></div>
                </div>
                <div id="myCarousel" class="carousel slide">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="servey_imgbox">
                                        <div class="slider_imgcontainner">
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}" alt="Image"
                                                 class="img-responsive"/>
                                            <div class="adver_txtblock">
                                                SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                    </div>
                    <!--/carousel-inner-->
                    <a class="carousel_arrow left_arrow" href="#myCarousel" data-slide="prev">
                        <span class="mdi mdi-chevron-left" aria-hidden="true"></span>
                    </a>
                    <a class="carousel_arrow right_arrow" href="#myCarousel" data-slide="next">
                        <span class="mdi mdi-chevron-right" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
            </div>
        </div>

    </div>
</div>
<div class="modal fade-scale" id="Modal_ViewDetails_advertiselist" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog survey_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">View Details</h4>
            </div>
            <div class="modal-body">
                <div class="news_containner style-scroll">
                    {{--<div class="latest_update_title">SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</div>
                    <div class="latest_updatetxt">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                    <div class="latest_otr_details">
                        <span><i class="mdi mdi-map-marker"></i>Jabalpur</span>
                        <span><i class="mdi mdi-home-automation"></i>Property</span>
                    </div>--}}
                    <table class="table table-bordered white_bgcolor">
                        <tbody>
                        <tr>
                            <td class="width_35 title-more">Advertise Title :</td>
                            <td class="width_65" id="adver_title">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Type :</td>
                            <td class="width_65" id="adver_type">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Selling Price :</td>
                            <td class="width_65" id="adver_price">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">City :</td>
                            <td class="width_65" id="adver_city">-</td>
                        </tr>

                        <tr>
                            <td class="width_35 title-more">Date :</td>
                            <td class="width_65" id="adver_date">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Status :</td>
                            <td class="width_65" id="adver_status">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Contact/Email :</td>
                            <td class="width_65" id="adver_contact">
                                {{-- <div class="status excepted">Excepted</div>--}}
                            </td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Location :</td>
                            <td class="width_65" id="adver_location">
                                {{-- <div class="status excepted">Excepted</div>--}}
                            </td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Total Images. :</td>
                            <td class="width_65" id="adver_image_count">
                                {{-- <div class="status excepted">Excepted</div>--}}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="latest_updateimg" id="advertise_append_img">
                        <img src="{{url('images/Adver_mainimg1.jpg')}}" id="adver_image"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="Mymodal_AddNewMamber" class="modal fade" data-easein="bounceIn" role="dialog">
    <div class="modal-dialog LBAdd_newmember" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">REQUEST NEW MEMBERS</h4>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 col-md-6 col-xs-12 pull-right">
                    <div class="Lb_searchbox">
                        <input id="search_member" type="text" onkeyup="getMemberItem()" class="header_search"
                               placeholder="Search"/>
                        <i class="search_icon mdi mdi-magnify"></i>
                    </div>
                </div>
                <div class="basicLb_containner">
                    <div class="lb_heading">Non Paid Refferal</div>
                    <div class="lb_internalmemberbox style-scroll" id="non_paid_rfrls">

                    </div>
                    <div class="lb_heading">Random Members</div>
                    <div class="lb_internalmemberbox style-scroll" id="rndmrfrls">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade-scale" id="Modal_ViewDetails_LatestNews" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog survey_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">View Details</h4>
            </div>
            <div class="modal-body">
                <div class="news_containner style-scroll">
                    <div class="advertise_details_box">
                        <div class="latest_update_title" id="adver_title_lb"></div>
                        <div class="latest_updatetxt" id="adver_details_lb"></div>
                        <div class="latest_updatetxt" id="amt_lb_details">
                            <span><i class="mdi mdi-currency-inr"></i> <span id="adver_price_lb"></span></span>
                            <span><i class="mdi mdi-map-marker"></i> <span id="adver_city_lb"></span></span>
                            <span><i class="mdi mdi-home-automation basic_icon_margin"></i><span
                                        id="adver_type_lb"></span></span>
                        </div>
                        <div class="latest_otr_details" id="otr_lb_details">
                            <span><i class="mdi mdi-phone-incoming basic_icon_margin"></i><span
                                        id="adver_contact_lb"></span></span>
                            <span><i class="mdi mdi-email basic_icon_margin"></i><span
                                        id="adver_email_lb"></span></span>
                        </div>
                    </div>
                    <div class="latest_updateimg">
                        <img src="{{url('images/Adver_mainimg1.jpg')}}" id="adver_img_lb"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 id="modal_title" class="modal-title">Title</h4>
            </div>
            <div id="modal_body">
                <p>One fine body&hellip;</p>
            </div>
            {{--<div class="modal-footer">--}}
            {{--<div class=" pull-right">--}}
            {{--<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>--}}
            {{--&nbsp;--}}
            {{--</div>--}}
            {{--&nbsp;--}}
            {{--<div id="modalBtn" class="pull-right">&nbsp;</div>             --}}
            {{--</div>--}}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{--Chat--}}
<div id="user_model_details"></div>
{{--Chat--}}


<div class="modal fade-scale" id="Mymodal_notification" data-easein="bounceIn" role="dialog" aria-hidden="false">
    <div class="modal-dialog LBAdd_newmember" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="notif_title"></h4>
            </div>
            <div class="modal-body" id="notif_body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@php
    $friend = \App\AdminModel::find(1)
@endphp
@if($friend->date == 1)
    @include('chat.chat')
@endif
<!------Popup Box -->
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
<input type="hidden" value="{{$user->timeline->name}}" id="logged_in">
<input type="hidden" value="{{$user->id}}" id="logged_in_id">
<input type="hidden" value="{{url('').'/'.$user->profile_pic}}" id="logged_in_profile">
@php
    $friendlist = DB::select("select u.id as fid from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id and status = 'friends') or u.id in (select f.user_id from friends f where f.friend_id=$user->id and status = 'friends')");

$str = '';
$fcounter = 1;
$friendC = count($friendlist);
@endphp
@if(count($friendlist)>0)
    @foreach($friendlist as $friend)
        @if($fcounter<=$friendC)
            @php
                $str .="$friend->fid";
            @endphp
        @endif
        @if($fcounter<$friendC)
            @php
                $str .=",";
                $fcounter++
            @endphp
        @endif
    @endforeach
@endif
<input type="hidden" id="chatfriend" value="{{"$str"}}">
{{--<script type="text/javascript">--}}
{{--var chat_name = $('#logged_in').val();--}}
{{--var chat_id = $('#logged_in_id').val();--}}
{{--var chat_avatar = $('#logged_in_profile').val();--}}
{{--var chat_display_name = $('#logged_in').val();--}}
{{--var chat_friends = $('#chatfriend').val();//'2,3,4,5,6';--}}
{{--</script>--}}
{{--<script type="text/javascript" charset="utf-8" src="//fast.cometondemand.net/50987x_xb89ab.js">--}}
{{--</script>--}}
{{--<link type="text/css" rel="stylesheet" media="all" href="//fast.cometondemand.net/50987x_xb89ab.css"/>--}}
<script type="text/javascript">
    var append_norecord = '<div class="adver_list_row no_block" id="no_record_found_block"><span class="list_no_record">' +
            '< No Record Available ></span></div>';

    function getMemberItem() {
        var check_rowcount = $('.basicLb_containner').length;
        if (check_rowcount > 0) {
            var input = document.getElementById("search_member");
            var filter = input.value.toLowerCase();
            var nodes = document.getElementsByClassName('add_user_block');
            for (i = 0; i < nodes.length; i++) {
                if (nodes[i].innerText.toLowerCase().includes(filter)) {
                    nodes[i].style.display = "block";
                    $('#no_record_found_block').remove();
                } else {
                    nodes[i].style.display = "none";
                }
            }
            $('.lb_internalmemberbox').each(function () {
                if ($(this).find('.add_user_block:visible').length > 0) {
                    $(this).find('.no_block').remove();
                } else {
                    $(this).find('.no_block').remove();
                    $(this).append(append_norecord);
                }
            });
            /*if ($('.lb_internalmemberbox:visible').length == 0) {
             $('.no_block').remove();
             $('.lb_internalmemberbox').append(append_norecord);
             } else {
             $('.lb_internalmemberbox').find('.no_block').remove();
             }*/
        }
    }


    $(window).on('load', function () {
        globalloaderhide();
        HideOnpageLoopader1();
    });

    function HideOnpageLoopader1() {
        $('#onpage_loader').hide();
    }

    function globalloadershow() {
        $('#main_pageloader').show();
    }

    function globalloaderhide() {
        $('#main_pageloader').hide();
    }

    var append_chk = "<i class='mdi mdi-check'></i>";

    function HeaderColorChange(clrcode, dis) {
        $('.color_box').children().remove();
        $(dis).append(append_chk);
        $('#master_header_block').css('background-color', clrcode);
        $('#user_header').val(clrcode);
    }

    function ChangeBg(dis) {
        var img_source = $(dis).find('.theme_img').attr('src');
        $('body').css('background-image', 'url("' + img_source + '")');
        $('#market_line').css('background-image', 'url("' + img_source + '")');
        $('.selected_img').removeClass('show_applytheme');
        $(dis).find('.selected_img').addClass('show_applytheme');
        $('#theme_img').val(img_source);
    }

    function AnimateSetting(dis) {
        var check_setting = $(dis).parent().attr('class');
        if (check_setting == 'setting_box show_setting') {
            $(dis).parent().removeClass('show_setting');
        } else {
            $(dis).parent().addClass('show_setting');
        }
    }

    function Defaulte_theme() {
        $('body').css('background-image', 'none');
        $('#market_line').css('background-image', 'none');
        $('#master_header_block').css('background-color', '#000000');
        $('#theme_uploadimg').attr('src', 'images/NoPreview_Img.png');
        $('#themebyuser_close').fadeOut();
        $('#theme_img').val('images/NoPreview_Img.png');
        $('#user_header').val('#000000');
    }

    function HideTranparent() {
        $('.overlay_res').fadeOut();
        $('.menu_left').removeClass('profile_basic_menu_block_show');
        $('.earner_right').removeClass('show_fixed_rightblk');
        $('.followers_block').removeClass('followers_block_show');
        $('.servey_block').removeClass('show_fixed_rightblk');
        $('.basic_thumb').removeClass('basic_thumb_show');
        $('.profile_basic_menu_block').removeClass('profile_basic_menu_block_show');
        $('#advertise_category_block').removeClass('advertise_category_show');
        $('body').css('overflow', 'auto');
    }

    //    function Show_Topearner() {
    //        var check_class = $('.top_earner_block').attr('class');
    //        $('.top_earner_block').removeClass('show_fixed_rightblk');
    //        if (check_class == "panel top_earner_block panel-default") {
    //            $('.top_earner_block').addClass('show_fixed_rightblk');
    //            $('.overlay_res').show();
    //            $('body').css('overflow', 'hidden');
    //        }
    //    }

    //    function Show_Followers() {
    //        var check_class = $('.followers_block').attr('class');
    //        $('.followers_block').removeClass('show_fixed_rightblk');
    //        if (check_class == "followers_block") {
    //            $('.followers_block').addClass('show_fixed_rightblk');
    //            $('.overlay_res').show();
    //            $('body').css('overflow', 'hidden');
    //        }
    //    }
    function Show_LinkOptions() {
        var check_class = $('.menu_left').attr('class');
        if (check_class == "col-md-2 dashboard_fixed menu_left") {
            $('.menu_left').addClass('profile_basic_menu_block_show');
            $('.overlay_res').show();
            $('body').css('overflow', 'hidden');
        }
        else {
            $('.menu_left').removeClass('profile_basic_menu_block_show');
            $('.overlay_res').hide();
            $('body').css('overflow', 'auto');
        }
    }
    function Show_Topearner() {
        var check_class = $('.earner_right').attr('class');
        if (check_class == "col-sm-2 dashboard_fixed earner_right") {
            $('.earner_right').addClass('show_fixed_rightblk');
            $('.overlay_res').show();
            $('body').css('overflow', 'hidden');
        }
        else {
            $('.earner_right').removeClass('show_fixed_rightblk');
            $('.overlay_res').hide();
            $('body').css('overflow', 'auto');
        }
    }
    function Show_Survey() {
        var check_class = $('.servey_block').attr('class');
        if (check_class == "servey_block") {
            $('.servey_block').addClass('show_fixed_rightblk');
            $('.overlay_res').show();
            $('body').css('overflow', 'hidden');
        }
        else {
            $('.servey_block').removeClass('show_fixed_rightblk');
            $('.overlay_res').hide();
            $('body').css('overflow', 'auto');
        }
    }
    function Show_Followers() {
        var check_class = $('.followers_block').attr('class');
        if (check_class == "followers_block panel panel-default") {
            $('.followers_block').addClass('followers_block_show');
            $('.overlay_res').show();
            $('body').css('overflow', 'hidden');
        }
        else {
            $('.followers_block').removeClass('followers_block_show');
            $('.overlay_res').hide();
            $('body').css('overflow', 'auto');
        }
    }
    //    function Show_LinkOptions() {
    //        var check_class = $('.profile_basic_menu_block').attr('class');
    //        $('.profile_basic_menu_block').removeClass('bootom_menu_show');
    //        if (check_class == "profile_basic_menu_block") {
    //            $('.profile_basic_menu_block').addClass('profile_basic_menu_block_show');
    //            $('.overlay_res').show();
    //            $('body').css('overflow', 'hidden');
    //        }
    //        else if (check_class == "profile_basic_menu_block left_menu_fixed") {
    //            $('.profile_basic_menu_block').addClass('profile_basic_menu_block_show');
    //            $('.overlay_res').show();
    //            $('body').css('overflow', 'hidden');
    //        }
    //    }


    function RemoveTheameByUser(dis) {
        $('#theme_uploadimg').attr('src', 'images/NoPreview_Img.png');
        $('body').css('background-image', 'none');
        $('#market_line').css('background-image', 'none');
        $('#themebyuser_close').fadeOut();
        $('#profilebg_Image').val('');
        $('#theme_img').val('images/NoPreview_Img.png');
    }

    function ChangeFile(dis, setid) {
        var chkoutput = ChangeThemeBgByuser(dis, setid);
    }

    function ChangeThemeBgByuser(dis, changepicid) {
        var sizefile = Number(dis.files[0].size);
        if (sizefile > 1048576) {
            var finalfilesize = parseFloat(dis.files[0].size / 1048576).toFixed(2);
            ShowErrorPopupMsg('Your file size ' + finalfilesize + ' MB. File size should not exceed 1 MB');
            $(dis).val("");
            return false;
        }
        var validfile = ["png", "jpg", "jpeg", "gif"];
        var source = $(dis).val();
        var ext = source.substring(source.lastIndexOf(".") + 1, source.length).toLowerCase();
        for (var i = 0; i < validfile.length; i++) {
            if (validfile[i] == ext) {
                break;
            }
        }
        if (i >= validfile.length) {
            ShowErrorPopupMsg('Only following file extention is allowed, png, jpg, jpeg, gif ');
            $(dis).val("");
            return false;
        }
        else {
            var input = dis;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(changepicid).attr('src', e.target.result);
                    $('body').css('background-image', 'url("' + e.target.result + '")');
                    $('#market_line').css('background-image', 'url("' + e.target.result + '")');
                    $('#themebyuser_close').fadeIn();
                    $('.selected_img').removeClass('show_applytheme');
                    $('#theme_img').val(source);
                };
                reader.readAsDataURL(input.files[0])
                return true;
            }
        }
    }

    /******************************************Bijendra**********************************************/
    $(document).ready(function () {
        activatPlaceSearch();
        $('[data-toggle="tooltip"]').tooltip();
        /********Pinku***********/
//        $("#earners_block").bootstrapNews({
//            newsPerPage: 15,
//            autoplay: true,
//            pauseOnHover: true,
//            direction: 'up',
//            newsTickerInterval: 1500,
//            onToDo: function () {
//            }
//        });

        $("#advertise_block").bootstrapNews({
            newsPerPage: 1,
            autoplay: true,
            pauseOnHover: true,
            direction: 'down',
            newsTickerInterval: 1000,
            onToDo: function () {
            }
        });
        /* Right Block Earner and Advertisement Js */

        var serclick_count = 0;
        var remain_count = 4;
        $('.servey_imgbox').click(function () {
            if (serclick_count < 4) {
                var check_selected = $(this).attr('class');
                if (check_selected == "servey_imgbox servey_imgbox_selector") {
                    $(this).removeClass('servey_imgbox_selector');
                    serclick_count--;
                    remain_count++;
                } else {
                    $(this).addClass('servey_imgbox_selector');
                    serclick_count++;
                    remain_count--;
                }
                $('#servey_remain_cut').text(remain_count);
            } else {
                var check_selected = $(this).attr('class');
                if (check_selected == "servey_imgbox servey_imgbox_selector") {
                    $(this).removeClass('servey_imgbox_selector');
                    serclick_count--;
                    if (serclick_count < 4) {
                        remain_count++
                        $('#servey_remain_cut').text(remain_count);
                    }
                } else {
                    $(this).addClass('servey_imgbox_selector');
                    serclick_count++;
                }
            }
            if ($('#servey_remain_cut').text() == "0") {
                $('#advertise_btn').removeAttr('disabled', 'disabled');
            } else {
                $('#advertise_btn').attr('disabled', 'disabled');
            }
        });

        $('.carousel .vertical .item').each(function () {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
            for (var i = 1; i < 2; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });
        /********Pinku***********/

        var user_header = $('#user_header').val();
        var theme_img = $('#theme_img').val();
        if (user_header.trim() != '' || theme_img.trim() != '') {
            if (user_header.trim() != '') {
                $('#master_header_block').css('background-color', user_header);
            } else {
                $('#master_header_block').css('background-color', '#000000');
            }
            if (theme_img.trim() != '') {
                $('body').css('background-image', 'url("' + theme_img + '")');
                $('#market_line').css('background-image', 'url("' + theme_img + '")');
                $('#theme_uploadimg').attr('src', theme_img);
            } else {
                $('body').css('background-image', 'none');
                $('#market_line').css('background-image', 'none');
                $('#theme_uploadimg').attr('src', 'images/NoPreview_Img.png');
            }
            $('#themebyuser_close').fadeOut();
        }

        $("#usertheme").on('submit', function (e) {
            var theme = $('#theme_img').val();
            var user_header = $('#user_header').val();
            // alert(theme);
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ url('change_theme') }}",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    $('#master_header_block').css('background-color', '"' + user_header + '")');
//                    $('#master_header_block').css('background-color', '#000000');
                    $('#user_header').val(obj.theme_img);
                    if (obj.theme_img != null) {
                        $('body').css('background-image', obj.theme_img);
                        $('#market_line').css('background-image', obj.theme_img);
                        $('#theme_uploadimg').attr('src', obj.theme_img);
                    } else {
//                        $('#themebyuser_close').fadeOut();
                        $('#theme_img').val('images/NoPreview_Img.png');
                        $('body').css('background-image', 'none');
                        $('#market_line').css('background-image', 'none');
                        $('#theme_uploadimg').attr('src', 'images/NoPreview_Img.png');
//                        $('#user_header').val('#000000');
                    }
                    $('#themebyuser_close').fadeOut();
                    swal("Success", "Theme has been saved", "success");
                    HideOnpageLoopader1();
                    //ShowSuccessPopupMsg("Theme has been saved");
                },
                error: function (xhr, status, error) {
                    $('#err1').html(xhr.responseText);
                }
            });
        });
    });

    window.setTimeout(function () {
        $(".alert").fadeTo(3000, 0).slideUp(300, function () {
            $(this).remove();
        });
    }, 6000);

    /************Like Unlike*****************////////Must Use
    function LikeUpdate(dis, boolean) {
        var chk_id = $(dis).attr('id');

        // if (boolean) {
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('likepost') }}",
//                data: '{"data":"' + endid + '"}',
            data: '{"post_id":"' + chk_id + '"}',
            success: function (data) {
                var curr_count = Number($(dis).parent().find('.count_like').text());
                if (data == 'like') {
                    $(dis).parent().find('.count_like').text(curr_count + 1);
                    var checkclass_dislike = $(dis).parent().parent().find('.dislike_block').attr('class');
                    if (checkclass_dislike == 'dislike_block you_dislike') {
                        var curr_discount = Number($(dis).parent().parent().find('.count_dislike').text());
                        $(dis).parent().parent().find('.dislike_block').find('.count_dislike').text(curr_discount - 1);
                        $(dis).parent().parent().find('.dislike_block').removeClass('you_dislike');
                    }
                    var checkclass_spam = $(dis).parent().parent().find('.spam_icon').attr('class');
                    if (checkclass_spam == 'spam_icon mdi mdi-emoticon-devil spam_already') {
                        var curr_spamcount = Number($(dis).parent().parent().find('.count_spam').text());
                        $(dis).parent().parent().find('.count_spam').text(curr_spamcount - 1);
                        $(dis).parent().parent().find('.spam_icon').removeClass('spam_already');
                    }
                } else {
                    $(dis).parent().find('.count_like').text(curr_count - 1);
                }
            },
            error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                $('#rcerr').html(xhr.responseText);
            }
        });
    }
    function mark_as_spam(dis) {
        var chk_id = $(dis).attr('id');
        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('spampost') }}",
//            data: '{"post_id":"' + id + '"}',
            data: {post_id: chk_id},
            success: function (data) {
                var curr_count = Number($(dis).parent().find('.count_spam').text());
                if (data == 'spam') {
                    $(dis).parent().find('.spam_icon').addClass('spam_already');
                    $(dis).parent().find('.count_spam').text(curr_count + 1);
                } else {
                    $(dis).parent().find('.spam_icon').removeClass('spam_already');
                    $(dis).parent().find('.count_spam').text(curr_count - 1);
                }
                var checkclass = $(dis).parent().parent().find('.heart').attr('class');
                if (checkclass == 'heart existing_happy' || checkclass == 'heart happy') {
                    $(dis).parent().parent().find('.heart').removeClass('existing_happy');
                    $(dis).parent().parent().find('.heart').removeClass('happy');
                    var curr_innercount = Number($(dis).parent().parent().find('.like_block').find('.count_like').text());
                    $(dis).parent().parent().find('.like_block').find('.count_like').text(curr_innercount - 1);
                }
            },
            error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                $('#rcerr').html(xhr.responseText);
            }
        });
    }

    function DislikePost(dis) {
        var chk_id = $(dis).attr('id');
        $.ajax({
            type: "get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('post_unlikes') }}",
//            data: '{"post_id":"' + id + '"}',
            data: {post_id: chk_id},
            success: function (data) {
                var curr_count = Number($(dis).parent().find('.count_dislike').text());
                if (data == 'Disliked') {
                    $(dis).addClass('you_dislike');
                    var checkclass = $(dis).parent().find('.heart').attr('class');
                    if (checkclass == 'heart existing_happy' || checkclass == 'heart happy') {
                        $(dis).parent().find('.heart').removeClass('existing_happy');
                        $(dis).parent().find('.heart').removeClass('happy');
                        var curr_innercount = Number($(dis).parent().find('.like_block').find('.count_like').text());
                        $(dis).parent().find('.like_block').find('.count_like').text(curr_innercount - 1);
                    }
                    var curr_dislikecount = Number($(dis).parent().find('.count_dislike').text());
                    $(dis).parent().find('.count_dislike').text(curr_dislikecount + 1);
                } else {
                    $(dis).removeClass('you_dislike');
                    var curr_dislikecount2 = Number($(dis).find('.count_dislike').text());
                    $(dis).find('.count_dislike').text(curr_dislikecount2 - 1);
                }
            },
            error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                $('#rcerr').html(xhr.responseText);
            }
        });
    }

    function CommentUpdate(dis, boolean) {
        var chk_id = $(dis).attr('id');

        // if (boolean) {
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('likepost') }}",
//                data: '{"data":"' + endid + '"}',
            data: '{"post_id":"' + chk_id + '"}',
            success: function (data) {
                var curr_count = Number($(dis).parent().find('.count_like').text());
                if (data == 'like') {
                    $(dis).parent().find('.count_like').text(curr_count + 1);
                } else {
                    $(dis).parent().find('.count_like').text(curr_count - 1);
                }
            },
            error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                $('#rcerr').html(xhr.responseText);
            }
        });
        {{--} else {--}}
        {{--$.ajax({--}}
        {{--type: "POST",--}}
        {{--contentType: "application/json; charset=utf-8",--}}
        {{--url: "{{ url('unlikepost') }}",--}}
        {{--data: '{"post_id":"' + chk_id + '"}',--}}
        {{--success: function (data) {--}}
        {{--//                    console.log(data);--}}
        {{--$(dis).parent().find('.count_like').text(curr_count - 1);--}}
        {{--},--}}
        {{--error: function (xhr, status, error) {--}}
        {{--$('#rcerr').html(xhr.responseText);--}}
        {{--}--}}
        {{--});--}}
        {{--}--}}
    }
    function showhide_notioption(dis) {
        if ($(dis).next().attr('class') == 'dropdown-menu show notifi_options scalenoti') {
            $('.notifi_options').addClass('scalenoti');
            $(dis).next().removeClass('scalenoti');
        } else {
            $(dis).next().addClass('scalenoti');
        }
    }
    //    function MarkRead(dis) {
    //        $(dis).parent().addClass('scalenoti');
    //        $(dis).parent().parent().parent().parent().removeClass('unseen');
    //        $(dis).remove();
    //    }

    /************Like Unlike*****************/

    function MarkRead(dis) {
        var editurl = '{{ url('make_as_read_noti') }}';
        var notification_id = $(dis).attr('id');
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: editurl,
            data: {notification_id: notification_id},//'{"data":"' + id + '"}',
            success: function (data) {
                var json = jQuery.parseJSON(data);
                var curr_count = Number($('#unread_noti_id').text());
                if (json.response == 'Notification marked as read') {
                    $('#unread_noti_id').text(curr_count - 1);
                    $(dis).parent().addClass('scalenoti');
                    $(dis).parent().parent().parent().parent().removeClass('unseen');
                    $(dis).remove();
                }
            },
            error: function (xhr, status, error) {
//                $('#notif_body').html(xhr.responseText);
//                $('.modal-body').html("Technical Error Occured!");
            }
        });
    }

    var appendnonotifiation = '<p class="alert"><b>< No Pending Notification ></b></p>';
    function RemoveNotification(dis) {
        var editurl = '{{ url('remove_noti') }}';
        var notification_id = $(dis).attr('id');
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: editurl,
            data: {notification_id: notification_id},//'{"data":"' + id + '"}',
            success: function (data) {
//                var curr_count = Number($('#unread_noti_id').text());
                var json = jQuery.parseJSON(data);
                var curr_count = Number($('#unread_noti_id').text());
                if (json.response == 'Notification has been removed') {
                    $('#unread_noti_id').text(curr_count - 1);
                    $(dis).parent().addClass('scalenoti');
                    $(dis).parent().parent().parent().parent().remove();
                    $(dis).remove();
                    if ($('#noti_row_container').children().length < 1) {
                        $('#noti_row_container').append(appendnonotifiation);
                    }
                }
                if (data == 'like') {
                    $(dis).parent().find('.count_like').text(curr_count + 1);
                } else {
                    $(dis).parent().find('.count_like').text(curr_count - 1);
                }

            },
            error: function (xhr, status, error) {
//                $('#notif_body').html(xhr.responseText);
//                $('.modal-body').html("Technical Error Occured!");
            }
        });
    }

    function show_notification_post(post_id, dis) {
        $('#Mymodal_notification').modal('show');
        $('#notif_title').html('View Post');
        $('#notif_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
        var editurl = '{{ url('show_notification_post') }}';
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: editurl,
            data: {post_id: post_id},//'{"data":"' + id + '"}',
            success: function (data) {
                $('#notif_body').html(data);
                ViewMarkRead($(dis).attr('id'), dis);
            },
            error: function (xhr, status, error) {
                $('#notif_body').html(xhr.responseText);
                //$('.modal-body').html("Technical Error Occured!");
            }
        });
    }
    function ViewMarkRead(post_id, dis) {
        var editurl = '{{ url('make_as_read_noti') }}';
        $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: editurl,
            data: {notification_id: post_id},//'{"data":"' + id + '"}',
            success: function (data) {
                var json = jQuery.parseJSON(data);
                var curr_count = Number($('#unread_noti_id').text());
                if (json.response == 'Notification marked as read') {
                    $('#unread_noti_id').text(curr_count - 1);
                    $(dis).parent().removeClass('unseen');
                    $(dis).parent().find('.markread').remove();
                }
            },
            error: function (xhr, status, error) {
//                $('#notif_body').html(xhr.responseText);
//                $('.modal-body').html("Technical Error Occured!");
            }
        });
    }
    /******************************************Bijendra**********************************************/

</script>
@if(session()->has('message'))
    <script type="text/javascript">
        setTimeout(function () {
            {{--            ShowSuccessPopupMsg('{{ session()->get('message') }}');--}}
{{--            swal("Success!", "{{ session()->get('message') }}", "success");--}}
            success_noti("{{ session()->get('message') }}");
        }, 500);
    </script>
@endif
@if($errors->any())
    <script type="text/javascript">
        setTimeout(function () {
            {{--swal("Oops!", "{{$errors->first()}}", "error");--}}
                        warning_noti("{{$errors->first()}}");
            {{--ShowErrorPopupMsg('{{$errors->first()}}');--}}
        }, 500);
    </script>
@endif
<script src="{{url('dist/js/lightbox.js')}}"></script>
<script type="text/javascript">
    function activatPlaceSearch() {
        var input = document.getElementById('location-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
    }
</script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwlSOqyHbv8BJ-0XcSZqiNgITcrqj-D2Y&libraries=places&callback=activatPlaceSearch">
</script>
{{--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>--}}
{{--<script type="text/javascript">--}}
{{--google.maps.event.addDomListener(window, 'load', function () {--}}
{{--var places = new google.maps.places.Autocomplete(document.getElementById('location-input'));--}}
{{--google.maps.event.addListener(places, 'place_changed', function () {--}}

{{--});--}}
{{--});--}}
{{--</script>--}}
{{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwlSOqyHbv8BJ-0XcSZqiNgITcrqj-D2Y&callback=activatPlaceSearch"--}}
{{--type="text/javascript"></script>--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDwlSOqyHbv8BJ-0XcSZqiNgITcrqj-D2Y"></script>--}}
{{--<script type="text/javascript"--}}
{{--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwlSOqyHbv8BJ-0XcSZqiNgITcrqj-D2Y&libraries=places&callback=activatPlaceSearch">--}}
{{--</script>--}}
<script>
    $(document).ready(function () {

        fetch_user();

        setInterval(function () {
            update_last_activity();
            fetch_user();
            update_chat_history_data();
            fetch_group_chat_history();
        }, 5000);

        function fetch_user() {
            $.ajax({
                url: "{{url('get_all_user')}}",
                method: "get",
                success: function (data) {
                    $('#frnd_chat_list').html(data);
                }
            })
        }

        function update_last_activity() {
            $.ajax({
                url: "update_last_activity",
                method: "get",
                success: function () {

                }
            })
        }

        function make_chat_dialog_box(to_user_id, to_user_name) {
            var modal_content = '<div id="user_dialog_' + to_user_id + '" class="user_dialog" title="You have chat with ' + to_user_name + '">';
            modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history chat_scroll style-scroll" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
            modal_content += fetch_user_chat_history(to_user_id);
            modal_content += '</div>';
            modal_content += '<div class="comment_txtboxblock">';
            modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="chat_message new_comment_txt comment_emoji_div edit_emoji"  placeholder="Write a comment..."></textarea>';
            modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="btn btn-primary btn-sm comment_postbtn send_chat"><i class="mdi mdi-send"></i></button></div></div>';
            modal_content += '</div>';
            $('#user_model_details').html(modal_content);
        }

        $(document).on('click', '.start_chat', function () {
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
            $('#user_dialog_' + to_user_id).dialog({
                autoOpen: false,
                width: 400,
//                position: {my: 'right bottom', at: 'right bottom', of: window}
            });
            $('#user_dialog_' + to_user_id).dialog('open');
            $('#chat_message_' + to_user_id).emojioneArea({
                pickerPosition: "top",
                toneStyle: "bullet"
            });
        });


        {{--$("#load_img_chat").remove();--}}
        {{--append_loading_img = '<div class="feed_loadimg_block" id="load_img_chat">' +--}}
                {{--'<img height="20px" class="center-block" src="{{ url('images/loading.gif') }}"/></div>';--}}
        $(document).on('click', '.send_chat', function () {
            var to_user_id = $(this).attr('id');
            var chat_message = $('#chat_message_' + to_user_id).val();
            $.ajax({
                url: "insert_chat",
                method: "POST",
                data: {to_user_id: to_user_id, chat_message: chat_message},
//                beforeSend: function () {
//                    $('#chat_history_' + to_user_id).prepend(append_loading_img);
//                },
                success: function (data) {
                    //$('#chat_message_'+to_user_id).val('');
                    var element = $('#chat_message_' + to_user_id).emojioneArea();
                    element[0].emojioneArea.setText('');
//                    $("#load_img_chat").remove();
//                    $('#chat_history_' + to_user_id).html(data);
                    $('#chat_history_' + to_user_id).prepend(data);
                }
            })
        });


        function fetch_user_chat_history(to_user_id) {
            $.ajax({
                url: "fetch_user_chat_history",
                method: "get",
                data: {to_user_id: to_user_id},
//                beforeSend: function () {
//                    $('#chat_history_' + to_user_id).html(append_loading_img);
//                },
                success: function (data) {
//                    $("#load_img_chat").remove();
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        }

        function update_chat_history_data() {
            $('.chat_history').each(function () {
                var to_user_id = $(this).data('touserid');
                fetch_user_chat_history(to_user_id);
            });
        }

        $(document).on('click', '.ui-button-icon', function () {
            $('.user_dialog').dialog('destroy').remove();
            $('#is_active_group_chat_window').val('no');
        });

        $(document).on('focus', '.chat_message', function () {
            var is_type = 'yes';
            $.ajax({
                url: "update_is_type_status",
                method: "get",
                data: {is_type: is_type},
                success: function () {

                }
            })
        });

        $(document).on('blur', '.chat_message', function () {
            var is_type = 'no';
            $.ajax({
                url: "update_is_type_status",
                method: "get",
                data: {is_type: is_type},
                success: function () {

                }
            })
        });

        $('#group_chat_dialog').dialog({
            autoOpen: false,
            width: 400
        });

        $('#group_chat').click(function () {
            $('#group_chat_dialog').dialog('open');
            $('#is_active_group_chat_window').val('yes');
            fetch_group_chat_history();
        });

        $('#send_group_chat').click(function () {
            var chat_message = $('#group_chat_message').html();
            var action = 'insert_data';
            if (chat_message != '') {
                $.ajax({
                    url: "group_chat",
                    method: "POST",
                    data: {chat_message: chat_message, action: action},
                    success: function (data) {
                        $('#group_chat_message').html('');
                        $('#group_chat_history').html(data);
                    }
                })
            }
        });

        function fetch_group_chat_history() {
            var group_chat_dialog_active = $('#is_active_group_chat_window').val();
            var action = "fetch_data";
            if (group_chat_dialog_active == 'yes') {
                $.ajax({
                    url: "group_chat",
                    method: "POST",
                    data: {action: action},
                    success: function (data) {
                        $('#group_chat_history').html(data);
                    }
                })
            }
        }

        $('#uploadFile').on('change', function () {
            $('#uploadImage').ajaxSubmit({
                target: "#group_chat_message",
                resetForm: true
            });
        });

    });
</script>
</body>
</html>
